<?php
session_start();
$username = $_SESSION['username'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalhes do Jogo</title>
    <link rel="icon" href="pictures/favicon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="jogo.css" />
    <link rel="stylesheet" href="modal.css" />
  </head>
  <body>
    <div id="navbar-container"></div>
    <!-- Contêiner para a navbar -->

    <div class="container">
      <div id="game-details">
        <!-- Os detalhes do jogo serão carregados aqui -->
      </div>

      <!-- Mini-janela para fazer os comentários -->
      <form id="modal" class="modal hidden" action="salvar_comentario.php" method="POST">
        <div class="modal-content">
          <span class="close" onclick="closeModal()">×</span>
          <div class="usuario d-flex align-items-center">
            <i class="bi bi-person-circle"></i>
            <p><strong><?php echo $username ? htmlspecialchars($username) : 'Usuário'; ?></strong></p>
          </div>
          <div class="stars" id="star-container">
            <span data-value="1">★</span>
            <span data-value="2">★</span>
            <span data-value="3">★</span>
            <span data-value="4">★</span>
            <span data-value="5">★</span>
          </div>

          <input type="hidden" name="game_id" id="game_id" value="1" />
          <input type="hidden" name="user_id" id="user_id" value="1" />
          <input type="hidden" name="platform_id" id="platform_id" value="1" />
          <input type="hidden" name="rating" id="rating_value" value="0" />

          <textarea name="comment" id="comment" placeholder="Descreva sua experiência (opcional)"></textarea>
          <button id="submit-button" aria-label="Enviar avaliação" type="submit">ENVIAR</button>
        </div>
      </form>
      <!-- Fim da mini-janela -->

      <!-- Barra de visualização dos comentários -->
      <div class="d-flex justify-content-center">
        <div class="mt-2" id="commentPost">
          <h5 class="text-center">
            <!-- Aqui os comentários serão carregados usando o script -->
             
          </h5>
        </div>
      </div>
    </div>
    <div id="footer-container"></div>

    <script>
      // Carregar a navbar dinamicamente
      const phpUsername = "<?php echo $username; ?>";
      fetch("navbar.html")   
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("navbar-container").innerHTML = data;

        // Manipular os elementos depois que a navbar for carregada
        const nomeUsuario = sessionStorage.getItem("username");

        const loginLink = document.getElementById("login-link");
        const loginText = document.getElementById("login-text");

        // Verifique se os elementos existem antes de manipulá-los
        if (loginLink && loginText) {
          if (phpUsername !== "") {
            loginText.textContent = phpUsername;
            loginLink.setAttribute("href", "meu_perfil.php");
          } else {
            loginText.textContent = "Iniciar sessão";
            loginLink.setAttribute("href", "login.php");
          }
        } else {
          console.log("Os elementos de login não foram encontrados.");
        }
      })
      .catch((error) => {
        console.log("Erro ao carregar a navbar: ", error);
      });
    </script>
    <script src="jogo.js"></script>
    <script src="modal.js"></script>
    <script src="commentPost.js"></script>
    <script>
      fetch("footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer-container").innerHTML = data;
        });
    </script>
  </body>
</html>
