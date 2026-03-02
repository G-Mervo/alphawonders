<?php

/**
 * Look up country from IP address using ip-api.com (free, no key needed, 45 req/min).
 * Returns country name or null on failure.
 */
function geoip_country(string $ip): ?string
{
    // Skip private/local IPs
    if (in_array($ip, ['127.0.0.1', '::1', '0.0.0.0']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
        return null;
    }

    try {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'http://ip-api.com/json/' . urlencode($ip) . '?fields=status,country', [
            'timeout' => 3,
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['status']) && $data['status'] === 'success' && !empty($data['country'])) {
            return $data['country'];
        }
    } catch (\Exception $e) {
        log_message('debug', 'GeoIP lookup failed for ' . $ip . ': ' . $e->getMessage());
    }

    return null;
}
