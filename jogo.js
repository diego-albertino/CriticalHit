// variavel para armazenar os dados dos jogos
const games = {
  game_id: "",
  title: "",
  image: "",
  description: "",
  rating: "",
};

/**
 * Busca os detalhes do jogo a partir do slug na URL e faz uma requisição
 * para obter os dados do jogo.
 */
function fetchGameDetails() {
  const params = new URLSearchParams(window.location.search);
  const slug = params.get("game"); // Recebe o slug do jogo através do parâmetro 'game' da URL

  // Acessa o arquivo PHP que faz a requisição ao banco de dados
  fetch(`pagina_jogo.php?slug=${encodeURIComponent(slug)}`)
    .then((response) => response.json())
    .then((data) => {
      games.game_id = data.id;
      games.title = data.nome;
      games.image = data.url_img;
      games.description = data.descricao;
      games.rating = data.nota;
      loadGameDetails();
    })
    .catch((error) => console.error(error));
}

// Função para carregar os detalhes do jogo
function loadGameDetails() {
  const gameDetails = document.getElementById("game-details");

  // Renderizar os detalhes do jogo
  gameDetails.innerHTML = `
    <div class="game-container">
        <img src="${games.image}" alt="${games.title}" class="game-image" />
        <div class="game-info">
            <h1 class="game-title">${games.title}</h1>
            <p class="game-description">${games.description}</p>
            <div class="rating">${"★".repeat(games.rating)}</div>
        </div>
    </div>
    <div class="comment-container">
        <button type="button" class="btn btn-comentar btn-lg" onclick="OpenModal()">Comentar</button>
    </div>
    <div class="d-flex justify-content-end dropdown">
      <button id="filter-button" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-funnel"></i> Ordenar por
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" id="sort-newest">Mais recentes</a></li>
        <li><a class="dropdown-item" href="#" id="sort-oldest">Menos recentes</a></li>
        <li><a class="dropdown-item" href="#" id="sort-best">Melhores avaliações</a></li>
        <li><a class="dropdown-item" href="#" id="sort-worst">Piores avaliações</a></li>
      </ul>
    </div>
    `;
}

// Chamar a função ao carregar a página
window.onload = fetchGameDetails;
