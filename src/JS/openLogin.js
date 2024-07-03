document.addEventListener("DOMContentLoaded", function () {
  const loginPopUp = document.querySelector(".login-page");
  const userMsgs = document.querySelectorAll(".error-msg");
  const btnClose = document.querySelector(".close-login");
  const userIcon = document.querySelector(".fa-user-large");

  // Affiche popup si des messages d'erreur existent
  if (Array.from(userMsgs).some((msg) => msg.innerText.trim() !== "")) {
    loginPopUp.classList.remove("invisible");
  }

  function toggleLoginPopup() {
    loginPopUp.classList.toggle("invisible");
  }

  userIcon.addEventListener("click", toggleLoginPopup);

  btnClose.addEventListener("click", function (e) {
    e.preventDefault();
    toggleLoginPopup();
  });
});
