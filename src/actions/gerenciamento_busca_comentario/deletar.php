<?php
include_once '../../config/db_connect.php';

$id = isset($_GET['id_com']) ? intval($_GET['id_com']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM comentario WHERE id_com = $id";
    if ($conn->query($sql)) {
        $mensagem = "Crítica excluída com sucesso.";
    } else {
        $mensagem = "Erro ao excluir: " . $conn->error;
    }
} else {
    $mensagem = "ID inválido.";
}

$conn->close();

header("Location: ../../../busca.php");
exit;
?>
