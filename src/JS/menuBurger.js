// On récupère le bouton et le menu
let boutonBurger = document.querySelector(".boutonBurger");
let menuBurger = document.querySelector(".menuBurger");

// On récupère les spans du menu Hamburger
let span1 = document.querySelector(".span1");
let span2 = document.querySelector(".span2");
let span3 = document.querySelector(".span3");

// On récupère les éléments du menu
let elts = document.querySelectorAll(".elt");

// On créer une fonction pour ouvrir et fermer le menu
function toggleMenu() {
  menuBurger.classList.toggle("menuBurgerOpen");
  span1.classList.toggle("span1Open");
  span2.classList.toggle("span2Open");
  span3.classList.toggle("span3Open");
}

// On créer un écouteur d'événements sur le bouton qui utilise cette fonction
boutonBurger.addEventListener("click", toggleMenu);

// On ajoute cette fonction sur chaque élément du menu
for (let i = 0; i < elts.length; i++) {
  elts[i].addEventListener("click", toggleMenu);
}

// Récupération de l'élément dropdown
let dropdown = document.getElementById("userDropdown");

// Ajout d'un écouteur d'événements sur l'icône utilisateur
dropdown.addEventListener("click", function () {
  this.querySelector(".dropdown-content").classList.toggle("show");
});

// // Fermer le menu déroulant si l'utilisateur clique en dehors de celui-ci
// window.addEventListener("click", function (event) {
//   if (!event.target.matches(".fa-user-large")) {
//     let dropdowns = document.getElementsByClassName("dropdown-content");
//     for (let i = 0; i < dropdowns.length; i++) {
//       let openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains("show")) {
//         openDropdown.classList.remove("show");
//       }
//     }
//   }
// });

// // Récupération du lien de déconnexion
// let btnDeconnexion = document.getElementById("btn-deconnexion");

// // Ajout d'un écouteur d'événements sur le lien de déconnexion
// btnDeconnexion.addEventListener("click", function (event) {
//   event.preventDefault(); // Empêche le comportement par défaut du lien (redirection vers #)

//   // Appel AJAX pour déconnecter côté serveur
//   fetch("../../Controllers/logout_ctrl.php")
//     .then((response) => {
//       console.log("Fetch response:", response);
//       if (response.ok) {
//         // Redirection après déconnexion
//         window.location.href = "?page=home"; // Redirige vers la page d'accueil après déconnexion
//       } else {
//         console.error("Erreur lors de la déconnexion");
//       }
//     })
//     .catch((error) => console.error("Erreur lors de la déconnexion :", error));
// });
