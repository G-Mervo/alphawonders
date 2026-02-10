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
    public function suggestCategory(string $content): array
    {
        $categories = 'machine-learning, artificial-intelligence, robotics, quantum-computing, digital-marketing, blockchain, iot, cyber-security, data-science, trends-technology';
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
}
