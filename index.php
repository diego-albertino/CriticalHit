<?php
session_start();

$client_id = 'llchwugououejhoe70hroapigu7mwh';
$access_token = 'wj9ka9jk8459rma6tuy408huijmiem';
$url = 'https://api.igdb.com/v4/covers';

$body = "fields url,game; limit 16;";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Client-ID: $client_id",
    "Authorization: Bearer $access_token",
    "Accept: application/json"
]);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

$response = curl_exec($ch);

$images = [];
if (!curl_errno($ch)) {
    $images = json_decode($response, true);
}

curl_close($ch);

// Busca os nomes dos jogos usando os IDs retornados
$gameNames = [];
$gameIds = [];
foreach ($images as $img) {
    if (isset($img['game'])) {
        $gameIds[] = $img['game'];
    }
}
$gameIds = array_unique($gameIds);

if (!empty($gameIds)) {
    $gamesUrl = 'https://api.igdb.com/v4/games';
    $gamesBody = 'where id = ('.implode(',', $gameIds).'); fields id, name;';
    $chGames = curl_init($gamesUrl);
    curl_setopt($chGames, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chGames, CURLOPT_HTTPHEADER, [
        "Client-ID: $client_id",
        "Authorization: Bearer $access_token",
        "Accept: application/json"
    ]);
    curl_setopt($chGames, CURLOPT_POST, true);
    curl_setopt($chGames, CURLOPT_POSTFIELDS, $gamesBody);
    $gamesResponse = curl_exec($chGames);
    if (!curl_errno($chGames)) {
        $games = json_decode($gamesResponse, true);
        foreach ($games as $game) {
            $gameNames[$game['id']] = $game['name'];
        }
    }
    curl_close($chGames);
}
?>
<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CriticalHit - Seu portal Nº1 de Avaliações de Jogos</title>
    <link rel="icon" href="pictures/favicon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand navbar-logo d-flex align-items-center" href="index.php">
          <img src="pictures/criticalogo.jpg" alt="Logo" class="me-2" id="logo" />
          <span id="critical">critical</span><span id="hit">hit</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Plataformas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Lançamentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Destaques</a>
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
          <div class="carousel-item active">
            <div class="row">
              <?php foreach (array_slice($images, 0, 4) as $img):
                $url = isset($img['url']) ? str_replace('t_thumb', 't_cover_big', $img['url']) : '';
                $fullUrl = $url ? 'https:' . $url : '';
                $gameName = isset($gameNames[$img['game']]) ? $gameNames[$img['game']] : 'Nome desconhecido';
              ?>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="#">
                  <img src="<?php echo htmlspecialchars($fullUrl); ?>" alt="Jogo da API" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5><?php echo htmlspecialchars($gameName); ?></h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <?php foreach (array_slice($images, 4, 4) as $img):
                $url = isset($img['url']) ? str_replace('t_thumb', 't_cover_big', $img['url']) : '';
                $fullUrl = $url ? 'https:' . $url : '';
                $gameName = isset($gameNames[$img['game']]) ? $gameNames[$img['game']] : 'Nome desconhecido';
              ?>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="#">
                  <img src="<?php echo htmlspecialchars($fullUrl); ?>" alt="Jogo da API" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5><?php echo htmlspecialchars($gameName); ?></h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
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
      <div id="gameCarouse2" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <?php foreach (array_slice($images, 8, 4) as $img):
                $url = isset($img['url']) ? str_replace('t_thumb', 't_cover_big', $img['url']) : '';
                $fullUrl = $url ? 'https:' . $url : '';
                $gameName = isset($gameNames[$img['game']]) ? $gameNames[$img['game']] : 'Nome desconhecido';
              ?>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="#">
                  <img src="<?php echo htmlspecialchars($fullUrl); ?>" alt="Jogo da API" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5><?php echo htmlspecialchars($gameName); ?></h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row">
              <?php foreach (array_slice($images, 12, 4) as $img):
                $url = isset($img['url']) ? str_replace('t_thumb', 't_cover_big', $img['url']) : '';
                $fullUrl = $url ? 'https:' . $url : '';
                $gameName = isset($gameNames[$img['game']]) ? $gameNames[$img['game']] : 'Nome desconhecido';
              ?>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="#">
                  <img src="<?php echo htmlspecialchars($fullUrl); ?>" alt="Jogo da API" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5><?php echo htmlspecialchars($gameName); ?></h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
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

<div class="container mt-4">
      <h4 class="d-flex justify-content-start">PLATAFORMAS</h4>
      <h3 class="d-flex justify-content-start"><strong>Sua</strong>­ plataforma favorita aqui</h3>
      <div id="2gameCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=playstation-5">
                  <img src="pictures/ps5.png" alt="Playstation 5" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Playstation 5</h5>
                    <div class="stars">★★★★</div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=xbox-series">
                  <img src="pictures/xbox.png" alt="Xbox Series" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Xbox Series</h5>
                    <div class="stars">★★★★</div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=pc">
                  <img src="pictures/pc.png" alt="Pc" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>PC</h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 game-card">
                <a class="text-decoration-none" href="jogo.php?game=geforce-now">
                  <img src="pictures/geforce.png" alt="Geforce Now" />
                  <div class="game-info d-flex justify-content-between align-items-center">
                    <h5>Geforce Now</h5>
                    <div class="stars">★★★★★</div>
                  </div>
                </a>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-3 game-card">
                  <a class="text-decoration-none" href="jogo.php?game=nintendo">
                    <img src="pictures/nintendo.png" alt="Nintendo" />
                    <div class="game-info d-flex justify-content-between align-items-center">
                      <h5>Nintendo</h5>
                      <div class="stars">★★★</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#2gameCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#2gameCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
    <div id="footer-container"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      fetch("footer.html")
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("footer-container").innerHTML = data;
        });
    </script>
  </body>
</html>
