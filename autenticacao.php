<?php
$usuario = $_POST['username'];
$senha = $_POST['pass'];
function loginRedir($EMAIL) {
    header ('Location: login_sucess.php?email='. urlencode($EMAIL));
    exit();
}
function loginFailed() {
    header ('Location: index.php?nome=error');
    exit();
}
$localhostbd = "localhost";
$usernamebd = "root";
$password = "";
$database = "criticalhit";

$mysqli = new mysqli($localhostbd, $usernamebd, $password, $database);
$stmt = $mysqli->prepare("SELECT senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $EMAIL);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($senha_hash);
    $stmt->fetch();

    if (password_verify($SENHA, $senha_hash)) {
        loginRedir($EMAIL);
    } else {
        loginFailed();
    }
} else {
    loginFailed();
}
?>