<?php

/**
 * Get the real client IP address from behind CloudFront + Nginx + Docker.
 *
 * Traffic chain: Client → CloudFront → Nginx → PHP container
 * CloudFront appends the real client IP to X-Forwarded-For.
 * The first IP in X-Forwarded-For is the original client.
 */
function real_client_ip(): string
{
    $request = \Config\Services::request();

    // X-Forwarded-For: client-ip, cloudfront-ip, ...
    $forwarded = $request->getHeaderLine('X-Forwarded-For');
    if ($forwarded !== '') {
        $ips = array_map('trim', explode(',', $forwarded));
        $clientIp = $ips[0];
        if (filter_var($clientIp, FILTER_VALIDATE_IP)) {
            return $clientIp;
        }
    }

    // Fallback to X-Real-IP (set by nginx)
    $realIp = $request->getHeaderLine('X-Real-IP');
    if ($realIp !== '' && filter_var($realIp, FILTER_VALIDATE_IP)) {
        return $realIp;
    }

    return $request->getIPAddress();
}

/**
 * Look up country from IP address using ip-api.com (free, no key needed, 45 req/min).
 * Returns country name or null on failure.
 */
function geoip_country(string $ip): ?string
{
    $geo = geoip_lookup($ip);
    return $geo['country'] ?? null;
}

/**
 * Look up country and city from IP address using ip-api.com.
 * Returns ['country' => string|null, 'city' => string|null].
 */
function geoip_lookup(string $ip): array
{
    $result = ['country' => null, 'city' => null];

    // Skip private/local/Docker IPs
    if (
        in_array($ip, ['127.0.0.1', '::1', '0.0.0.0'])
        || str_starts_with($ip, '192.168.')
        || str_starts_with($ip, '10.')
        || str_starts_with($ip, '172.16.')
        || str_starts_with($ip, '172.17.')
        || str_starts_with($ip, '172.18.')
        || str_starts_with($ip, '172.19.')
        || str_starts_with($ip, '172.2')
        || str_starts_with($ip, '172.3')
        || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
    ) {
        return $result;
    }

    try {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'http://ip-api.com/json/' . urlencode($ip) . '?fields=status,country,city', [
            'timeout' => 3,
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['status']) && $data['status'] === 'success') {
            $result['country'] = $data['country'] ?? null;
            $result['city'] = $data['city'] ?? null;
        }
    } catch (\Exception $e) {
        log_message('debug', 'GeoIP lookup failed for ' . $ip . ': ' . $e->getMessage());
    }

    return $result;
}
