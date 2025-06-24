<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
$solicitado = isset($_GET['sucesso']) && $_GET['sucesso'] == 1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Solicitar Inclusão de Jogo</title>
  <link rel="icon" href="assets/pictures/favicon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="assets/css/jogo.css" />
  <link rel="stylesheet" href="assets/css/modal.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div id="navbar-container"></div>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Solicitar Inclusão de um Jogo</h2>

    <?php if ($solicitado): ?>
  <div class="alert alert-success mx-auto text-center" role="alert" style="max-width: 500px;">
    Solicitação enviada com sucesso!
  </div>
    <?php endif; ?>

    <form action="src/actions/solicitacao_jogo/salvar_solicitacao.php" method="POST" class="mx-auto" style="max-width: 600px;">
      <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>" />
      
      <div class="mb-3">
        <label for="titulo" class="form-label">Título do Jogo</label>
        <input type="text" class="form-control" id="titulo" name="titulo_solicitado" required>
      </div>

      <div class="mb-3">
        <label for="desc" class="form-label">Descrição (opcional)</label>
        <textarea class="form-control" id="desc" name="desc_solicitado" rows="4"></textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn" style="background-color: #fe5655; color: white;">Enviar Solicitação</button>
      </div>
    </form>
  </div>

  <div id="footer-container" class="mt-5"></div>

  <script>
  const phpUsername = "<?php echo $username; ?>";
  const isAdmin = <?php echo $isAdmin ? 'true' : 'false'; ?>;

  fetch("src/templates/navbar.html")
    .then(res => res.text())
    .then(data => {
      document.getElementById("navbar-container").innerHTML = data;

      const loginLink = document.getElementById("login-link");
      const loginText = document.getElementById("login-text");

      if (loginLink && loginText) {
        if (phpUsername !== "") {
          loginLink.href = "#";
          loginLink.innerHTML = `
            <span id="userMenuToggle" class="d-flex align-items-center text-dark"
              style="max-width: 150px; cursor: pointer; user-select: none; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
              <i class="bi bi-person-fill me-2"></i>${phpUsername}
            </span>
            <div id="userDropdown" class="position-absolute bg-white border rounded shadow-sm"
              style="min-width: 150px; left: 0; top: 100%; display: none; z-index: 1050;">
              <a href="meu_perfil.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">Meu perfil</a>
              ${
                isAdmin
                  ? '<a href="solicitacoes.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">Solicitações de jogos</a>'
                  : '<a href="solicitar_jogo.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">Solicitar um jogo</a>'
              }
              <hr class="my-1" />
              <a href="src/actions/logout.php" class="d-block px-3 py-2 text-decoration-none text-danger hover-bg-light">Sair</a>
            </div>
          `;

          loginLink.style.position = "relative";
          loginLink.style.display = "inline-block";

          const toggle = document.getElementById("userMenuToggle");
          const dropdown = document.getElementById("userDropdown");

          toggle.addEventListener("click", (e) => {
            e.preventDefault();
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
          });

          window.addEventListener("click", (e) => {
            if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
              dropdown.style.display = "none";
            }
          });
        } else {
          loginText.textContent = "Iniciar sessão";
          loginLink.setAttribute("href", "login.php");
        }
      }
    });
</script>


  <script>
    fetch("src/templates/footer.html")
      .then(response => response.text())
      .then(data => {
        document.getElementById("footer-container").innerHTML = data;
      });
  </script>
</body>
</html>
