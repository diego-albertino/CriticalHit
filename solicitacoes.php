<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit();
}

include "src/config/db_connect.php";

$nomeUsuario = $_SESSION['username'] ?? 'Usuário';
$isAdmin = true;
$solicitado = isset($_GET['sucesso']) && $_GET['sucesso'] == 1;


$sql_nao = "
  SELECT s.id_solicitacao, s.id_usuario, s.titulo_solicitado, s.desc_solicitado, u.nome AS nome_usuario
  FROM solicitacao_jogo s
  JOIN usuario u ON u.id = s.id_usuario
  WHERE s.solicitacao_atendida = 0
  ORDER BY s.titulo_solicitado ASC
";
$res_nao = $conn->query($sql_nao);
$count_nao = $res_nao->num_rows;

$sql_sim = "
  SELECT s.id_usuario, s.titulo_solicitado, s.desc_solicitado, u.nome AS nome_usuario
  FROM solicitacao_jogo s
  JOIN usuario u ON u.id = s.id_usuario
  WHERE s.solicitacao_atendida = 1
  ORDER BY s.titulo_solicitado ASC
";
$res_sim = $conn->query($sql_sim);
$count_sim = $res_sim->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Solicitações de Jogos</title>
  <link rel="icon" href="assets/pictures/favicon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="assets/css/jogo.css" />
  <link rel="stylesheet" href="assets/css/modal.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    @media (min-width: 992px) {
      .tables-wrapper {
        display: flex;
        gap: 2rem;
      }
      .tables-wrapper > div {
        flex: 1;
      }
    }
  </style>
</head>
<body>
  <div id="navbar-container"></div>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Solicitações de Inclusão de Jogo</h2>

    <?php if ($solicitado): ?>
      <div class="alert alert-success mx-auto text-center" role="alert" style="max-width: 500px;">
        Solicitação enviada com sucesso!
      </div>
    <?php endif; ?>

    <div class="tables-wrapper">
      <!-- Não atendidas -->
<div>
  <h4 class="mb-2">Não atendidas (<?= $count_nao ?>)</h4>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr>
          <th>Usuário</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($count_nao > 0): ?>
          <?php while ($r = $res_nao->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($r['nome_usuario']) ?></td>
              <td><?= htmlspecialchars($r['titulo_solicitado']) ?></td>
              <td><?= htmlspecialchars($r['desc_solicitado']) ?></td>
              <td>
                <a href="atender-solicitacao.php?id_solicitacao=<?= $r['id_solicitacao'] ?>"
                class="btn btn-sm btn-acao"
                title="Atender solicitação">
                <i class="fa-solid fa-magnifying-glass"></i>
              </a>
              <style>
                .btn-acao {
  border: 1px solid #fe5655;
  color: #fe5655;
  background-color: white;
  transition: all 0.2s ease-in-out;
}

.btn-acao:hover {
  background-color: #fe5655;
  color: white;
}

.btn-acao:hover i {
  color: white;
}

.btn-acao i {
  color: #fe5655;
  transition: color 0.2s;
}

              </style>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center">Nenhuma solicitação não atendida.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>


      <div>
        <h4 class="mb-2">Atendidas (<?= $count_sim ?>)</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="table-light">
              <tr><th>Usuário</th><th>Título</th><th>Descrição</th></tr>
            </thead>
            <tbody>
              <?php if ($count_sim > 0): ?>
                <?php while ($r = $res_sim->fetch_assoc()): ?>
                  <tr>
                    <td><?= htmlspecialchars($r['nome_usuario']) ?></td>
                    <td><?= htmlspecialchars($r['titulo_solicitado']) ?></td>
                    <td><?= htmlspecialchars($r['desc_solicitado']) ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr><td colspan="3" class="text-center">Nenhuma solicitação atendida.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="footer-container" class="mt-5"></div>

  <script>
    const nomeUsuario = <?= json_encode($nomeUsuario) ?>;
    const isAdmin = <?= $isAdmin ? 'true' : 'false' ?>;

    document.addEventListener("DOMContentLoaded", () => {

      fetch("src/templates/navbar.html")
        .then(res => res.text())
        .then(data => {
          document.getElementById("navbar-container").innerHTML = data;

          const loginLink = document.getElementById("login-link");
          if (loginLink) {
            loginLink.innerHTML = '';
            loginLink.style.position = "relative";

            const toggle = document.createElement("span");
            toggle.id = "userMenuToggle";
            toggle.className = "d-flex align-items-center text-dark";
            toggle.style.cssText = "max-width: 150px; cursor: pointer; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;";
            toggle.innerHTML = `<i class="bi bi-person-fill me-2"></i>${nomeUsuario}`;

            const dropdown = document.createElement("div");
            dropdown.id = "userDropdown";
            dropdown.className = "position-absolute bg-white border rounded shadow-sm";
            dropdown.style.cssText = "min-width:150px;left:0;top:100%;display:none;z-index:1050;";
            dropdown.innerHTML = `
              <a href="meu_perfil.php" class="d-block px-3 py-2 text-dark">Meu perfil</a>
              ${isAdmin
                ? '<a href="solicitacoes.php" class="d-block px-3 py-2 text-dark">Solicitações de jogos</a>'
                : '<a href="solicitar-jogo.php" class="d-block px-3 py-2 text-dark">Solicitar um jogo</a>'}
              <hr class="my-1"/>
              <a href="src/actions/logout.php" class="d-block px-3 py-2 text-danger">Sair</a>
            `;

            loginLink.appendChild(toggle);
            loginLink.appendChild(dropdown);

            toggle.addEventListener("click", e => {
              e.stopPropagation();
              dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            window.addEventListener("click", e => {
              if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
              }
            });
          }
        });


      fetch("src/templates/footer.html")
        .then(res => res.text())
        .then(data => {
          document.getElementById("footer-container").innerHTML = data;
        });
    });
  </script>
</body>
</html>
