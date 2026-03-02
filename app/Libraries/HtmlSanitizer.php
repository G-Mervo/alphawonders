<?php

namespace App\Libraries;

/**
 * Server-side HTML sanitizer for user-submitted content.
 *
 * Uses a whitelist approach: only explicitly allowed tags and attributes
 * pass through. Everything else is stripped. This protects against XSS
 * while preserving legitimate TinyMCE editor output.
 */
class HtmlSanitizer
{
    /**
     * Tags allowed in rich HTML content (blog posts).
     */
    private static array $allowedTags = [
        'p', 'br', 'hr',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'strong', 'b', 'em', 'i', 'u', 's', 'strike', 'del', 'ins', 'sub', 'sup',
        'ul', 'ol', 'li',
        'a', 'img',
        'blockquote', 'pre', 'code',
        'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td', 'caption', 'colgroup', 'col',
        'div', 'span',
        'figure', 'figcaption',
        'video', 'audio', 'source',
        'abbr', 'address', 'cite', 'q', 'small', 'mark', 'details', 'summary',
    ];

    /**
     * Attributes allowed per tag. '*' key applies to all tags.
     */
    private static array $allowedAttributes = [
        '*'     => ['class', 'id', 'title', 'lang', 'dir', 'role', 'aria-label', 'aria-hidden', 'data-mce-style'],
        'a'     => ['href', 'target', 'rel', 'name'],
        'img'   => ['src', 'alt', 'width', 'height', 'loading'],
        'td'    => ['colspan', 'rowspan', 'headers'],
        'th'    => ['colspan', 'rowspan', 'scope', 'headers'],
        'col'   => ['span'],
        'colgroup' => ['span'],
        'ol'    => ['start', 'type', 'reversed'],
        'video' => ['src', 'controls', 'width', 'height', 'poster', 'preload'],
        'audio' => ['src', 'controls', 'preload'],
        'source' => ['src', 'type'],
        'blockquote' => ['cite'],
        'q'     => ['cite'],
        'abbr'  => [],
        'details' => ['open'],
    ];

    /**
     * Dangerous URI schemes that must be blocked in href/src attributes.
     */
    private static array $dangerousSchemes = [
        'javascript:', 'vbscript:', 'data:text/html', 'data:application',
    ];

    /**
     * Sanitize rich HTML content (for blog posts from TinyMCE).
     * Strips all disallowed tags and attributes, blocks dangerous URIs.
     */
    public static function sanitizeHtml(string $html): string
    {
        if (empty(trim($html))) {
            return '';
        }

        // Use DOMDocument for robust HTML parsing
        $dom = new \DOMDocument('1.0', 'UTF-8');

        // Suppress warnings from malformed HTML
        libxml_use_internal_errors(true);

        // Wrap in a container to preserve fragment structure
        $wrapped = '<div id="__sanitizer_root__">' . $html . '</div>';
        $dom->loadHTML(
            '<?xml encoding="UTF-8">' . $wrapped,
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NONET
        );

        libxml_clear_errors();

        // Process all elements
        self::sanitizeNode($dom->documentElement);

        // Extract the inner HTML of our wrapper
        $root = $dom->getElementById('__sanitizer_root__');
        if (!$root) {
            return '';
        }

        $output = '';
        foreach ($root->childNodes as $child) {
            $output .= $dom->saveHTML($child);
        }

        return $output;
    }

    /**
     * Sanitize plain text content (for social media posts, notes, etc.).
     * Strips ALL HTML tags — only plain text is allowed.
     */
    public static function sanitizePlainText(string $text): string
    {
        return htmlspecialchars(strip_tags($text), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Recursively sanitize a DOM node and its children.
     */
    private static function sanitizeNode(\DOMNode $node): void
    {
        if ($node->nodeType !== XML_ELEMENT_NODE) {
            return;
        }

        // Collect child nodes first (iterating while modifying causes issues)
        $children = [];
        foreach ($node->childNodes as $child) {
            $children[] = $child;
        }

        foreach ($children as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE) {
                $tagName = strtolower($child->nodeName);

                if (!in_array($tagName, self::$allowedTags, true)) {
                    // Remove the tag but keep its text children (unwrap)
                    self::unwrapNode($child);
                } else {
                    // Tag is allowed — sanitize its attributes
                    self::sanitizeAttributes($child, $tagName);
                    // Recurse into children
                    self::sanitizeNode($child);
                }
            } elseif ($child->nodeType === XML_COMMENT_NODE) {
                // Strip HTML comments (can contain conditional IE exploits)
                $node->removeChild($child);
            }
        }
    }

    /**
     * Remove disallowed attributes from an element.
     */
    private static function sanitizeAttributes(\DOMElement $element, string $tagName): void
    {
        $globalAllowed = self::$allowedAttributes['*'] ?? [];
        $tagAllowed = self::$allowedAttributes[$tagName] ?? [];
        $allowed = array_merge($globalAllowed, $tagAllowed);

        // Also allow 'style' on all elements — but we'll sanitize its value
        $allowed[] = 'style';

        // Collect attributes to remove (can't modify while iterating)
        $toRemove = [];
        foreach ($element->attributes as $attr) {
            $attrName = strtolower($attr->nodeName);

            // Block all event handlers (on*)
            if (str_starts_with($attrName, 'on')) {
                $toRemove[] = $attr->nodeName;
                continue;
            }

            // Block disallowed attributes
            if (!in_array($attrName, $allowed, true)) {
                $toRemove[] = $attr->nodeName;
                continue;
            }

            // Sanitize URI attributes
            if (in_array($attrName, ['href', 'src', 'action', 'poster'], true)) {
                if (self::isDangerousUri($attr->nodeValue)) {
                    $toRemove[] = $attr->nodeName;
                    continue;
                }
            }

            // Sanitize style attribute
            if ($attrName === 'style') {
                $cleanStyle = self::sanitizeStyle($attr->nodeValue);
                if ($cleanStyle === '') {
                    $toRemove[] = $attr->nodeName;
                } else {
                    $element->setAttribute('style', $cleanStyle);
                }
            }
        }

        foreach ($toRemove as $name) {
            $element->removeAttribute($name);
        }
    }

    /**
     * Check if a URI contains a dangerous scheme.
     */
    private static function isDangerousUri(string $uri): bool
    {
        $uri = trim($uri);
        // Decode entities and normalize
        $decoded = html_entity_decode($uri, ENT_QUOTES, 'UTF-8');
        // Remove null bytes and whitespace within scheme
        $decoded = preg_replace('/[\x00-\x20]+/', '', $decoded);
        $lower = strtolower($decoded);

        foreach (self::$dangerousSchemes as $scheme) {
            if (str_starts_with($lower, $scheme)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Sanitize CSS in style attributes.
     * Allow safe properties, block expressions/urls that could execute JS.
     */
    private static function sanitizeStyle(string $style): string
    {
        // Remove any CSS expressions, url() with javascript/data, behavior, -moz-binding
        $dangerous = [
            '/expression\s*\(/i',
            '/javascript\s*:/i',
            '/vbscript\s*:/i',
            '/-moz-binding/i',
            '/behavior\s*:/i',
            '/@import/i',
        ];

        $clean = preg_replace($dangerous, '', $style);

        // Remove url() calls that don't point to safe resources
        $clean = preg_replace_callback('/url\s*\(\s*["\']?(.*?)["\']?\s*\)/i', function ($matches) {
            $url = trim($matches[1]);
            $lower = strtolower($url);
            // Only allow http(s) URLs in CSS
            if (str_starts_with($lower, 'http://') || str_starts_with($lower, 'https://') || str_starts_with($lower, '/')) {
                return $matches[0];
            }
            return '';
        }, $clean);

        return trim($clean);
    }

    /**
     * Replace a node with its children (unwrap).
     */
    private static function unwrapNode(\DOMNode $node): void
    {
        $parent = $node->parentNode;
        if (!$parent) {
            return;
        }

        // Move all children before the node
        while ($node->firstChild) {
            $parent->insertBefore($node->firstChild, $node);
        }

        // Remove the now-empty node
        $parent->removeChild($node);
    }
}
