<?php

namespace App\Libraries;

class GroqService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://api.groq.com/openai/v1/chat/completions';

    public function __construct()
    {
        $db = \Config\Database::connect();
        $keyRow = $db->table('settings')->where('setting_key', 'groq_api_key')->get()->getRowArray();
        $modelRow = $db->table('settings')->where('setting_key', 'groq_model')->get()->getRowArray();

        $this->apiKey = $keyRow['setting_value'] ?? '';
        $this->model = $modelRow['setting_value'] ?: 'llama-3.3-70b-versatile';
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Core chat method — calls Groq API
     */
    public function chat(string $systemPrompt, string $userMessage, float $temperature = 0.7, int $maxTokens = 2048): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'content' => '', 'error' => 'Groq API key not configured. Go to Settings to add it.'];
        }

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->request('POST', $this->baseUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model'       => $this->model,
                    'messages'    => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                    'temperature' => $temperature,
                    'max_tokens'  => $maxTokens,
                ],
                'timeout' => 30,
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['choices'][0]['message']['content'])) {
                return [
                    'success' => true,
                    'content' => $body['choices'][0]['message']['content'],
                    'error'   => null,
                ];
            }

            return ['success' => false, 'content' => '', 'error' => $body['error']['message'] ?? 'Unknown API error'];
        } catch (\Exception $e) {
            return ['success' => false, 'content' => '', 'error' => $e->getMessage()];
        }
    }

    /**
     * Generate a full blog post from a topic
     */
    public function generateBlogPost(string $topic, string $outline = ''): array
    {
        $system = 'You are a professional tech blog writer for Alphawonders, an ICT company. Write engaging, well-structured blog posts in HTML format suitable for a WYSIWYG editor. Use <h2>, <h3>, <p>, <ul>, <li>, <strong>, <em> tags. Do not include <html>, <head>, or <body> tags. Write 600-1000 words.';
        $user = "Write a blog post about: {$topic}";
        if ($outline) {
            $user .= "\n\nFollow this outline:\n{$outline}";
        }

        return $this->chat($system, $user, 0.7, 3000);
    }

    /**
     * Suggest a blog title from content
     */
    public function suggestTitle(string $content): array
    {
        $system = 'You are a headline expert. Suggest one compelling, SEO-friendly blog title. Return ONLY the title text, nothing else.';
        $user = "Suggest a title for this blog content:\n\n" . mb_substr(strip_tags($content), 0, 1500);

        return $this->chat($system, $user, 0.8, 100);
    }

    /**
     * Suggest a URL slug from a title
     */
    public function suggestSlug(string $title): array
    {
        $system = 'You are a URL slug generator. Generate a short, SEO-friendly URL slug using only lowercase letters, numbers, and hyphens. Return ONLY the slug, nothing else.';
        $user = "Generate a URL slug for: {$title}";

        return $this->chat($system, $user, 0.3, 50);
    }

    /**
     * Suggest a category from content
     */
    public function suggestCategory(string $content, array $categoriesList = []): array
    {
        if (!empty($categoriesList)) {
            $slugs = array_column($categoriesList, 'slug');
            $categories = implode(', ', $slugs);
        } else {
            $categories = 'machine-learning, artificial-intelligence, robotics, quantum-computing, digital-marketing, blockchain, iot, cyber-security, data-science, trends-technology';
        }

        $system = "You are a content categorizer. Choose the single most relevant category from this list: {$categories}. Return ONLY the category value (e.g. 'artificial-intelligence'), nothing else.";
        $user = "Categorize this content:\n\n" . mb_substr(strip_tags($content), 0, 1500);

        return $this->chat($system, $user, 0.3, 30);
    }

    /**
     * Draft a reply to a contact message
     */
    public function draftMessageReply(string $senderName, string $message, string $subject = ''): array
    {
        $system = 'You are a professional customer service representative for Alphawonders, an ICT company. Draft a friendly, helpful reply email. Be concise but warm. Sign off as "The Alphawonders Team".';
        $context = "From: {$senderName}";
        if ($subject) {
            $context .= "\nSubject: {$subject}";
        }
        $context .= "\nMessage: {$message}";

        return $this->chat($system, "Draft a reply to this message:\n\n{$context}", 0.7, 500);
    }

    /**
     * Generate insights from project/hire data
     */
    public function generateProjectInsights(array $hires): array
    {
        $system = 'You are a business analyst for an ICT company. Analyze the project data and provide brief, actionable insights in HTML format using <h4>, <p>, <ul>, <li>, <strong> tags. Focus on: trends, popular services, budget patterns, client recommendations. Keep it concise (3-5 key insights).';

        $summary = "Recent projects data ({$this->countProjects($hires)} total):\n";
        foreach ($hires as $hire) {
            $summary .= "- {$hire['work']} | Budget: {$hire['budget']} | Status: {$hire['status']} | Timeline: " . ($hire['timeline'] ?? 'N/A') . "\n";
        }

        return $this->chat($system, "Analyze these projects:\n\n{$summary}", 0.6, 1000);
    }

    private function countProjects(array $hires): int
    {
        return count($hires);
    }

    /**
     * Generate a social media post for a single platform
     */
    public function generateSocialPost(string $title, string $content, string $platform, string $url = ''): array
    {
        $instructions = $this->getPlatformInstructions($platform);
        $system = "You are a social media expert for Alphawonders, an ICT company. Generate a social media post for {$platform}. {$instructions} Return JSON with keys: \"content\" (the post text) and \"hashtags\" (comma-separated relevant hashtags). Return ONLY valid JSON, nothing else.";

        $user = "Blog title: {$title}\n\nBlog content (excerpt):\n" . mb_substr(strip_tags($content), 0, 2000);
        if ($url) {
            $user .= "\n\nLink: {$url}";
        }

        $result = $this->chat($system, $user, 0.7, 1000);
        if ($result['success']) {
            $decoded = json_decode($result['content'], true);
            if ($decoded) {
                $result['content'] = $decoded;
            }
        }
        return $result;
    }

    /**
     * Generate social posts for all 5 platforms at once
     */
    public function generateAllSocialPosts(string $title, string $content, string $url = ''): array
    {
        $platforms = ['twitter', 'facebook', 'linkedin', 'instagram', 'tiktok'];
        $platformRules = [];
        foreach ($platforms as $p) {
            $platformRules[] = "{$p}: " . $this->getPlatformInstructions($p);
        }

        $system = "You are a social media expert for Alphawonders, an ICT company. Generate posts for ALL 5 social media platforms. Rules per platform:\n" . implode("\n", $platformRules) . "\n\nReturn JSON with keys for each platform (twitter, facebook, linkedin, instagram, tiktok). Each value should be an object with \"content\" and \"hashtags\". Return ONLY valid JSON.";

        $user = "Blog title: {$title}\n\nBlog content (excerpt):\n" . mb_substr(strip_tags($content), 0, 2000);
        if ($url) {
            $user .= "\n\nLink: {$url}";
        }

        $result = $this->chat($system, $user, 0.7, 3000);
        if ($result['success']) {
            $decoded = json_decode($result['content'], true);
            if ($decoded) {
                $result['content'] = $decoded;
            }
        }
        return $result;
    }

    /**
     * Generate a video script for TikTok/Reels
     */
    public function generateVideoScript(string $title, string $content, string $platform = 'tiktok', int $seconds = 60): array
    {
        $system = "You are a short-form video content creator for Alphawonders, an ICT company. Create a {$seconds}-second video script for {$platform}. Use these cue markers:\n[VISUAL] - describe what appears on screen\n[VOICEOVER] - the spoken narration\n[TEXT OVERLAY] - text shown on screen\n\nAlso include a music/sound suggestion and best posting time. Format the script clearly with timestamps (e.g., 0:00-0:05). Return plain text, not JSON.";

        $user = "Create a video script about: {$title}\n\nSource content:\n" . mb_substr(strip_tags($content), 0, 1500);

        return $this->chat($system, $user, 0.8, 2000);
    }

    /**
     * Suggest hashtags for a platform
     */
    public function suggestHashtags(string $content, string $platform = 'twitter', int $count = 10): array
    {
        $system = "You are a social media hashtag expert. Suggest {$count} hashtags for {$platform}. Mix popular high-reach hashtags with niche specific ones. Return ONLY comma-separated hashtags with # prefix, nothing else.";

        $user = "Suggest hashtags for this content:\n\n" . mb_substr(strip_tags($content), 0, 1500);

        return $this->chat($system, $user, 0.7, 200);
    }

    /**
     * Generate SEO meta description
     */
    public function generateMetaDescription(string $title, string $content): array
    {
        $system = "You are an SEO expert. Generate a compelling meta description for a blog post. It must be 150-160 characters, include the main keyword naturally, and entice clicks from search results. Return ONLY the meta description text, nothing else.";

        $user = "Title: {$title}\n\nContent:\n" . mb_substr(strip_tags($content), 0, 1500);

        return $this->chat($system, $user, 0.6, 100);
    }

    /**
     * Repurpose blog content into different formats
     */
    public function repurposeContent(string $title, string $content, string $format = 'newsletter'): array
    {
        $formatInstructions = [
            'newsletter' => 'Convert into a concise email newsletter format with a greeting, key points, and call-to-action. Use a professional but friendly tone.',
            'thread' => 'Convert into an X (formerly Twitter) thread format. Number each post (1/, 2/, etc.). Each post should be under 280 characters. Include a hook in post 1 and CTA in the last post.',
            'carousel' => 'Create an Instagram/LinkedIn carousel outline. Provide slide-by-slide content (8-10 slides). Slide 1 = hook title, last slide = CTA. Each slide should have a headline and 1-2 bullet points.',
            'infographic' => 'Create an infographic outline with sections, key statistics/data points, and visual layout suggestions. Include a title, 4-6 key sections with brief text for each.',
        ];

        $instruction = $formatInstructions[$format] ?? $formatInstructions['newsletter'];

        $system = "You are a content repurposing expert for Alphawonders, an ICT company. {$instruction}";

        $user = "Repurpose this blog post:\n\nTitle: {$title}\n\nContent:\n" . mb_substr(strip_tags($content), 0, 3000);

        return $this->chat($system, $user, 0.7, 2000);
    }

    /**
     * Per-platform AI prompt instructions
     */
    private function getPlatformInstructions(string $platform): string
    {
        return match ($platform) {
            'twitter'   => 'This is for X (formerly Twitter). Keep under 280 characters. Be punchy and engaging. Use 2-3 hashtags max. Include a hook in the first line.',
            'facebook'  => 'Write 2-3 engaging paragraphs. Use emojis sparingly. Ask a question to drive engagement. Can be 300-500 characters.',
            'linkedin'  => 'Professional tone. Lead with a thought-provoking statement. Use line breaks for readability. 500-700 characters. Add relevant industry hashtags.',
            'instagram' => 'Engaging caption under 2200 characters. Start with a hook. Use line breaks. Include CTA. Suggest 15-20 hashtags in a separate block.',
            'tiktok'    => 'Short, catchy, and trendy. Under 150 characters. Use trending language. Include 3-5 hashtags. Think viral hooks.',
            default     => 'Write an engaging social media post appropriate for the platform.',
        };
    }
}
