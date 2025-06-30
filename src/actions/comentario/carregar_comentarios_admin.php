<?php
// Inclui o arquivo de conexão com o banco de dados
require_once __DIR__ . '/../../config/db_connect.php';

// Carrega o JSON dos avatares
$avatars = json_decode(file_get_contents(__DIR__ . '/../../../assets/avatars/avatars.json'), true);

session_start();

$gameId = $_POST['game_id'] ?? null;
$Sort = $_POST['sort'] ?? null;

$OrderBy = "ORDER BY c.data DESC";
switch ($Sort) {
    case 'oldest': $OrderBy = "ORDER BY c.data ASC"; break;
    case 'best':   $OrderBy = "ORDER BY c.nota_avaliacao DESC, c.data DESC"; break;
    case 'worst':  $OrderBy = "ORDER BY c.nota_avaliacao ASC, c.data DESC"; break;
}

// Buscar o slug do jogo, para passar no link
$slug = "";
$stmtSlug = $conn->prepare("SELECT slug FROM jogo WHERE id = ?");
$stmtSlug->bind_param("i", $gameId);
$stmtSlug->execute();
$resultSlug = $stmtSlug->get_result();
if ($resultSlug && $rowSlug = $resultSlug->fetch_assoc()) {
    $slug = $rowSlug['slug'];
}
$stmtSlug->close();

// Função para buscar a URL do avatar pelo id
function getAvatarUrl($avatarId, $avatars) {
    foreach ($avatars as $av) {
        if ($av['id'] == $avatarId) {
            return $av['url'];
        }
    }
    // Retorna o primeiro avatar como fallback
    return $avatars[0]['url'] ?? '';
}

// Buscar os comentários
$stmt = $conn->prepare("
  SELECT c.id_com, c.texto, c.nota_avaliacao, u.nome, u.avatar
  FROM comentario c
  JOIN usuario u ON c.id_usuario = u.id
  WHERE c.id_jogo = ? $OrderBy
");

if (!$stmt) {
    die("Erro: " . $conn->error);
}

$stmt->bind_param("i", $gameId);
$stmt->execute();
$result = $stmt->get_result();

$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nome_usuario = htmlspecialchars($row['nome']) ?: "Usuário";
        $texto_comentario = nl2br(htmlspecialchars($row['texto']));
        $numero_estrelas = intval($row['nota_avaliacao']) ?: 0;
        $stars = str_repeat("★", $numero_estrelas);
        $idComentario = intval($row['id_com']);

        $avatarId = intval($row['avatar']);
        $avatarUrl = getAvatarUrl($avatarId, $avatars);

        echo "<p class='comment-paragraph rounded-2 bg-body-secondary p-3 mt-4 text-wrap d-flex justify-content-between align-items-end position-relative'>
            <span>
                <img src='" . htmlspecialchars($avatarUrl) . "' alt='Avatar de {$nome_usuario}' style='width:32px; height:32px; border-radius:50%; object-fit:cover;'>
                <strong>{$nome_usuario}:</strong><br>
                {$texto_comentario}<br>
                <span class='star-commentPost'>{$stars}</span>
            </span>";          

        if ($isAdmin) {
            // Passa o slug no link junto com id_com
            $slugUrl = urlencode($slug);
            echo "<a href='src/actions/comentario/excluir_comentario.php?id_com={$idComentario}&slug={$slugUrl}' class='btn btn-sm btn-danger ms-3' style='align-self:flex-end;' onclick=\"return confirm('Deseja realmente excluir este comentário?');\">Remover</a>";
        }

        echo "</p>";
    }
} else {
    echo "Nenhum comentário encontrado.";
}

$stmt->close();
$conn->close();
?>
