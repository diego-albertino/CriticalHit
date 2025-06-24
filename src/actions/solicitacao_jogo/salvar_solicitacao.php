<?php
include "../../config/db_connect.php";

$username = $_POST['username'] ?? '';
$titulo = $_POST['titulo_solicitado'] ?? '';
$desc = $_POST['desc_solicitado'] ?? '';

$stmt_user = $conn->prepare("SELECT id FROM usuario WHERE nome = ?");
$stmt_user->bind_param("s", $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user && $result_user->num_rows > 0) {
    $row = $result_user->fetch_assoc();
    $id_usuario = $row['id'];

    // Inserir solicitação
    $stmt = $conn->prepare("INSERT INTO solicitacao_jogo (id_usuario, titulo_solicitado, desc_solicitado) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id_usuario, $titulo, $desc);

    if ($stmt->execute()) {
        header("Location: ../../../solicitar_jogo.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao enviar solicitação: " . $stmt->error;
    }

} else {
    echo "Usuário não encontrado.";
}
$stmt_user->close();
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>
