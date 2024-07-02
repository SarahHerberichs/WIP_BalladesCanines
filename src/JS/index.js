document.addEventListener("DOMContentLoaded", function () {
  console.log("hellooo");
  // Gestion du scroll pour afficher annonces
  scrollX();
  // Map rempli des coordonnées des walks
  mapLeaflet();
  // Pop-up d'ajout d'annonce
  popUp();
  walkByRegion();
  // Ecouteur d'événements pour les liens .selected_walk_link
  document.addEventListener("click", function (e) {
    //Si la cible est le lien, recuperer son id et appel fonction popupclicked
    if (e.target && e.target.classList.contains("selected_walk_link")) {
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
        "<a href='#' class='selected_walk_link' data-walk-id='" +
        walk.id +
        "'>annonce</a>"
    );
  });
}
//Scroll sur les annonces affichées en haut de page
function scrollX() {
  var walkList = document.getElementById("walk_list");
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
// Ouverture de popup pour poster une annonce
function popUp() {
  let postwalkLink = document.querySelector(".post_walk_link");
  let postwalkBox = document.querySelector(".post_walk_box");

  postwalkLink.addEventListener("click", function (event) {
    event.preventDefault();
    // Empêcher la propagation de l'événement à travers les éléments enfants
    event.stopPropagation();

    if (postwalkBox.classList.contains("invisible")) {
      postwalkBox.classList.remove("invisible");

      // Si click sur la page Fermer la boîte d'annonce en dehors de celle-ci
      document.addEventListener("click", closeBoxOutside);
    } else {
      //Si click sur l'emplacement et qu'il était visible
      postwalkBox.classList.add("invisible");
      // Retirer l'evenement qui ferme la boîte d'annonce au click en dehors de celle-ci
      document.removeEventListener("click", closeBoxOutside);
    }
  });
}

function closeBoxOutside(e) {
  let postwalkBox = document.querySelector(".post_walk_box");
  // Si la cible du click n'est pas la postwalkBox, on la cache
  if (!postwalkBox.contains(e.target)) {
    postwalkBox.classList.add("invisible");
    document.removeEventListener("click", closeBoxOutside);
  }
}
//Ouverture de l'annonce selectionnée par l'USER
function popUpwalkClicked(walkId, walkList) {
  console.log(walkId);
  let titleWalkClicked = document.querySelector(".title_walkClicked");
  let textWalkClicked = document.querySelector(".text_walkClicked");
  let cityWalkClicked = document.querySelector(".city_walkClicked");
  let popupWalkClicked = document.querySelector(".popup_walkClicked");
  let btnClose = document.querySelector(".closeBtn");

  for (let i = 0; i < walkList.length; i++) {
    if (walkList[i].id == walkId) {
      titleWalkClicked.textContent = walkList[i].title;
      textWalkClicked.textContent = walkList[i].text;
      cityWalkClicked.textContent = walkList[i].city;

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
  const regions = document.querySelectorAll(".region_btn");
  regions.forEach((region) => {
    const regionId = region.dataset.regionId;
    region.addEventListener("click", function () {
      const page = "consult_walks"; // ou 'post_walks' selon votre besoin
      const url = `?page=${page}&region=${regionId}#`;
      window.location.href = url;
    });
  });
}
function handleUrlChange() {
  const urlParams = new URLSearchParams(window.location.search);
  const page = urlParams.get("page");
  const regionId = urlParams.get("region");

  if (page === "consult_walks" && regionId) {
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
