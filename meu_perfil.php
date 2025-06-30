<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include "src/config/db_connect.php";
$username = $_SESSION['username'];
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
$stmt = $conn->prepare("SELECT id, nome, email, avatar FROM usuario WHERE nome = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    // Se usuário não for encontrado, desloga ou redireciona
    session_destroy();
    header("Location: index.php");
    exit();
}
$avatars = json_decode(file_get_contents(__DIR__ . '/assets/avatars/avatars.json'), true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu Perfil</title>
  <link rel="icon" href="assets/pictures/favicon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="assets/css/jogo.css" />
  <link rel="stylesheet" href="assets/css/modal.css" />
  <style>
    body {
      background-color:rgb(255, 255, 255);
    }
    .profile-container {
      max-width: 700px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .avatar-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 10px;
      margin-top: 20px;
    }
    .avatar-grid label {
      text-align: center;
      cursor: pointer;
    }
    .avatar-grid img {
      width: 100%;
      max-width: 100px;
      border-radius: 50%;
      border: 3px solid #ccc;
      transition: transform 0.2s, border-color 0.2s;
      background-color: white;
    }
    .avatar-grid input[type="radio"]:checked + img {
      border-color: #007bff;
      transform: scale(1.05);
    }
  </style>
</head>
<body>
  <div id="navbar-container"></div>

  <div class="profile-container">
    <h2 class="text-center mb-4">Meu perfil</h2>

    <?php
if (isset($_SESSION['sucesso'])) {
    echo '<div class="alert alert-success mx-auto text-center" role="alert" style="max-width: 500px;">' .
         htmlspecialchars($_SESSION['sucesso']) .
         '</div>';
    unset($_SESSION['sucesso']);
}

if (isset($_SESSION['erro'])) {
    echo '<div class="alert alert-danger mx-auto text-center" role="alert" style="max-width: 500px;">' .
         htmlspecialchars($_SESSION['erro']) .
         '</div>';
    unset($_SESSION['erro']);
}
?>


    <!-- Dados Pessoais -->
    <section class="mb-5">
      <h4 class="mb-2">Dados Pessoais</h4>
      <form action="src/actions/usuario/alterar_dados.php" method="POST">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome de Usuário</label>
          <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-danger">Salvar</button>
      </form>
    </section>

    <!-- Segurança -->
    <section class="mb-5">
      <h4 class="mb-2">Segurança</h4>
      <form action="src/actions/usuario/alterar_senha.php" method="POST">
        <div class="mb-3">
          <label for="senha_atual" class="form-label">Senha Atual</label>
          <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
        </div>
        <div class="mb-3">
          <label for="nova_senha" class="form-label">Nova Senha</label>
          <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
        </div>
        <button type="submit" class="btn btn-danger">Alterar Senha</button>
      </form>
    </section>

    <!-- Avatar -->
    <section class="mb-5">
      <h4 class="mb-2">Avatar</h4>
      <form method="POST" action="src/actions/usuario/salvar_avatar.php">
        <div class="avatar-grid">
  <?php foreach ($avatars as $avatar): ?>
    <label>
      <input type="radio" name="avatar" value="<?= $avatar['id'] ?>" style="display:none" <?= ($usuario['avatar'] == $avatar['id']) ? 'checked' : '' ?>>
      <img src="<?= $avatar['url'] ?>" alt="Avatar <?= $avatar['id'] ?>">
    </label>
  <?php endforeach; ?>
</div>
        <div class="text-center mt-3">
          <button type="submit" class="btn btn-danger">Salvar Avatar</button>
        </div>
      </form>
    </section>

    <!-- Excluir Conta -->
    <section>
      <h4 class="text-danger mb-2">Excluir Conta</h4>
      <form action="src/actions/usuario/excluir_conta.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Essa ação não pode ser desfeita.')">
        <button type="submit" class="btn btn-dark ">Excluir Minha Conta</button>
      </form>
    </section>
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

    fetch("src/templates/footer.html")
      .then(response => response.text())
      .then(data => {
        document.getElementById("footer-container").innerHTML = data;
      });
  </script>
</body>
</html>
