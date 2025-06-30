<?php
session_start();
$username = $_SESSION['username'] ?? '';
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}
include 'src/config/db_connect.php';
$avatars = json_decode(file_get_contents(__DIR__ . '/assets/avatars/avatars.json'), true);
$username = $_SESSION['username'] ?? '';

$sql_avatar = "SELECT avatar FROM usuario WHERE nome = ?";
$stmt_avatar = $conn->prepare($sql_avatar);
$stmt_avatar->bind_param("s", $username);
$stmt_avatar->execute();
$stmt_avatar->bind_result($avatar_id);
$stmt_avatar->fetch();
$stmt_avatar->close();
$urlAvatar = '';

// Buscar a URL do avatar com base no ID
foreach ($avatars as $avatar) {
    if ($avatar['id'] == $avatar_id) {
        $urlAvatar = $avatar['url'];
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhes do Jogo</title>
    <link rel="icon" href="assets/pictures/favicon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/jogo.css" />
    <link rel="stylesheet" href="assets/css/modal.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div id="navbar-container"></div>
    
    <!-- Contêiner para a navbar -->

    <div class="container">
      <div id="game-details">
        <!-- Os detalhes do jogo serão carregados aqui -->
      </div>

      <!-- Mini-janela para fazer os comentários -->
      <form id="modal" class="modal hidden" action="src/actions/comentario/salvar_comentario.php" method="POST">
        <div class="modal-content">
          <span class="close" onclick="closeModal()">×</span>
          <div class="usuario d-flex align-items-center">
            <img src="<?php echo $urlAvatar; ?>" alt="Avatar" style="width:32px; height:32px; border-radius:50%; object-fit:cover;">
            <p><strong><?php echo $username ? htmlspecialchars($username) : 'Usuário'; ?></strong></p>
          </div>
          <div class="stars" id="star-container">
            <span data-value="1">★</span>
            <span data-value="2">★</span>
            <span data-value="3">★</span>
            <span data-value="4">★</span>
            <span data-value="5">★</span>
          </div>

          <input type="hidden" name="game_id" id="game_id" value="" />
          <input type="hidden" name="user_id" id="user_id" value="" />
          <input type="hidden" name="platform_id" id="platform_id" value="" />
          <input type="hidden" name="rating" id="rating_value" value="" />

          <textarea name="comment" id="comment" placeholder="Descreva sua experiência"></textarea>
          <button id="submit-button" aria-label="Enviar avaliação" type="submit">ENVIAR</button>
        </div>
      </form>
      <!-- Fim da mini-janela -->

      <!-- Barra de visualização dos comentários -->
      <div class="d-flex justify-content-center">
        <div class="mt-2" id="commentPost"></div>
      </div>
    </div>
    <div id="footer-container"></div>

    <script>
      fetch('src/actions/usuario/get_user_id.php')
        .then(response => response.json())
        .then(data => {
          if (data.success && data.user_id) {
            document.getElementById('user_id').value = data.user_id;
          }
        });
    </script>
    <script>
  // Carregar a navbar dinamicamente
  const phpUsername = "<?php echo $username; ?>";
fetch("src/templates/navbar.html")
  .then((response) => response.text())
  .then((data) => {
    document.getElementById("navbar-container").innerHTML = data;

    const loginLink = document.getElementById("login-link");
    const loginText = document.getElementById("login-text");

    if (loginLink && loginText) {
      if (phpUsername !== "") {
        // Usuário logado: transformar o link num dropdown

        loginLink.href = "#"; // Remove o link padrão

        loginLink.innerHTML = `
          <span id="userMenuToggle" class="d-flex align-items-center text-dark" 
    style="max-width: 150px; cursor: pointer; user-select: none; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
    <i class="bi bi-person-fill me-2"></i>${phpUsername}
  </span>
          <div id="userDropdown" class="position-absolute bg-white border rounded shadow-sm"
            style="min-width: 150px; left: 0; top: 100%; display: none; z-index: 1050;">
            <a href="meu_perfil.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">
              Meu perfil
            </a>
            <hr class="my-1" />
            <a href="src/actions/logout.php" class="d-block px-3 py-2 text-decoration-none text-danger hover-bg-light">
              Sair
            </a>
          </div>
        `;

        // Estilo para posicionar dropdown corretamente
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
        // Usuário não logado: manter padrão "Iniciar sessão"
        loginText.textContent = "Iniciar sessão";
        loginLink.setAttribute("href", "login.php");
        loginLink.style.position = "";
      }
    } else {
      console.log("Os elementos de login não foram encontrados.");
    }
  })
  .catch((error) => {
    console.log("Erro ao carregar a navbar: ", error);
  });
</script>
    <script>
      const userAvatarUrl = "<?php echo $urlAvatar; ?>";
    </script>
    <script src="scripts/jogo.js"></script>
    <script src="scripts/modal.js"></script>
    <?php if ($isAdmin): ?>
    <script src="scripts/postar_comentario_admin.js"></script>
    <?php else: ?>
    <script src="scripts/postar_comentario.js"></script>
    <?php endif; ?>
    <script>
      fetch("src/templates/footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer-container").innerHTML = data;
        });
    </script>
    

  </body>
</html>
