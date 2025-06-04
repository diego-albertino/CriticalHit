<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "criticalhit";
$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$id = isset($_GET['id_com']) ? intval($_GET['id_com']) : 0;
$mensagem = "";

// Atualizar crítica
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $texto = $conn->real_escape_string($_POST['texto']);
    $sql = "UPDATE comentario SET texto = '$texto' WHERE id_com = $id";
    if ($conn->query($sql)) {
        $mensagem = "Crítica atualizada com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar: " . $conn->error;
    }
}

// Buscar dados da crítica atual
$sql = "SELECT * FROM comentario WHERE id_com = $id";
$resultado = $conn->query($sql);
$comentario = $resultado->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Crítica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>
<body class="bg-light">

<div class="logo mb-3">
            <a href="../../index.php" class="text-decoration-none" style="color: inherit;" title="Voltar para a página inicial">
                <img src="../../assets/pictures/criticalogo.jpg" alt="CriticalHit" width="50"> <span>critical</span>hit
            </a>
        </div>

    <div class="container py-5">
        <h2 class="mb-4">Atualizar Crítica</h2>

        <?php if ($mensagem): ?>
            <div class="alert alert-info"><?= $mensagem ?></div>
        <?php endif; ?>

        <?php if ($comentario): ?>
            <form method="post">
                <div class="mb-3">
                    <label for="texto" class="form-label">Texto da crítica</label>
                    <textarea name="texto" id="texto" rows="6" class="form-control"><?= htmlspecialchars($comentario['texto']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="../../busca.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">Crítica não encontrada.</div>
        <?php endif; ?>
    </div>
    <div id="footer-container"></div>
</body>
</html>

