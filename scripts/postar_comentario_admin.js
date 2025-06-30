const textComment = document.getElementById("comment");
const form = document.getElementById("modal");
const commentPost = document.getElementById("commentPost");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  if (phpUsername === "") {
    alert("Você precisa estar logado para comentar.");
    window.location.href = "login.php";
    return;
  }

  if (textComment.value.trim() === "") {
    alert("Por favor, escreva um comentário.");
    return;
  }

  const formData = new FormData(form);

  fetch("src/actions/comentario/salvar_comentario.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data.includes("Comentário salvo com sucesso")) {
        let p = document.createElement("p");
        p.className = "comment-paragraph rounded-2 bg-body-secondary p-3 mt-4 text-wrap d-flex justify-content-between align-items-end position-relative";

        const numero_estrelas = formData.get("rating");
        const texto_comentario_original = formData.get("comment"); 
        const texto_comentario_formatado = texto_comentario_original.replace(/\n/g, "<br>");
        const nome_usuario = phpUsername || "Usuário";

        const idComentarioFake = Date.now(); // Simula um id

        p.innerHTML = `
          <span>
            <img src="${userAvatarUrl}" alt="Avatar" style="width:32px; height:32px; border-radius:50%; object-fit:cover;">
            <strong>${nome_usuario}: </strong><br>
            ${texto_comentario_formatado}<br>
            <span class="star-commentPost">${"★".repeat(numero_estrelas || 0)}</span>
          </span>
          <button class="btn-excluir-comentario btn btn-sm btn-danger ms-3 disabled" data-id="${idComentarioFake}" style="align-self:flex-end;">Recarregue a página para alterar ou remover.</button>
        `;

        commentPost.appendChild(p);
        textComment.value = "";
        closeModal();
        zeroStars();
      } else {
        alert(data);
      }
    })
    .catch((error) => {
      console.error("Erro ao enviar o comentário:", error);
      alert("Ocorreu um erro ao enviar seu comentário.");
    });
});

function carregarComentariosExistentes(gameId, Sort = "newest") {
  const commentPostDiv = document.getElementById("commentPost");
  if (!commentPostDiv) return;

  const formData = new FormData();
  formData.append("game_id", gameId);
  formData.append("sort", Sort);

  fetch("src/actions/comentario/carregar_comentarios_admin.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((html) => {
      commentPostDiv.innerHTML = html;
    })
    .catch(() => {
      commentPostDiv.innerHTML = '<p class="text-danger">Erro ao carregar comentários.</p>';
    });
}
