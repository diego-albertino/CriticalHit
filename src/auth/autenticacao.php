<?php
session_start();
$usuario = $_POST['username'];
$senha = $_POST['pass'];

function loginRedir() {
    header('Location: ../../index.php');
    exit();
}

function loginFailed() {
    header('Location: ../../login.php?error=1');
    exit();
}

//Inclui o arquivo de conexão com o banco de dados
require_once __DIR__ . '/../config/db_connect.php';

$stmt = $conn->prepare("SELECT senha, is_superuser FROM usuario WHERE nome = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($senha_hash, $is_superuser);
    $stmt->fetch();

    if (password_verify($senha, $senha_hash)) {
        $_SESSION['username'] = $usuario;
        $_SESSION['pass'] = $senha;
        if ($is_superuser == 1) {
            $_SESSION['is_admin'] = true;
        }
        loginRedir();
    } else {
        loginFailed();
    }
} else {
    loginFailed();
}
?>
