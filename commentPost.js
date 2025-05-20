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
      alert(data); // Exibe a resposta do servidor (o "echo") em um alerta

      // Se o comentário foi salvo com sucesso, adiciona à interface
      if (data.includes("Comentário salvo com sucesso")) {
        let p = document.createElement("p");
        p.classList = "rounded-2 bg-body-secondary p-3 w-100 mt-4 text-wrap";
        const numero_estrelas = formData.get("rating");
        const texto_comentario = formData.get("comment");
        const nome_usuario = phpUsername || "Usuário";

        p.innerHTML = `<div class="comment-paragraph"><i class="bi bi-person-circle">&nbsp </i><strong>${nome_usuario}: </strong><br> ${texto_comentario}<br><span class="star-commentPost">${"★".repeat(numero_estrelas || 0)}</span></div>`;
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
