<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

// Inclui o arquivo de conexão com o banco de dados
require_once 'src/config/db_connect.php';

// Acessa a ação de buscar jogos
require_once 'src/actions/jogo/buscar_jogos.php';

// Acessa a ação de calcular a nota de avaliação
require_once 'src/actions/jogo/calcular_nota_avaliacao.php';

// Calcula a nota de avaliação para os jogos
calcularNotaAvaliacao($conn);

// Busca todos os jogos do banco
$games = buscarTodosOsJogos($conn);

// Acessa a ação de buscar plataformas
require_once 'src/actions/plataforma/buscar_plataforma.php';

// Buscar plataformas do banco
$plataformas = buscarTodasAsPlataformas($conn);

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CriticalHit - Seu portal Nº1 de Avaliações de Jogos</title>
    <link rel="icon" href="assets/pictures/favicon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/index.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand navbar-logo d-flex align-items-center" href="index.php">
          <img src="assets/pictures/criticalogo.jpg" alt="Logo" class="me-2" id="logo" />
          <span id="critical">critical</span><span id="hit">hit</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
             <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gameCarousel">Destaques</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gameCarouse2">Plataformas</a>
            </li>         
          </ul>
          <form class="input-group d-flex w-80 me-3" id="search" method="GET" action="busca.php">
            <input 
              class="form-control box-search-input" 
              type="search" 
              name="palavra" 
              placeholder="Buscar críticas" 
              aria-label="Buscar" 
              required 
            />
            <button class="btn btn-danger" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </form>


          <?php if (isset($_SESSION['username'])): ?>
  <?php $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true; ?>
  <div class="ms-3 me-4 position-relative d-inline-block">
    <a href="#" id="userMenuToggle" class="nav-link d-flex align-items-center text-dark" style="cursor: pointer; user-select: none;">
      <i class="bi bi-person-fill me-2"></i>
      <?php echo htmlspecialchars($_SESSION['username']); ?>
    </a>
    <div id="userDropdown" class="position-absolute bg-white border rounded shadow-sm" style="min-width: 150px; right: 0; top: 100%; display: none; z-index: 1050;">
      <a href="meu_perfil.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">Meu perfil</a>

      <?php if ($isAdmin): ?>
        <a href="solicitacoes.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">Solicitações de jogos</a>
      <?php else: ?>
        <a href="solicitar_jogo.php" class="d-block px-3 py-2 text-decoration-none text-dark hover-bg-primary">Solicitar um jogo</a>
      <?php endif; ?>

      <hr class="my-1" />
      <a href="src/actions/logout.php" class="d-block px-3 py-2 text-decoration-none text-danger hover-bg-light">Sair</a>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('userMenuToggle');
    const dropdown = document.getElementById('userDropdown');

    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function(e) {
      if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>

  <style>
    #userDropdown a:hover {
      background-color: #dc3545;
      color: white !important;
    }

    #userDropdown a.text-danger:hover {
      background-color: #f8d7da;
      color: #dc3545 !important;
    }

    #userDropdown a:not(.text-danger):hover {
      background-color: #e9ecef;
      color: #212529 !important;
    }
  </style>

<?php else: ?>
  <a class="nav-link d-flex align-items-center" href="login.php" id="login" style="white-space: nowrap;">
    <i class="bi bi-person-fill me-1"></i>Iniciar sessão
  </a>
<?php endif; ?>


        </div>
      </div>
    </nav>
    <div class="container mt-4">
      <h4 class="d-flex justify-content-start">DESTAQUES</h4>
      <h3 class="d-flex justify-content-start"><strong>Avaliações</strong>­ dos melhores críticos</h3>
      <div id="gameCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          $chunked = array_chunk($games, 4); // 4 jogos por slide
          foreach ($chunked as $i => $gameGroup): ?>
            <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
              <div class="row">
                <?php foreach ($gameGroup as $game): ?>
                  <div class="col-md-3 game-card">
                    <a class="text-decoration-none" href="jogo.php?game=<?php echo htmlspecialchars($game['slug']); ?>">
                      <img src="<?php echo htmlspecialchars($game['url_img']); ?>" alt="<?php echo htmlspecialchars($game['nome']); ?>" />
                      <div class="game-info d-flex justify-content-between align-items-center">
                        <h5><?php echo htmlspecialchars($game['nome']); ?></h5>
                        <div class="stars">
                          <?php
                          $stars = intval($game['nota']); 
                          echo str_repeat('★', $stars);
                          ?>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#gameCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#gameCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="container mt-4">
      <h4 class="d-flex justify-content-start">PLATAFORMAS</h4>
      <h3 class="d-flex justify-content-start"><strong>Sua</strong>­ plataforma favorita aqui</h3>
      <div id="gameCarouse2" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          $chunked = array_chunk($plataformas, 4); // 4 jogos por slide
          foreach ($chunked as $i => $plataformaGroup): ?>
            <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
              <div class="row">
                <?php foreach ($plataformaGroup as $plataforma): ?>
                  <div class="col-md-3 game-card">
                    <a class="text-decoration-none">
                      <img src="<?php echo htmlspecialchars($plataforma['url_img']); ?>" alt="<?php echo htmlspecialchars($plataforma['nome']); ?>" />
                      <div class="game-info d-flex justify-content-between align-items-center">
                        <h5><?php echo htmlspecialchars($plataforma['nome']); ?></h5>
                      </div>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#gameCarouse2" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#gameCarouse2" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    </div>
    <div id="footer-container"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      fetch("src/templates/footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer-container").innerHTML = data;
        });
    </script>
  </body>
</html>