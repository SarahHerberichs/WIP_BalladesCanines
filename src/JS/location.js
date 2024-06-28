document.addEventListener("DOMContentLoaded", function () {
  const citiesJsonUrl = "cities.json"; // Chemin vers votre fichier JSON des villes

  const departmentSelect = document.getElementById("department");
  const citySearchInput = document.getElementById("citySearch");
  const cityResultsDiv = document.getElementById("cityResults");
  const cityId = document.getElementById("cityId");

  let citiesData = []; // Variable pour stocker les données des villes

  // Fonction pour charger les données JSON des villes
  function loadCitiesJson() {
    return fetch(citiesJsonUrl)
      .then((response) => response.json())
      .then((data) => {
        citiesData = data.cities; // Stocker les données des villes dans la variable citiesData
        return citiesData;
      })
      .catch((error) => {
        console.error("Erreur lors du chargement des villes :", error);
        return [];
      });
  }

  // Fonction pour remplir le select des départements
  function fillDepartments() {
    loadCitiesJson()
      .then((cities) => {
        // Récupérer tous les départements uniques
        const departmentsSet = new Set(
          cities.map((city) => city.department_name)
        );
        const sortedDepartments = Array.from(departmentsSet).sort(); // Trier les départements par ordre alphabétique

        // Ajouter chaque département trié comme une option dans le select
        sortedDepartments.forEach((department) => {
          const option = document.createElement("option");
          option.value = department;
          option.textContent = department;
          departmentSelect.appendChild(option);
        });
      })
      .catch((error) => {
        console.error("Erreur lors du chargement des départements :", error);
      });
  }

  // Fonction pour afficher les résultats de la recherche de villes
  function showCityResults(results) {
    cityResultsDiv.innerHTML = ""; // Réinitialiser les résultats

    if (results.length === 0) {
      const noResults = document.createElement("div");
      noResults.textContent = "Aucun résultat trouvé";
      cityResultsDiv.appendChild(noResults);
    } else {
      const ul = document.createElement("ul");

      results.forEach((city) => {
        const li = document.createElement("li");
        li.textContent = city.label + " - " + city.zip_code;
        li.addEventListener("click", function () {
          citySearchInput.value = city.label; // Remplir le champ avec le nom de la ville cliquée
          cityResultsDiv.innerHTML = ""; // Masquer les résultats après sélection
        });
        ul.appendChild(li);
      });

      cityResultsDiv.appendChild(ul);
    }
  }

  // Remplir le select des départements au chargement de la page
  fillDepartments();

  // Écouter le changement dans le select des départements
  departmentSelect.addEventListener("change", function () {
    const selectedDepartment = this.value;
    const searchValue = citySearchInput.value.trim().toLowerCase();

    let filteredCities = [];

    if (selectedDepartment === "Tous les départements") {
      // Filtrer toutes les villes si "Tous les départements" est sélectionné
      filteredCities = citiesData.filter((city) =>
        city.label.toLowerCase().startsWith(searchValue)
      );
    } else {
      // Filtrer les villes par département sélectionné et correspondance avec les premières lettres
      filteredCities = citiesData.filter(
        (city) =>
          city.department_name.toLowerCase() ===
            selectedDepartment.toLowerCase() &&
          city.label.toLowerCase().startsWith(searchValue)
      );
    }

    showCityResults(filteredCities);
  });

  // Écouter les événements de saisie dans le champ de recherche de ville
  citySearchInput.addEventListener("input", function () {
    const searchValue = this.value.trim().toLowerCase();
    const selectedDepartment = departmentSelect.value;

    let filteredCities = [];

    if (selectedDepartment === "Tous les départements") {
      // Filtrer toutes les villes si "Tous les départements" est sélectionné
      filteredCities = citiesData.filter((city) =>
        city.label.toLowerCase().startsWith(searchValue)
      );
    } else {
      // Filtrer les villes par département sélectionné et correspondance avec les premières lettres
      filteredCities = citiesData.filter(
        (city) =>
          city.department_name.toLowerCase() ===
            selectedDepartment.toLowerCase() &&
          city.label.toLowerCase().startsWith(searchValue)
      );
    }

    showCityResults(filteredCities);
  });
});
