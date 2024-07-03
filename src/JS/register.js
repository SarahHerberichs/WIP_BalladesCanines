document.addEventListener("DOMContentLoaded", function () {
  const btnClose = document.querySelector(".close-register");

  btnClose.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.href = "index.php";
  });
});
