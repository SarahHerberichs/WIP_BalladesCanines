document.addEventListener("DOMContentLoaded", function () {
  // Gestion du scroll pour afficher annonces
  scrollX();
  // Map rempli des coordonnées des walks
  mapLeaflet();

  walkByRegion();

  document.addEventListener("click", function (e) {
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

  walkData.forEach((walk) => {
    var marker = L.marker([walk.latitude, walk.longitude]).addTo(map);
    marker.bindPopup(
      "<b>" +
        decodeHTMLEntities(walk.title) +
        "</b><br> le :" +
        formatDate(walk.date) +
        "<br>" +
        "à :" +
        walk.time +
        "<br>" +
        "<a href='#' class='selected-walk-link' data-walk-id='" +
        walk.id +
        "'>voir plus</a>" +
        "<br>" +
        "Localisation:" +
        walk.cityName
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
  var walkList = document.getElementById("walk-list");
  var startX;
  var scrollLeft;

  walkList.addEventListener("touchstart", function (e) {
    startX = e.touches[0].pageX;
    scrollLeft = walkList.scrollLeft;
  });

  walkList.addEventListener("touchmove", function (e) {
    if (!startX) return;
    var x = (e.touches[0].pageX - startX) * 2;
    walkList.scrollLeft = scrollLeft - x;
  });

  walkList.addEventListener("touchend", function () {
    startX = null;
  });
}

function popUpwalkClicked(walkId, walkList) {
  let titleWalkClicked = document.querySelector(".title-walkClicked");
  let textWalkClicked = document.querySelector(".text-walkClicked");
  let cityWalkClicked = document.querySelector(".city-walkClicked");
  let timeWalkClicked = document.querySelector(".time");
  let dateWalkClicked = document.querySelector(".date");
  let popupWalkClicked = document.querySelector(".popup-walkClicked");
  let conversationList = document.querySelector(".conversation-list");
  let inputHidden = document.querySelector("#walk-id");
  let btnClose = document.querySelector(".close-walkClicked");

  titleWalkClicked.textContent = "Titre : ";
  textWalkClicked.textContent = "Annonce : ";
  cityWalkClicked.textContent = "Localisation :";
  timeWalkClicked.textContent = "à :";
  dateWalkClicked.textContent = "Le : ";
  conversationList.innerHTML = "";

  inputHidden.value = "";

  conversationList.innerHTML = "";

  for (let i = 0; i < walkList.length; i++) {
    if (walkList[i].id == walkId) {
      titleWalkClicked.textContent += decodeHTMLEntities(walkList[i].title);
      dateWalkClicked.textContent += formatDate(walkList[i].date);
      timeWalkClicked.textContent += walkList[i].time;
      textWalkClicked.textContent += decodeHTMLEntities(walkList[i].text);
      cityWalkClicked.textContent += decodeHTMLEntities(walkList[i].cityName);
      inputHidden.value = walkId;

      let conversations = walkList[i].conversations.slice();
      conversations.sort((a, b) => new Date(b.date) - new Date(a.date));

      for (let y = 0; y < conversations.length; y++) {
        let text = decodeHTMLEntities(conversations[y].text);
        let postedAt = conversations[y].date;
        let user = decodeHTMLEntities(conversations[y].user);

        let conversationMsg = document.createElement("div");
        conversationMsg.classList.add("conversation-msg");

        let conversationText = document.createElement("p");
        conversationText.textContent = text;

        let conversationDate = document.createElement("p");
        conversationDate.textContent = "Posted at: " + postedAt;

        let conversationUser = document.createElement("p");
        conversationUser.textContent = "User: " + user;

        conversationMsg.appendChild(conversationDate);
        conversationMsg.appendChild(conversationUser);
        conversationMsg.appendChild(conversationText);

        conversationList.appendChild(conversationMsg);
      }

      popupWalkClicked.style.display = "block";

      btnClose.addEventListener("click", function () {
        popupWalkClicked.style.display = "none";
      });
      break;
    }
  }
}

function walkByRegion() {
  const regions = document.querySelectorAll(".region-btn");
  regions.forEach((region) => {
    const regionId = region.dataset.regionId;
    region.addEventListener("click", function () {
      const page = "consult_walks";
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

window.onhashchange = function () {
  handleUrlChange();
};

handleUrlChange();
