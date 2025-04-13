<?php
if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
}
if (isset($_GET['contaCriada'])) {
    $contaCriada = $_GET['contaCriada'];
}
if (isset($_GET['contaJaCriada'])) {
    $contaJaCriada = $_GET['contaJaCriada'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="pictures/favicon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="logo mb-3">
        <img src="pictures/criticalogo.jpg" alt="CriticalHit" width="50"> <span>critical</span>hit
    </div>
    <div class="login-container">
        <h3 class="mb-4">Que bom vê-lo novamente</h3>
        <?php if (isset($nome)):?>
            <div class="alert alert-danger" role="alert">
                Credenciais Incorretas!
            </div>
            <?php endif; ?>
        <i class="bi bi-person-fill"></i>
        <form action="autenticacao.php" method="POST">
        <input type="username" class="form-control mb-3" placeholder="Usuário" id="user" name="username" required>
        <i class="bi bi-key-fill"></i>
        <input type="password" class="form-control mb-3" placeholder="Senha" id="pass" name="pass" required>
        <button class="btn btn-google btn-lg w-100" type="submit">Continuar</button>
        </form>
        <div class="text-center mt-3">
            <p>Não tem uma conta? <a href="cadastro.php">Crie uma</a></p>
    </div>
</body>
</html>
