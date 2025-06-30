<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}

include "../../config/db_connect.php";

$username = $_SESSION['username'];

// Exclui o usuário da tabela
$stmt = $conn->prepare("DELETE FROM usuario WHERE nome = ?");
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    session_destroy();
    header("Location: ../../../index.php?msg=conta_excluida");
    exit();
} else {
    $_SESSION['erro'] = "Erro ao excluir conta.";
    header("Location: ../../../meu_perfil.php");
    exit();
}
