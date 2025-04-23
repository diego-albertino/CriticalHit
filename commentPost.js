const textComment = document.getElementById("comment");
const form = document.getElementById("modal");
const commentPost = document.getElementById("commentPost");

form.addEventListener("submit", (event) => {
  event.preventDefault();

  let p = document.createElement("p");
  p.classList = "rounded-2 bg-body-secondary p-3 w-100 mt-4 text-wrap";
  p.innerHTML = `<div class="comment-paragraph"><i class="bi bi-person-circle">&nbsp </i><strong>Usuário: </strong><br> ${textComment.value}<br><span class="star-commentPost">${"★".repeat(localStorage.getItem("selectedRating"))}</span></div>`;
  commentPost.appendChild(p);
  textComment.value = ""; // Limpa o campo de comentário após o envio
  localStorage.removeItem("selectedRating"); // Remove a classificação após o envio do comentário
});
