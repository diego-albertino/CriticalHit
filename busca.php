<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "criticalhit";
$conn = new mysqli($host, $usuario, $senha, $banco);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Busca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="p-4">
    <div class="container">
        <div class="logo mb-3">
            <a href="index.php" class="text-decoration-none" style="color: inherit;" title="Voltar para a página inicial">
                <img src="assets/pictures/criticalogo.jpg" alt="CriticalHit" width="50"> <span>critical</span>hit
            </a>
        </div>
        <form method="get" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="palavra" placeholder="Buscar palavra chave" />
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <?php
        $palavra = isset($_GET['palavra']) ? $conn->real_escape_string($_GET['palavra']) : '';

        if (!empty($palavra)) {
            echo "<h5>Resultados para [ " . htmlspecialchars($palavra) . " ]</span></h5><hr>";

            $sql = "SELECT * FROM comentario WHERE texto LIKE '%$palavra%'";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                echo '<div class="row">';
                while ($linha = $resultado->fetch_assoc()) {
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <p class="card-text" > id: <?= nl2br(htmlspecialchars($linha['id_com'])) ?></p>
                                <p class="card-text">crítica: <?= nl2br(htmlspecialchars($linha['texto'])) ?></p>
                                <p class="card-text">nota: <?= nl2br(htmlspecialchars($linha['nota_avaliacao'])) ?></p>
                                <p class="card-text">data: <?= nl2br(htmlspecialchars($linha['data'])) ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="src/actions/gerenciamento_busca_comentario/atualizar.php?id_com=<?= $linha['id_com'] ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-pencil-square"></i> Atualizar
                                </a>
                                <a href="src/actions/gerenciamento_busca_comentario/deletar.php?id_com=<?= $linha['id_com'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir esta crítica?')">
                                    <i class="bi bi-trash"></i> Deletar
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            } else {
                echo "<p>Nenhuma crítica encontrada.</p>";
            }
        } else {
            echo "<p>Digite uma palavra para buscar.</p>";
        }

        $conn->close();
        ?>
        
    </div>
</body>
</html>
