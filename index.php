<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "criticalhit"; 

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


// Buscar jogos do banco
$sql = "SELECT * FROM jogo ORDER BY id DESC"; 
$result = $conn->query($sql);
$games = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $games[] = $row;
  }
}

// Buscar plataformas do banco
$sql = "SELECT * FROM plataforma ORDER BY id DESC"; 
$result = $conn->query($sql);
$plataformas = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $plataformas[] = $row;
  }
}

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
          <form class="input-group d-flex me-5" id="search" method="GET" action="busca.php">
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
            <a class="nav-link input-group" href="meu_perfil.php" id="perfil">
              <span class="me-1"><i class="bi bi-person-fill"></i><?php echo $_SESSION['username']; ?></span>
            </a>
          <?php else: ?>
            <a class="nav-link input-group" href="login.php" id="login">
              <span class="me-1"><i class="bi bi-person-fill"></i>Iniciar sessão</span>
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
      <h4 class="d-flex justify-content-start">LANÇAMENTOS</h4>
      <h3 class="d-flex justify-content-start"><strong>Confira</strong>­ novos títulos</h3>
      <div id="1gameCarouse3" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=grand-theft-auto-vi">
                  <img src="assets/pictures/gta.png" alt="Grand Theft Auto VI" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Grand Theft Auto VI</h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=death-stranding-2">
                  <img src="assets/pictures/death.png" alt="Death Stranding 2" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Death Stranding 2</h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=deliver-at-all-costs">
                  <img src="assets/pictures/deliver.png" alt="Deliver At All Costs" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Deliver At All Costs</h5>
                    <div class="stars">★★★★</div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=elden-ring-nightreign">
                  <img src="assets/pictures/elden.png" alt="Elden Ring Nightreign" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Elden Ring Nightreign</h5>
                    <div class="stars">★★★★</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=call-of-duty">
                  <img src="assets/pictures/cod.png" alt="Call of Duty" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Call of Duty</h5>
                    <div class="stars">★★</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#1gameCarouse3" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#1gameCarouse3" data-bs-slide="next">
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
                        <div class="stars">
                          <?php
                          $stars = intval($plataforma['nota']); 
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