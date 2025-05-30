const textComment = document.getElementById("comment");
const form = document.getElementById("modal");
const commentPost = document.getElementById("commentPost");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // Impede o envio padrão do formulário

  //Verifica se o usuário está logado
  if (phpUsername === "") {
    alert("Você precisa estar logado para comentar.");
    window.location.href = "login.php";
    return;
  }

  // Verifica se o campo de comentário está vazio
  if (textComment.value.trim() === "") {
    alert("Por favor, escreva um comentário.");
    return;
  }

  // Coleta os dados do formulário
  const formData = new FormData(form);

  // Envia os dados para o servidor usando fetch
  fetch("salvar_comentario.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text()) // Obtém a resposta como texto
    .then((data) => {
      console.log(data); // Exibe a resposta do servidor (o "echo") no console
      if (data.includes("Erro ao salvar o comentário: ")) {
        alert(data); // Exibe a mensagem de erro do PHP
        return; // Interrompe a execução se houver erro
      }

      // Se o comentário foi salvo com sucesso, adiciona à interface
      if (data.includes("Comentário salvo com sucesso")) {
        let p = document.createElement("p");
        p.className = "comment-paragraph rounded-2 bg-body-secondary p-3 mt-4 text-wrap";

        const numero_estrelas = formData.get("rating");
        const texto_comentario_original = formData.get("comment");
        const texto_comentario_formatado = texto_comentario_original.replace(/\n/g, "<br>");
        const nome_usuario = phpUsername || "Usuário"; // phpUsername deve estar disponível globalmente

        // Montar o HTML interno do <p>
        p.innerHTML = `<i class="bi bi-person-circle">&nbsp;</i><strong>${nome_usuario}: </strong><br>${texto_comentario_formatado}<br><span class="star-commentPost">${"★".repeat(numero_estrelas || 0)}</span>`;

        commentPost.appendChild(p);
        textComment.value = ""; // Limpa o campo de texto do comentário

        closeModal(); // Fecha o modal
        zeroStars(); // Limpa as estrelas
      } else {
        alert(data); // Exibe a mensagem de erro do PHP
      }
    })
    .catch((error) => {
      console.error("Erro ao enviar o comentário:", error);
      alert("Ocorreu um erro ao enviar seu comentário.");
    });
});

function carregarComentariosExistentes(gameId) {
  const commentPostDiv = document.getElementById("commentPost");
  if (!commentPostDiv) {
    console.error("Elemento commentPost não encontrado.");
    return;
  }

  const formData = new FormData();
  formData.append("game_id", gameId);

  fetch("carregar_comentarios.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na rede ao carregar comentários: " + response.statusText);
      }
      return response.text();
    })
    .then((htmlComentarios) => {
      commentPostDiv.innerHTML = htmlComentarios;
    })
    .catch((error) => {
      console.error("Erro ao carregar comentários:", error);
      commentPostDiv.innerHTML = '<p class="text-center text-danger">Não foi possível carregar os comentários.</p>';
    });
}

document.addEventListener("DOMContentLoaded", () => {
  // Obtenha o gameId
  // Por enquanto, vou usar os valores dos campos hidden do modal,
  // mas idealmente, para a página do jogo, esses valores viriam de outra forma
  // (ex: da URL, ou de dados carregados com os detalhes do jogo).
  const gameIdInput = document.getElementById("game_id");

  const gameId = gameIdInput.value;

  if (gameId) {
    carregarComentariosExistentes(gameId);
  } else {
    console.warn("game_id não encontrado para carregar comentários.");
  }
});
