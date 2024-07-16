document.addEventListener("DOMContentLoaded", function () {
  console.log(hikeData);
  // Gestion du scroll pour afficher annonces
  scrollX();
  // Map rempli des coordonnées des hikes
  mapLeaflet();

  hikeByRegion();

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("selected-hike-link")) {
      e.preventDefault();
      let hikeId = e.target.getAttribute("data-hike-id");
      popUpHikeClicked(hikeId, hikeData);
    }
  });
});

/////////////////////////////////////////////////////////////////////////////
//////////////////////////////////FONCTIONS//////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
//innerHTML permet de passer en HTML visible, au cas ou l'encodage JSON aurait mené a probleme de caract.
function decodeHTMLEntities(text) {
  var textArea = document.createElement("textarea");
  textArea.innerHTML = text;
  return textArea.value;
}

function mapLeaflet() {
  if (document.getElementById("map")._leaflet_id) {
    return; // Carte déjà initialisée
  }

  var map = L.map("map").setView([48.8566, 2.3522], 6);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "&copy; OpenStreetMap contributors",
  }).addTo(map);

  var hikeIcon = L.icon({
    iconUrl: "../../Files/images/chaussure_rando.png",
    iconSize: [20, 33],
    iconAnchor: [10, 33],
    popupAnchor: [1, -30],
  });

  hikeData.forEach((hike) => {
    var marker = L.marker([hike.latitude, hike.longitude], {
      icon: hikeIcon,
    }).addTo(map);
    marker.bindPopup(
      "<b>" +
        decodeHTMLEntities(hike.title) +
        "</b><br> Date de la rando : " +
        formatDate(hike.date) +
        "<br>" +
        "Localisation : " +
        hike.cityName +
        "<br>" +
        "Difficulté : " +
        "<div class='progress-bar difficulty-" +
        hike.level +
        "'>" +
        "<span class='progress-bar-fill'> </span>" +
        "</div>" +
        // hike.level +

        "<br>" +
        "<a href='#' class='selected-hike-link' data-hike-id='" +
        hike.id +
        "'>voir plus</a>"
    );
  });
}

function formatDate(dateString) {
  const options = {
    day: "2-digit",
    month: "long", // Utilisation de "long" pour afficher le mois en lettres
    year: "numeric",
  };

  const date = new Date(dateString);
  if (isNaN(date.getTime())) {
    return "Date invalide";
  }

  return date.toLocaleDateString("fr-FR", options);
}
function scrollX() {
  var hikeList = document.getElementById("hike-list");
  var startX;
  var scrollLeft;

  hikeList.addEventListener("touchstart", function (e) {
    startX = e.touches[0].pageX;
    scrollLeft = hikeList.scrollLeft;
  });

  hikeList.addEventListener("touchmove", function (e) {
    if (!startX) return;
    var x = (e.touches[0].pageX - startX) * 2;
    hikeList.scrollLeft = scrollLeft - x;
  });

  hikeList.addEventListener("touchend", function () {
    startX = null;
  });
}

function popUpHikeClicked(hikeId, hikeList) {
  let titleHikeClicked = document.querySelector(".title-hikeClicked");
  let usernameHikeClicked = document.querySelector(".username-hikeClicked");
  let createdAtHikeClicked = document.querySelector(".createdAt-hikeClicked");
  let textHikeClicked = document.querySelector(".text-hikeClicked");
  let elevationGainHikeClicked = document.querySelector(
    ".elevationGain-hikeClicked"
  );
  let levelHikeClicked = document.querySelector(".level-hikeClicked");
  let distanceHikeClicked = document.querySelector(".distance-hikeClicked");
  let encounteredDifficultiesHikeClicked = document.querySelector(
    ".encounteredDifficulties-hikeClicked"
  );
  let waterPointHikeClicked = document.querySelector(".waterPoint-hikeClicked");
  let cityHikeClicked = document.querySelector(".city-hikeClicked");
  let dateHikeClicked = document.querySelector(".date");
  let popupHikeClicked = document.querySelector(".popup-hikeClicked");
  let btnClose = document.querySelector(".close-hikeClicked");

  titleHikeClicked.textContent = "Titre : ";
  usernameHikeClicked.textContent = "Utilisateur : ";
  createdAtHikeClicked.textContent = "Créé le : ";
  textHikeClicked.textContent = "Annonce : ";
  elevationGainHikeClicked.textContent = "Dénivelé : ";
  levelHikeClicked.textContent = "Niveau : ";
  distanceHikeClicked.textContent = "Distance : ";
  encounteredDifficultiesHikeClicked.textContent = "Difficultés rencontrées : ";
  waterPointHikeClicked.textContent = "Points d'eau : ";
  cityHikeClicked.textContent = "Localisation : ";
  dateHikeClicked.textContent = "Rando du : ";

  for (let i = 0; i < hikeList.length; i++) {
    if (hikeList[i].id == hikeId) {
      titleHikeClicked.textContent += decodeHTMLEntities(hikeList[i].title);
      usernameHikeClicked.textContent += decodeHTMLEntities(
        hikeList[i].userName
      );
      createdAtHikeClicked.textContent += formatDate(hikeList[i].createdAt);
      textHikeClicked.textContent += decodeHTMLEntities(hikeList[i].text);
      elevationGainHikeClicked.textContent += hikeList[i].elevationGain + " m";
      levelHikeClicked.textContent += hikeList[i].level;
      distanceHikeClicked.textContent += hikeList[i].distance + " km";
      encounteredDifficultiesHikeClicked.textContent += decodeHTMLEntities(
        hikeList[i].encounteredDifficulties
      );
      waterPointHikeClicked.textContent += hikeList[i].waterPoint
        ? "Oui"
        : "Non";
      cityHikeClicked.textContent += decodeHTMLEntities(hikeList[i].cityName);
      dateHikeClicked.textContent += formatDate(hikeList[i].date);

      popupHikeClicked.style.display = "block";

      btnClose.addEventListener("click", function () {
        popupHikeClicked.style.display = "none";
      });
      break;
    }
  }
}

function hikeByRegion() {
  const regions = document.querySelectorAll(".region-btn");
  regions.forEach((region) => {
    const regionId = region.dataset.regionId;
    region.addEventListener("click", function () {
      const page = "consult_hikes";
      const url = `?page=${page}&region=${regionId}#`;
      window.location.href = url;
    });
  });
}

function handleUrlChange() {
  const urlParams = new URLSearchParams(window.location.search);
  const page = urlParams.get("page");
  const regionId = urlParams.get("region");

  if (page === "consult-hikes" && regionId) {
    console.log(`Afficher les annonces pour la région avec ID ${regionId}`);
  } else {
    console.log("Page ou région non spécifiée");
  }
}

window.onhashchange = function () {
  handleUrlChange();
};

handleUrlChange();
