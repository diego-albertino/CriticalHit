<?php
// Conexão com o banco de dados
require_once __DIR__ . '/../../config/db_connect.php';

// Inicia a sessão
session_start();

// Obtém o ID do jogo e tipo de ordenação
$gameId = $_POST['game_id'];
$Sort = $_POST['sort'];

$OrderBy = "ORDER BY c.data DESC";

// Definição da ordenação
switch ($Sort) {
    case 'newest':
        $OrderBy = "ORDER BY c.data DESC";
        break;
    case 'oldest':
        $OrderBy = "ORDER BY c.data ASC";
        break;
    case 'best':
        $OrderBy = "ORDER BY c.nota_avaliacao DESC, c.data DESC"; // Desempate pela data
        break;
    case 'worst':
        $OrderBy = "ORDER BY c.nota_avaliacao ASC, c.data DESC"; // Desempate pela data
        break;
}
$avatars = json_decode(file_get_contents(__DIR__ . '/../../../assets/avatars/avatars.json'), true);
function getAvatarUrl($avatarId, $avatars) {
    foreach ($avatars as $av) {
        if ($av['id'] == $avatarId) return $av['url'];
    }
    return $avatars[0]['url'] ?? ''; // fallback
}
// Prepara a consulta SQL para obter os comentários
$stmt = $conn->prepare(
    "SELECT c.texto, c.nota_avaliacao, u.nome, u.avatar
     FROM comentario c
     JOIN usuario u ON c.id_usuario = u.id
     WHERE c.id_jogo = ? 
     $OrderBy"
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
    $texto_comentario = nl2br(htmlspecialchars($row['texto']));
    $numero_estrelas = intval($row['nota_avaliacao']) ?: 0;
    $stars = str_repeat("★", $numero_estrelas);

    $avatarId = intval($row['avatar']);
    $avatarUrl = getAvatarUrl($avatarId, $avatars);

    echo "<p class='comment-paragraph rounded-2 bg-body-secondary p-3 mt-4 text-wrap d-flex align-items-center' style='gap:8px;'>
            <span>
                <img src='" . htmlspecialchars($avatarUrl) . "' alt='Avatar de {$nome_usuario}' style='width:32px; height:32px; border-radius:50%; object-fit:cover;'>
                <strong>{$nome_usuario}:</strong><br>
                {$texto_comentario}<br>
                <span class='star-commentPost'>{$stars}</span>
            </span>
          </p>";
}
}
 else {
    echo "Nenhum comentário encontrado.";
}
$stmt->close();
$conn->close();
?>