/**
 * Cria estrelas clicáveis para avaliação.
 * Cada estrela tem um valor associado, de 1 a 5, e ao clicar em uma estrela,
 * ela e todas as estrelas anteriores ficam preenchidas.
 * O valor da estrela clicada é armazenado na variável selectedRating.
 */
const stars = document.querySelectorAll("#star-container span");
let selectedRating = 0;
const starValueInput = document.getElementById("rating_value");

/**
 * Adiciona um evento de clique a cada estrela.
 * Quando uma estrela é clicada, atualiza a avaliação selecionada e
 * chama a função updateStars para atualizar a aparência das estrelas.
 */
stars.forEach((star) => {
  star.addEventListener("click", () => {
    selectedRating = parseInt(star.getAttribute("data-value")); // Obtém o valor da estrela clicada
    localStorage.setItem("selectedRating", selectedRating); // Armazena no localStorage com a chave "selectedRating"
    if (starValueInput) {
      starValueInput.value = selectedRating;
    }
    updateStars(selectedRating); // Atualiza a aparência das estrelas
  });
});

/**
 * Atualiza a aparência das estrelas com base na avaliação selecionada.
 * Preenche as estrelas até o valor da avaliação e esvazia as restantes.
 */
function updateStars(rating) {
  stars.forEach((star) => {
    star.classList.toggle("active", parseInt(star.getAttribute("data-value")) <= rating);
  });
}

/**
 * Exibe o modal de avaliação.
 * O modal deve ter o ID 'modal' e deve ser exibido ao clicar no botão "comentar".
 */
function OpenModal() {
  const modal = document.getElementById("modal");
  modal.classList.remove("hidden"); // Exibe o modal
}

/**
 * Fecha o modal de avaliação.
 * O modal deve ter o ID 'modal' e deve ser ocultado ao clicar no botão "x".
 */
function closeModal() {
  const modal = document.getElementById("modal");
  modal.classList.add("hidden"); // Oculta o modal
}

/**
 * Envia a avaliação e o comentário do usuário.
 * Obtém o comentário do campo de entrada com o ID 'comment' e exibe
 * um alerta com a nota selecionada e o comentário fornecido pelo usuário.
 */
function submitComment() {
  const comment = document.getElementById("comment").value;
  alert(`Avaliação enviada!\nNota: ${selectedRating}\nComentário: ${comment}`);
}

/**
 * Limpa o campo de avaliação, removendo a classe "active" de todas as estrelas.
 */
function zeroStars() {
  stars.forEach((star) => {
    star.classList.remove("active");
  });
  if (starValueInput) {
    // Adicione esta verificação e a linha abaixo
    starValueInput.value = 0;
  }
}

/**
 * Adiciona os eventos de clique aos botões do modal.
 * closeModal() é chamado para fechar o modal.
 * zeroStars() é chamado para limpar a avaliação anterior.
 */
document.getElementById("submit-button").addEventListener("click", () => {
  closeModal();
  zeroStars();
});
