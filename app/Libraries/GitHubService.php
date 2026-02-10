<?php

namespace App\Libraries;

class GitHubService
{
    protected string $token;
    protected string $baseUrl = 'https://api.github.com';

    public function __construct()
    {
        $db = \Config\Database::connect();
        $row = $db->table('settings')->where('setting_key', 'github_pat')->get()->getRowArray();
        $this->token = $row['setting_value'] ?? '';
    }

    public function isConfigured(): bool
    {
        return !empty($this->token);
    }

    /**
     * Core API request method
     */
    public function request(string $method, string $endpoint, array $data = []): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'data' => null, 'error' => 'GitHub token not configured. Go to Settings to add it.'];
        }

        $client = \Config\Services::curlrequest();
        $url = $this->baseUrl . $endpoint;

        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept'        => 'application/vnd.github+json',
                'User-Agent'    => 'Alphawonders-Dashboard',
                'X-GitHub-Api-Version' => '2022-11-28',
            ],
            'timeout' => 15,
        ];

        if (!empty($data) && in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $options['json'] = $data;
        }

        try {
            $response = $client->request($method, $url, $options);
            $body = json_decode($response->getBody(), true);

            return ['success' => true, 'data' => $body, 'error' => null];
        } catch (\Exception $e) {
            $message = $e->getMessage();
            // Try to parse GitHub error from response body
            if (method_exists($e, 'getResponse') && $e->getResponse()) {
                $errBody = json_decode($e->getResponse()->getBody(), true);
                if (isset($errBody['message'])) {
                    $message = $errBody['message'];
                }
            }
            return ['success' => false, 'data' => null, 'error' => $message];
        }
    }

    /**
     * Cached GET requests using CI4 file cache
     */
    public function cachedGet(string $endpoint, int $ttl = 300): array
    {
        $cache = \Config\Services::cache();
        $cacheKey = 'github_' . md5($endpoint);

        $cached = $cache->get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $result = $this->request('GET', $endpoint);
        if ($result['success']) {
            $cache->save($cacheKey, $result, $ttl);
        }

        return $result;
    }

    public function getUser(): array
    {
        return $this->cachedGet('/user', 600);
    }

    public function listRepos(int $perPage = 30, string $sort = 'updated'): array
    {
        return $this->cachedGet("/user/repos?per_page={$perPage}&sort={$sort}&direction=desc", 300);
    }

    public function getRepo(string $owner, string $repo): array
    {
        return $this->cachedGet("/repos/{$owner}/{$repo}", 300);
    }

    public function getCommits(string $owner, string $repo, int $perPage = 10): array
    {
        return $this->cachedGet("/repos/{$owner}/{$repo}/commits?per_page={$perPage}", 300);
    }

    public function getLanguages(string $owner, string $repo): array
    {
        return $this->cachedGet("/repos/{$owner}/{$repo}/languages", 600);
    }

    public function listIssues(string $owner, string $repo, string $state = 'open', int $perPage = 10): array
    {
        return $this->cachedGet("/repos/{$owner}/{$repo}/issues?state={$state}&per_page={$perPage}", 300);
    }

    public function createRepo(array $data): array
    {
        return $this->request('POST', '/user/repos', $data);
    }

    public function createIssue(string $owner, string $repo, array $data): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/issues", $data);
    }

    public function createRelease(string $owner, string $repo, array $data): array
    {
        return $this->request('POST', "/repos/{$owner}/{$repo}/releases", $data);
    }
}
