document.addEventListener("DOMContentLoaded", function () {
  // Gestion du scroll pour afficher annonces
  scrollX();
  // Map rempli des coordonnées des Ads
  mapLeaflet();
  // Pop-up d'ajout d'annonce
  popUp();
  adByRegion();
  // Ecouteur d'événements pour les liens .selected_ad_link
  document.addEventListener("click", function (e) {
    //Si la cible est le lien, recuperer son id et appel fonction popupadclicked
    if (e.target && e.target.classList.contains("selected_ad_link")) {
      e.preventDefault();
      let adId = e.target.getAttribute("data-ad-id");
      popUpAdClicked(adId, adData);
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

  adData.forEach((ad) => {
    var marker = L.marker([ad.latitude, ad.longitude]).addTo(map);
    marker.bindPopup(
      "<b>" +
        ad.title +
        "</b><br>" +
        formatDate(ad.date.date) +
        "<br>" +
        "<a href='#' class='selected_ad_link' data-ad-id='" +
        ad.id +
        "'>annonce</a>"
    );
  });
}
//Scroll sur les annonces affichées en haut de page
function scrollX() {
  var adList = document.getElementById("ad_list");
  var startX;
  var scrollLeft;

  adList.addEventListener("touchstart", function (e) {
    startX = e.touches[0].pageX;
    scrollLeft = adList.scrollLeft;
  });

  adList.addEventListener("touchmove", function (e) {
    if (!startX) return;
    var x = (e.touches[0].pageX - startX) * 2; // Multiplier par 2 pour un défilement plus rapide
    adList.scrollLeft = scrollLeft - x;
  });

  adList.addEventListener("touchend", function () {
    startX = null;
  });
}
// Ouverture de popup pour poster une annonce
function popUp() {
  let postAdLink = document.querySelector(".post_ad_link");
  let postAdBox = document.querySelector(".post_ad_box");

  postAdLink.addEventListener("click", function (event) {
    event.preventDefault();
    // Empêcher la propagation de l'événement à travers les éléments enfants
    event.stopPropagation();

    if (postAdBox.classList.contains("invisible")) {
      postAdBox.classList.remove("invisible");

      // Si click sur la page Fermer la boîte d'annonce en dehors de celle-ci
      document.addEventListener("click", closeBoxOutside);
    } else {
      //Si click sur l'emplacement et qu'il était visible
      postAdBox.classList.add("invisible");
      // Retirer l'evenement qui ferme la boîte d'annonce au click en dehors de celle-ci
      document.removeEventListener("click", closeBoxOutside);
    }
  });
}

function closeBoxOutside(e) {
  let postAdBox = document.querySelector(".post_ad_box");
  // Si la cible du click n'est pas la postAdBox, on la cache
  if (!postAdBox.contains(e.target)) {
    postAdBox.classList.add("invisible");
    document.removeEventListener("click", closeBoxOutside);
  }
}
//Ouverture de l'annonce selectionnée par l'USER
function popUpAdClicked(adId, adList) {
  let titleAdClicked = document.querySelector(".titleAdClicked");
  let textAdClicked = document.querySelector(".textAdClicked");
  let cityAdClicked = document.querySelector(".cityAdClicked");
  let popupAdClicked = document.querySelector(".popupAdClicked");
  let btnClose = document.querySelector(".closeBtn");

  for (let i = 0; i < adList.length; i++) {
    if (adList[i].id == adId) {
      titleAdClicked.textContent = adList[i].title;
      textAdClicked.textContent = adList[i].text;
      cityAdClicked.textContent = adList[i].city;

      // Affiche la popup
      popupAdClicked.style.display = "block";

      console.log("Annonce trouvée :", adList[i]);
      btnClose.addEventListener("click", function () {
        popupAdClicked.style.display = "none";
      });
      break; // Sort de la boucle une fois l'annonce trouvée
    }
  }
  //Au click sur une region, parcours de adData et affiche les ad
  //Qui ont ad.region = à la valeur de la region clickée
}
function adByRegion() {
  const region = document.querySelectorAll(".region_btn");
  console.log(region);
  const regionId = region.dataset.regionId;
  region.addEventListener("click", function () {
    console.log(regionId);
  });
}
