// document.addEventListener("DOMContentLoaded", function () {
//   // Récupérer l'élément input date
//   const dateInput = document.getElementById("date");

//   // Créer une fonction pour formater la date en format YYYY-MM-DD
//   function formatDate(date) {
//     const d = new Date(date);
//     let month = "" + (d.getMonth() + 1);
//     let day = "" + d.getDate();
//     const year = d.getFullYear();

//     if (month.length < 2) month = "0" + month;
//     if (day.length < 2) day = "0" + day;

//     return [year, month, day].join("-");
//   }

//   // Définir la valeur par défaut de l'input date au chargement de la page
//   dateInput.value = formatDate(new Date()); // Utilise la fonction formatDate avec la date actuelle
// });
