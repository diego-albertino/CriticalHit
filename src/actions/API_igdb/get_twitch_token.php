<?php
$client_id = 'llchwugououejhoe70hroapigu7mwh';
$client_secret = '1b084k5mwedzn6vekp4cv01rwjs623';

$cache_file = __DIR__ . '/twitch_token_cache.json';

if (file_exists($cache_file)) {
    $cache = json_decode(file_get_contents($cache_file), true);
    if ($cache && isset($cache['expires_at']) && time() < $cache['expires_at']) {
        echo json_encode(['access_token' => $cache['access_token']]);
        exit;
    }
}

$url = "https://id.twitch.tv/oauth2/token";

$post_fields = http_build_query([
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'grant_type' => 'client_credentials'
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    http_response_code($http_code);
    echo json_encode([
        'error' => 'Não foi possível obter token Twitch',
        'http_code' => $http_code,
        'response' => json_decode($response, true),
    ]);
    exit;
}

$data = json_decode($response, true);

if (!isset($data['access_token'])) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Não foi possível obter token Twitch',
        'response' => $data,
    ]);
    exit;
}

$expires_in = $data['expires_in'] ?? 3600;
$cache_data = [
    'access_token' => $data['access_token'],
    'expires_at' => time() + $expires_in - 60,
];
file_put_contents($cache_file, json_encode($cache_data));

echo json_encode(['access_token' => $data['access_token']]);
