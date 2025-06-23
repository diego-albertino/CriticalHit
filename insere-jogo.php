<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit();
}

include "src/config/db_connect.php";

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id_solicitacao'], $data['jogo'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos']);
    exit();
}

$idSolicitacao = (int)$data['id_solicitacao'];
$jogo = $data['jogo'];


if (!isset($jogo['id'], $jogo['name'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados do jogo incompletos']);
    exit();
}


function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text ?: 'n-a';
}


$idJogoIgdb = (int)$jogo['id'];
$nome = $conn->real_escape_string($jogo['name']);
$descricao = isset($jogo['summary']) ? $conn->real_escape_string($jogo['summary']) : '';
$url_img = '';
if (isset($jogo['cover']['url'])) {
    $url_img = 'https:' . str_replace('t_thumb', 't_cover_big', $jogo['cover']['url']);
}
$slug = slugify($nome);
$nota = 0; 


$plataforma_id = 1;

if (!empty($jogo['platforms']) && is_array($jogo['platforms'])) {
    $platNome = strtolower($jogo['platforms'][0]['name']);
    if (strpos($platNome, 'playstation') !== false) {
        $plataforma_id = 2;
    } elseif (strpos($platNome, 'xbox') !== false) {
        $plataforma_id = 3;
    } elseif (strpos($platNome, 'pc') !== false || strpos($platNome, 'windows') !== false) {
        $plataforma_id = 4;
    } elseif (strpos($platNome, 'nintendo switch') !== false) {
        $plataforma_id = 6;
    } elseif (strpos($platNome, 'geforce now') !== false) {
        $plataforma_id = 5;
    } else {
        
        $plataforma_id = 1;
    }
} else {
    $plataforma_id = 1;
}



$stmtCheck = $conn->prepare("SELECT id FROM jogo WHERE slug = ?");
$stmtCheck->bind_param("s", $slug);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
    $stmtCheck->close();
    
    echo json_encode(['success' => false, 'error' => 'Jogo já cadastrado']);
    exit();
}
$stmtCheck->close();


$stmt = $conn->prepare("INSERT INTO jogo (nome, url_img, descricao, nota, slug, plataforma) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Erro na preparação da query']);
    exit();
}
$nota = 0;
$stmt->bind_param("sssisi", $nome, $url_img, $descricao, $nota, $slug, $plataforma_id);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'error' => 'Erro ao inserir jogo no banco']);
    exit();
}

$stmt->close();

$stmtUpd = $conn->prepare("UPDATE solicitacao_jogo SET solicitacao_atendida = 1 WHERE id_solicitacao = ?");
$stmtUpd->bind_param("i", $idSolicitacao);
$stmtUpd->execute();
$stmtUpd->close();


echo json_encode(['success' => true]);
