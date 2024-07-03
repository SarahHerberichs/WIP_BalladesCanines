document.addEventListener("DOMContentLoaded", function () {
  // Pop-up d'ajout d'annonce
  popUp();
});

function popUp() {
  let postwalkLink = document.querySelector(".post-walk-link");
  let postwalkBox = document.querySelector(".post-walk-box");
  let btnClose = document.querySelector(".close-postWalk");

  postwalkLink.addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    if (postwalkBox.classList.contains("invisible")) {
      postwalkBox.classList.remove("invisible");
    } else {
      postwalkBox.classList.add("invisible");
    }
  });

  btnClose.addEventListener("click", function () {
    {
      if (!postwalkBox.classList.contains("invisible")) {
        postwalkBox.classList.add("invisible");
      }
    }
  });
}
