document.addEventListener("DOMContentLoaded", function () {
  const citiesJsonUrl = "Assets/cities.json";

  const departmentSelect = document.getElementById("department");
  const citySearchInput = document.getElementById("citySearch");
  const cityResultsDiv = document.getElementById("cityResults");
  const cityZipcode = document.getElementById("zipcode");
  const cityName = document.getElementById("cityName");

  let citiesData = [];

  function loadCitiesJson() {
    return fetch(citiesJsonUrl)
      .then((response) => response.json())
      .then((data) => {
        citiesData = data.cities;
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
        const departmentsSet = new Set(
          cities.map((city) => city.department_name)
        );
        const sortedDepartments = Array.from(departmentsSet).sort();

        // Ajoute chaque département trié comme une option dans le select
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
    cityResultsDiv.innerHTML = "";

    if (results.length === 0) {
      const noResults = document.createElement("div");
      noResults.textContent = "Aucun résultat trouvé";
      cityResultsDiv.appendChild(noResults);
    } else {
      cityResultsDiv.classList.add("visible");
      const ul = document.createElement("ul");

      results.forEach((city) => {
        const li = document.createElement("li");
        li.textContent = city.label + "-" + city.zip_code;

        li.addEventListener("click", function () {
          console.log(city.zip_code);
          citySearchInput.value = city.label + "-" + city.zip_code;
          cityName.value = city.label;
          cityZipcode.value = city.zip_code;

          cityResultsDiv.classList.add("invisible");
          cityResultsDiv.innerHTML = "";
        });
        ul.appendChild(li);
      });

      cityResultsDiv.appendChild(ul);
    }
  }

  // Rempli le select des départements au chargement de la page
  fillDepartments();

  // Écoute le changement dans le select des départements
  departmentSelect.addEventListener("change", function () {
    citySearchInput.value = "";
    const selectedDepartment = this.value;
    const searchValue = citySearchInput.value.trim().toLowerCase();

    let filteredCities = [];

    if (selectedDepartment === "Tous les départements") {
      // Filtre toutes les villes si "Tous les départements" est sélectionné
      filteredCities = citiesData.filter((city) =>
        city.label.toLowerCase().startsWith(searchValue)
      );
    } else {
      // Filtre les villes par département sélectionné et correspondance avec les premières lettres
      filteredCities = citiesData.filter(
        (city) =>
          city.department_name.toLowerCase() ===
            selectedDepartment.toLowerCase() &&
          city.label.toLowerCase().startsWith(searchValue)
      );
    }

    showCityResults(filteredCities);
  });

  // Écoute les événements de saisie dans le champ de recherche de ville
  citySearchInput.addEventListener("input", function () {
    cityResultsDiv.classList.remove("invisible");
    const searchValue = this.value.trim().toLowerCase();
    const selectedDepartment = departmentSelect.value;

    let filteredCities = [];

    if (selectedDepartment === "Tous les départements") {
      // Filtre toutes les villes si "Tous les départements" est sélectionné
      filteredCities = citiesData.filter((city) =>
        city.label.toLowerCase().startsWith(searchValue)
      );
    } else {
      // Filtre les villes par département sélectionné et correspondance avec les premières lettres
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
