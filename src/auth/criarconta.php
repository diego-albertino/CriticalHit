<?php
//Inclui o arquivo de conexão com o banco de dados
require_once __DIR__ . '/../config/db_connect.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['username'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $senha = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    // Verifica se o e-mail ou username já estão em uso
    $sqlCheck = "SELECT * FROM usuario WHERE email = ? OR nome = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("ss", $email, $username);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        header("Location: ../../cadastro.php?contaJaCriada=true&nome=$nome");
        exit();
    } else {
        // Insere os dados no banco de dados
        $sqlInsert = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("sss", $nome, $email, $senha);

        if ($stmtInsert->execute()) {
            header("Location: ../../login.php?contaCriada=true&nome=$nome");
            exit();
        } else {
            header("Location:  ../../cadastro.php?error=true&nome=$nome");
            exit();
        }

        $stmtInsert->close();
    }

    $stmtCheck->close();
}

$conn->close();
?>