// Dados dos jogos
const games = {
  "stardew-valley": {
    title: "Stardew Valley",
    image: "pictures/stardew.png",
    description: "Um simulador de fazenda relaxante e viciante.",
    rating: "★★★★★",
  },
  "nfs-heat": {
    title: "Need For Speed Heat",
    image: "pictures/nfs.png",
    description: "Corridas emocionantes em alta velocidade.",
    rating: "★★",
  },
  "silent-hill-2": {
    title: "Silent Hill 2",
    image: "pictures/silent.png",
    description: "Um clássico do terror psicológico.",
    rating: "★★★★",
  },
  "spider-man-2": {
    title: "Spider-Man 2",
    image: "pictures/spider.png",
    description: "Aventura épica com o Homem-Aranha.",
    rating: "★★★",
  },

  "elden-ring-nightreign": {
    title: "Elden Ring Nightreign",
    image: "pictures/elden.png",
    description: "Uma jornada épica em um mundo aberto.",
    rating: "★★★★★",
  },
  "death-stranding-2": {
    title: "Death Stranding 2",
    image: "pictures/death.png",
    description: "Uma experiência única de entrega e conexão.",
    rating: "★★★★",
  },
  "call-of-duty": {
    title: "Call of Duty",
    image: "pictures/cod.png",
    description: "Um dos maiores jogos de tiro em primeira pessoa.",
    rating: "★★★",
  },
  "deliver-at-all-costs": {
    title: "Deliver At All Costs",
    image: "pictures/deliver.png",
    description: "Um jogo de entrega em um mundo pós-apocalíptico.",
    rating: "★★★",
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
        <h1>${game.title}</h1>
        <img src="${game.image}" alt="${game.title}" />
        <p>${game.description}</p>
        <div class="rating">Avaliação: ${game.rating}</div>
      `;
  } else {
    // Caso o jogo não seja encontrado
    document.getElementById("game-details").innerHTML = `
        <h1>Jogo não encontrado</h1>
        <p>O jogo que você está procurando não existe.</p>
      `;
  }
}

// Chamar a função ao carregar a página
window.onload = loadGameDetails;
