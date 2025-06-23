<?php
// detalhes_jogo_igdb.php
header('Content-Type: application/json');

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo json_encode([]);
    exit;
}

// Buscar token via arquivo (mesmo método do anterior)
$token_data = json_decode(file_get_contents(__DIR__ . '/twitch_token_cache.json'), true);
if (!$token_data || !isset($token_data['access_token'])) {
    $token_json = file_get_contents('get_twitch_token.php'); // ajuste caminho real!
    $token_data = json_decode($token_json, true);
    if (!$token_data || !isset($token_data['access_token'])) {
        echo json_encode([]);
        exit;
    }
}
$token = $token_data['access_token'];

$client_id = 'llchwugououejhoe70hroapigu7mwh';

$query = "fields id,name,summary,platforms.name,cover.url; where id = $id;";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.igdb.com/v4/games");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Client-ID: $client_id",
    "Authorization: Bearer $token",
    "Accept: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);

$game = json_decode($response, true);
if (!$game) $game = [];

echo json_encode($game);
