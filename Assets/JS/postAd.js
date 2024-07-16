document.addEventListener("DOMContentLoaded", function () {
  popUp();
});

function popUp() {
  let postAdLink = document.querySelector(".post-ad-link");
  let postAdBox = document.querySelector(".post-ad-box");
  let btnClose = document.querySelector(".btn-close");
  if (postAdLink !== null) {
    postAdLink.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      if (postAdBox.classList.contains("invisible")) {
        postAdBox.classList.remove("invisible");
      }
    });
  }

  btnClose.addEventListener("click", function () {
    {
      if (!postAdBox.classList.contains("invisible")) {
        postAdBox.classList.add("invisible");
      }
    }
  });
}
