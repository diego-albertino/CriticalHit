<?php
header('Content-Type: application/json');

$client_id = 'llchwugououejhoe70hroapigu7mwh';
$client_secret = '1b084k5mwedzn6vekp4cv01rwjs623';

// Função para obter token (pode mover para um arquivo comum)
function getTwitchToken() {
    $cache_file = __DIR__ . '/twitch_token_cache.json';

    if (file_exists($cache_file)) {
        $cache = json_decode(file_get_contents($cache_file), true);
        if ($cache && isset($cache['expires_at']) && time() < $cache['expires_at']) {
            return $cache['access_token'];
        }
    }

    $url = "https://id.twitch.tv/oauth2/token";
    $post_fields = http_build_query([
        'client_id' => 'llchwugououejhoe70hroapigu7mwh',
        'client_secret' => '1b084k5mwedzn6vekp4cv01rwjs623',
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
        return false;
    }

    $data = json_decode($response, true);
    if (!isset($data['access_token'])) {
        return false;
    }

    $expires_in = $data['expires_in'] ?? 3600;
    $cache_data = [
        'access_token' => $data['access_token'],
        'expires_at' => time() + $expires_in - 60,
    ];
    file_put_contents($cache_file, json_encode($cache_data));

    return $data['access_token'];
}

$token = getTwitchToken();

if (!$token) {
    http_response_code(500);
    echo json_encode(['error' => 'Não foi possível obter token Twitch']);
    exit;
}

if (!isset($_GET['q']) || trim($_GET['q']) === '') {
    echo json_encode([]);
    exit;
}

$query = $_GET['q'];

// Montar requisição para IGDB
$igdb_endpoint = "https://api.igdb.com/v4/games";

$search_body = "fields id,name,summary,cover.url,platforms.name; search \"$query\"; limit 10;";

// Configurar cURL para chamar API IGDB
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $igdb_endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $search_body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Client-ID: $client_id",
    "Authorization: Bearer $token",
    "Accept: application/json",
    "Content-Type: text/plain",
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    http_response_code($http_code);
    echo json_encode(['error' => 'Erro na API IGDB', 'http_code' => $http_code, 'response' => $response]);
    exit;
}

$data = json_decode($response, true);
if (!is_array($data)) {
    echo json_encode([]);
    exit;
}

echo json_encode($data);
