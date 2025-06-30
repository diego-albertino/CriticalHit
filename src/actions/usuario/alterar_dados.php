<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}

include "../../config/db_connect.php";

$username = $_SESSION['username'];
$novoNome = trim($_POST['nome'] ?? '');
$novoEmail = trim($_POST['email'] ?? '');

if (empty($novoNome) || empty($novoEmail) || !filter_var($novoEmail, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erro'] = "Nome e email válidos são obrigatórios.";
    header("Location: ../../../meu_perfil.php");
    exit();
}

// Atualiza nome e email no banco
$stmt = $conn->prepare("UPDATE usuario SET nome = ?, email = ? WHERE nome = ?");
$stmt->bind_param("sss", $novoNome, $novoEmail, $username);

if ($stmt->execute()) {
    $_SESSION['username'] = $novoNome; // Atualiza sessão se mudou nome
    $_SESSION['sucesso'] = "Dados pessoais atualizados com sucesso.";
} else {
    $_SESSION['erro'] = "Erro ao atualizar dados.";
}
$stmt->close();
$conn->close();

header("Location: ../../../meu_perfil.php");
exit();
