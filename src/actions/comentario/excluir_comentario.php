<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    http_response_code(403);
    echo "Acesso negado.";
    exit;
}

// Verifica id_com
if (!isset($_GET['id_com']) || !is_numeric($_GET['id_com'])) {
    http_response_code(400);
    echo "ID do comentário inválido.";
    exit;
}

$id_com = intval($_GET['id_com']);

// Verifica slug
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    http_response_code(400);
    echo "Slug do jogo não informado.";
    exit;
}

$slug = $_GET['slug'];

// Conecta ao banco
require_once __DIR__ . '/../../config/db_connect.php';

// Prepara e executa exclusão
$stmt = $conn->prepare("DELETE FROM comentario WHERE id_com = ?");
$stmt->bind_param("i", $id_com);

if ($stmt->execute()) {
    // Redireciona para a página do jogo com slug
    // Use urlencode para segurança na URL
    header("Location: ../../../jogo.php?game=" . urlencode($slug));
    exit;
} else {
    http_response_code(500);
    echo "Erro ao excluir o comentário.";
}

$stmt->close();
$conn->close();
?>
