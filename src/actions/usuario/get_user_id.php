<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}

$username = $_SESSION['username'];

$conn = new mysqli("localhost", "root", "", "criticalhit");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Erro de conexão']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM usuario WHERE nome = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($userId);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($userId) {
    echo json_encode(['success' => true, 'user_id' => $userId]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']);
}
?>