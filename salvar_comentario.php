<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "criticalhit";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Obtém o ID do jogo , ID do usuário e o ID da plataforma do formulário
$gameId = $_POST['game_id'];
$userId = $_POST['user_id'];
$platformId = $_POST['platform_id'];

// Obtém a avaliação e o comentário do formulário
$rating = $_POST['rating'];
$comment = $_POST['comment'];


// Prepara a consulta SQL para inserir o comentário
    $stmt = $conn->prepare("INSERT INTO comentario (id_jogo, id_usuario, nota_avaliacao, texto, id_plataforma, data) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiisi", $gameId, $userId, $rating, $comment, $platformId);

    // Verifica se a consulta foi preparada corretamente
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Comentário salvo com sucesso!";
    } else {
        echo "Erro ao salvar o comentário: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();

?>