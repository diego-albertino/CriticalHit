<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado']);
    exit();
}

include __DIR__ . '/../../config/db_connect.php';

if (!isset($_POST['id_solicitacao']) || !is_numeric($_POST['id_solicitacao'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID inválido']);
    exit();
}

$idSolicitacao = (int)$_POST['id_solicitacao'];

$stmt = $conn->prepare("DELETE FROM solicitacao_jogo WHERE id_solicitacao = ?");
$stmt->bind_param("i", $idSolicitacao);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao excluir solicitação']);
}
$stmt->close();
