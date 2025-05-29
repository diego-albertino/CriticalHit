var num_star = 5; // Variável para definir o número de estrelas

const games = {
  "stardew-valley": {
    title: "Stardew Valley",
    image: "pictures/stardew.png",
    description: "Você herdou a antiga fazenda do seu avô, em Stardew Valley. Com ferramentas de segunda-mão e algumas moedas, você parte para dar início a sua nova vida. Será que você vai aprender a viver da terra, a transformar esse matagal em um próspero lar?",
    rating: "★".repeat(num_star), // repeat repete a string "★" de acordo com o valor de num_star
  },
  "nfs-heat": {
    title: "Need For Speed Heat",
    image: "pictures/nfs.png",
    description: "Trabalhe de dia e arrisque tudo à noite em Need for Speed™ Heat, um jogo eletrizante de corridas de rua, onde a lei desaparece com o pôr do sol.",
    rating: "★".repeat(num_star),
  },
  "silent-hill-2": {
    title: "Silent Hill 2",
    image: "pictures/silent.png",
    description: "Um clássico do terror psicológico.",
    rating: "★".repeat(num_star),
  },
  "spider-man-2": {
    title: "Spider-Man 2",
    image: "pictures/spider.png",
    description: "Aventura épica com o Homem-Aranha.",
    rating: "★".repeat(num_star),
  },

  "elden-ring-nightreign": {
    title: "Elden Ring Nightreign",
    image: "pictures/elden.png",
    description: "Uma jornada épica em um mundo aberto.",
    rating: "★".repeat(num_star),
  },
  "death-stranding-2": {
    title: "Death Stranding 2",
    image: "pictures/death.png",
    description: "Uma experiência única de entrega e conexão.",
    rating: "★".repeat(num_star),
  },
  "call-of-duty": {
    title: "Call of Duty",
    image: "pictures/cod.png",
    description: "Um dos maiores jogos de tiro em primeira pessoa.",
    rating: "★".repeat(num_star),
  },
  "deliver-at-all-costs": {
    title: "Deliver At All Costs",
    image: "pictures/deliver.png",
    description: "Um jogo de entrega em um mundo pós-apocalíptico.",
    rating: "★".repeat(num_star),
  },
};

// Função para carregar os detalhes do jogo
function loadGameDetails() {
  // Obter o parâmetro da URL
  const params = new URLSearchParams(window.location.search);
  const gameKey = params.get("game");

  // Verificar se o jogo existe nos dados
  if (games[gameKey]) {
    const game = games[gameKey];
    const gameDetails = document.getElementById("game-details");

    // Renderizar os detalhes do jogo
    gameDetails.innerHTML = `
    <div class="game-container">
        <img src="${game.image}" alt="${game.title}" class="game-image" />
        <div class="game-info">
            <h1 class="game-title">${game.title}</h1>
            <p class="game-description">${game.description}</p>
            <div class="rating">${game.rating}</div>
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
  } else {
    // Caso o jogo não seja encontrado
    document.getElementById("game-details").innerHTML = `
        <h2>Jogo não encontrado</h2>
      `;
  }
}

// Chamar a função ao carregar a página
window.onload = loadGameDetails;
