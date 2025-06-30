<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}

include "../../config/db_connect.php";

$username = $_SESSION['username'];
$avatarEscolhido = intval($_POST['avatar'] ?? 0);

if ($avatarEscolhido < 1 || $avatarEscolhido > 15) {
    $_SESSION['erro'] = "Avatar inválido.";
    header("Location: ../../../meu_perfil.php");
    exit();
}

$stmt = $conn->prepare("UPDATE usuario SET avatar = ? WHERE nome = ?");
$stmt->bind_param("is", $avatarEscolhido, $username);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = "Avatar atualizado com sucesso.";
} else {
    $_SESSION['erro'] = "Erro ao atualizar avatar.";
}

$stmt->close();
$conn->close();

header("Location: ../../../meu_perfil.php");
exit();
