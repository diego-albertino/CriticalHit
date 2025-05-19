const textComment = document.getElementById("comment");
const form = document.getElementById("modal");
const commentPost = document.getElementById("commentPost");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // Impede o envio padrão do formulário

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
      alert(data); // Ou exibe a resposta em um alerta

      // Se o comentário foi salvo com sucesso, adiciona à interface
      if (data.includes("Comentário salvo com sucesso")) {
        // Verifica a mensagem de sucesso
        let p = document.createElement("p");
        p.classList = "rounded-2 bg-body-secondary p-3 w-100 mt-4 text-wrap";
        // Você pode querer buscar o nome do usuário da sessão PHP ou de outra forma
        // em vez de "Usuário" fixo se a página não for recarregada.
        // Por enquanto, vamos manter o comportamento anterior para a exibição local.
        const ratingValue = formData.get("rating"); // Pega o valor do rating do FormData
        p.innerHTML = `<div class="comment-paragraph"><i class="bi bi-person-circle">&nbsp </i><strong>Usuário: </strong><br> ${textComment.value}<br><span class="star-commentPost">${"★".repeat(ratingValue || 0)}</span></div>`;
        commentPost.appendChild(p);
        textComment.value = ""; // Limpa o campo de comentário
        // Não é mais necessário usar localStorage para rating aqui se o form o envia diretamente
        // localStorage.removeItem("selectedRating");
        // Limpar as estrelas e fechar o modal pode ser feito aqui ou no modal.js
        // como já está sendo feito.
      }
    })
    .catch((error) => {
      console.error("Erro ao enviar o comentário:", error);
      alert("Ocorreu um erro ao enviar seu comentário.");
    });
});
