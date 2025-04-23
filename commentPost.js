const textComment = document.getElementById("comment");
const form = document.getElementById("modal");
const commentPost = document.getElementById("commentPost");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  let p = document.createElement("p");
  p.classList = "p-2 text-wrap";
  p.innerHTML = `<i class="bi bi-person-circle">&nbsp </i><strong>Usuário: </strong>&nbsp ${textComment.value}&nbsp <br> <span class="star-commentPost">${"★".repeat(localStorage.getItem("selectedRating"))}</span>`;
  commentPost.appendChild(p);
  textComment.value = ""; // Limpa o campo de comentário após o envio
});
