<?php
session_start();
header('Content-Type: application/json');

//Inclui o arquivo de conexão com o banco de dados
require_once __DIR__ . '/../../config/db_connect.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}

$username = $_SESSION['username'];

// Prepara a consulta para buscar o ID do usuário pelo nome
$stmt = $conn->prepare("SELECT id FROM usuario WHERE nome = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userId);
$stmt->fetch();
$stmt->close();
$conn->close();

// Verifica se o ID do usuário foi encontrado
if ($userId) {
    echo json_encode(['success' => true, 'user_id' => $userId]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']);
}
?>