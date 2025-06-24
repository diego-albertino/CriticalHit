<?php
// Conexão com o banco de dados
require_once __DIR__ . '/../config/db_connect.php';

// pegar o valor da variável 'slug' criado no javascript e colocar na variável $slug
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Consulta para obter os dados do jogo com base no slug
$stmt = $conn->prepare(
    "SELECT j.id, j.nome, j.descricao, j.url_img, j.descricao, j.nota, j.plataforma
     FROM jogo j
     WHERE j.slug = ?"
);

$stmt->bind_param("s", $slug);

// Verifica se a consulta foi preparada corretamente
if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Executa a consulta
$stmt->execute();

// Obtém o resultado
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtém os dados do jogo
    $jogo = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($jogo);
} 
else {
    http_response_code(404);
    echo json_encode(['erro' => 'Jogo não encontrado.']);
}
$stmt->close();
$conn->close();
exit();
?>
