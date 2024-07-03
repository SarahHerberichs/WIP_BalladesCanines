document.addEventListener("DOMContentLoaded", function () {
  // Gestion du scroll pour afficher annonces
  scrollX();
  // Map rempli des coordonnées des walks
  mapLeaflet();

  walkByRegion();
  // Ecouteur d'événements pour les liens .selected-walk-link
  document.addEventListener("click", function (e) {
    //Si la cible est le lien, recuperer son id et appel fonction popupclicked
    if (e.target && e.target.classList.contains("selected-walk-link")) {
      e.preventDefault();
      let walkId = e.target.getAttribute("data-walk-id");
      popUpwalkClicked(walkId, walkData);
    }
  });
});
/////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FONCTIONS//////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

//Rempli carte
function mapLeaflet() {
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("fr-FR", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
    });
  }

  var map = L.map("map").setView([48.8566, 2.3522], 6); // Coordonnées et niveau de zoom initial
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors",
  }).addTo(map);

  walkData.forEach((walk) => {
    var marker = L.marker([walk.latitude, walk.longitude]).addTo(map);
    marker.bindPopup(
      "<b>" +
        walk.title +
        "</b><br>" +
        formatDate(walk.date.date) +
        "<br>" +
        "<a href='#' class='selected-walk-link' data-walk-id='" +
        walk.id +
        "'>annonce</a>"
    );
  });
}
//Scroll sur les annonces affichées en haut de page
function scrollX() {
  var walkList = document.getElementById("walk-list");
  var startX;
  var scrollLeft;

  walkList.addEventListener("touchstart", function (e) {
    startX = e.touches[0].pageX;
    scrollLeft = walkList.scrollLeft;
  });

  walkList.addEventListener("touchmove", function (e) {
    if (!startX) return;
    var x = (e.touches[0].pageX - startX) * 2; // Multiplier par 2 pour un défilement plus rapide
    walkList.scrollLeft = scrollLeft - x;
  });

  walkList.addEventListener("touchend", function () {
    startX = null;
  });
}

//Ouverture de l'annonce selectionnée par l'USER
function popUpwalkClicked(walkId, walkList) {
  let titleWalkClicked = document.querySelector(".title-walkClicked");
  let textWalkClicked = document.querySelector(".text-walkClicked");
  let cityWalkClicked = document.querySelector(".city-walkClicked");
  let popupWalkClicked = document.querySelector(".popup-walkClicked");
  let conversation = document.querySelector(".conversation");
  let inputHidden = document.querySelector("#walk-id");
  let btnClose = document.querySelector(".close-walkClicked");

  for (let i = 0; i < walkList.length; i++) {
    if (walkList[i].id == walkId) {
      titleWalkClicked.textContent = walkList[i].title;
      textWalkClicked.textContent = walkList[i].text;
      cityWalkClicked.textContent = walkList[i].city;
      //Injecter l'id de la walk dans le hidden et laisser le form faire son job
      inputHidden.textContent = walkList[i].id;

      // Affiche la popup
      popupWalkClicked.style.display = "block";
      console.log("Annonce trouvée :", walkList[i]);
      btnClose.addEventListener("click", function () {
        popupWalkClicked.style.display = "none";
      });
      break; // Sort de la boucle une fois l'annonce trouvée
    }
  }
  //Au click sur une region, parcours de walkData et affiche les walk
  //Qui ont walk.region = à la valeur de la region clickée
}
function walkByRegion() {
  const regions = document.querySelectorAll(".region-btn");
  regions.forEach((region) => {
    const regionId = region.dataset.regionId;
    region.addEventListener("click", function () {
      const page = "consult_walks"; // ou 'post-walks' selon votre besoin
      const url = `?page=${page}&region=${regionId}#`;
      window.location.href = url;
    });
  });
}
function handleUrlChange() {
  const urlParams = new URLSearchParams(window.location.search);
  const page = urlParams.get("page");
  const regionId = urlParams.get("region");

  if (page === "consult-walks" && regionId) {
    console.log(`Afficher les annonces pour la région avec ID ${regionId}`);
  } else {
    console.log("Page ou région non spécifiée");
  }
}

// Écouter les changements d'ancre dans l'URL
window.onhashchange = function () {
  handleUrlChange();
};

// Appel initial pour gérer l'état initial de l'URL lors du chargement de la page
handleUrlChange();
