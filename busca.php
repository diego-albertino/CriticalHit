<?php
session_start();
include_once 'src/config/db_connect.php';
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Busca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body class="p-4">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand navbar-logo d-flex align-items-center" href="index.php">
                <img src="assets/pictures/criticalogo.jpg" alt="Logo" class="me-2" id="logo" />
                <span id="critical">critical</span><span id="hit">hit</span>
            </a>
            <form method="get" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="palavra" placeholder="Buscar palavra chave" />
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </nav>
    <div class="container">
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
                                <p class="card-text">crítica: <?= nl2br(htmlspecialchars($linha['texto'])) ?></p>
                                <p class="card-text">nota: <?= nl2br(htmlspecialchars($linha['nota_avaliacao'])) ?></p>
                                <p class="card-text">data: <?= nl2br(htmlspecialchars($linha['data'])) ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <?php if ($isAdmin): ?>
                                    <a href="src/actions/gerenciamento_busca_comentario/atualizar.php?id_com=<?= $linha['id_com'] ?>" class="btn btn-sm btn-danger">
                                        <i class="bi bi-pencil-square"></i> Atualizar
                                    </a>
                                    <a href="src/actions/gerenciamento_busca_comentario/deletar.php?id_com=<?= $linha['id_com'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir esta crítica?')">
                                        <i class="bi bi-trash"></i> Deletar
                                    </a>
                                <?php else: ?>
                                    <a href="src/actions/gerenciamento_busca_comentario/atualizar.php?id_com=<?= $linha['id_com'] ?>" class="btn btn-sm btn-danger d-none btn-atualizar" data-user="<?= $linha['id_usuario'] ?>">
                                        <i class="bi bi-pencil-square"></i> Atualizar
                                    </a>
                                    <a href="src/actions/gerenciamento_busca_comentario/deletar.php?id_com=<?= $linha['id_com'] ?>" class="btn btn-sm btn-danger d-none btn-deletar" data-user="<?= $linha['id_usuario'] ?>" onclick="return confirm('Deseja realmente excluir esta crítica?')">
                                        <i class="bi bi-trash"></i> Deletar
                                    </a>
                                <?php endif; ?>
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
    <script>
        // Só executa se não for admin
        <?php if (!$isAdmin): ?>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('src/actions/usuario/get_user_id.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const userId = data.user_id;
                        // Exibe botões apenas para comentários do usuário logado
                        document.querySelectorAll('.btn-atualizar, .btn-deletar').forEach(btn => {
                            if (btn.dataset.user == userId) {
                                btn.classList.remove('d-none');
                            }
                        });
                    }
                });
        });
        <?php endif; ?>
    </script>
</body>
</html>
