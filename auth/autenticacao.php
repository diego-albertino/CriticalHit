<?php
$usuario = $_POST['username'];
$senha = $_POST['pass'];
function loginRedir() {
    header ('Location: ../index.html');
    exit();
}
function loginFailed() {
    header ('Location: ../login.php?error=1');
    exit();
}
$localhostbd = "localhost";
$usernamebd = "root";
$password = "";
$database = "criticalhit";

$mysqli = new mysqli($localhostbd, $usernamebd, $password, $database);
$stmt = $mysqli->prepare("SELECT senha FROM usuario WHERE nome = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($senha_hash);
    $stmt->fetch();

    if (password_verify($senha, $senha_hash)) {
        loginRedir();
    } else {
        loginFailed();
    }
} else {
    loginFailed();
}
?>