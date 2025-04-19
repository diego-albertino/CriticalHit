const textComment = document.getElementById("comment");
const form = document.getElementById("modal");
const commentPost = document.getElementById("commentPost");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  let p = document.createElement("p");
  p.classList = "p-2 d-flex text-wrap";
  p.innerHTML = `<strong>Usuário: </strong>&nbsp ${textComment.value}&nbsp <br><strong>Avaliação: </strong>&nbsp ${localStorage.getItem("selectedRating")}`;
  commentPost.appendChild(p);
  textComment.value = ""; // Limpa o campo de comentário após o envio
});
