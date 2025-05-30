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

// Obtém o ID do jogo
$gameId = $_POST['game_id'];

// Prepara a consulta SQL para obter os comentários
$stmt = $conn->prepare(
    "SELECT c.texto, c.nota_avaliacao, u.nome
     FROM comentario c
     JOIN usuario u ON c.id_usuario = u.id
     WHERE c.id_jogo = ? 
     ORDER BY c.data DESC" // Ordem os comentários pela data mais recente
);

$stmt->bind_param("i", $gameId);

// Verifica se a consulta foi preparada corretamente
if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Executa a consulta
$stmt->execute();

// Obtém o resultado
$result = $stmt->get_result();

// Verifica se há comentários
if ($result->num_rows > 0) {
    // Exibe os comentários
    while ($row = $result->fetch_assoc()) {
        $nome_usuario = htmlspecialchars($row['nome']) ?: "Usuário";
        // Aplicar nl2br para manter quebras de linha e htmlspecialchars para evitar XSS
        $texto_comentario = nl2br(htmlspecialchars($row['texto']));
        $numero_estrelas = intval($row['nota_avaliacao']) ?: 0;
        $stars = str_repeat("★", $numero_estrelas);

        echo "<p class='comment-paragraph rounded-2 bg-body-secondary p-3 mt-4 text-wrap'><i class='bi bi-person-circle'>&nbsp;</i><strong>{$nome_usuario}: </strong><br>{$texto_comentario}<br><span class='star-commentPost'>{$stars}</span></p>";

    }
}
 else {
    echo "Nenhum comentário encontrado.";
}

$conn->close();
?>