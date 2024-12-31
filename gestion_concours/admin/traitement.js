// Script JavaScript pour gérer la création dynamique des champs d'épreuves

function showEpreuves(filiere) {
    var epreuvesContainer = document.getElementById("epreuvesContainer");
    epreuvesContainer.innerHTML = ""; // Efface le contenu précédent

    var nombreEpreuves = {
        licence: 3,
        master: 4,
        ingenieur: 5
    };

    // Création des champs d'épreuves en fonction de la filière sélectionnée
    for (var i = 1; i <= nombreEpreuves[filiere]; i++) {
        var label = document.createElement("label");
        label.setAttribute("for", "epreuve" + i);
        label.textContent = "Note de l'épreuve " + i + ":";

        var input = document.createElement("input");
        input.setAttribute("type", "number");
        input.setAttribute("id", "epreuve" + i);
        input.setAttribute("name", "epreuve" + i);
        input.setAttribute("min", "0");
        input.setAttribute("max", "20");
        input.setAttribute("step", "0.1");
        input.setAttribute("required", "required");

        var divField = document.createElement("div");
        divField.classList.add("field");
        divField.appendChild(label);
        divField.appendChild(input);

        epreuvesContainer.appendChild(divField);
    }
}

// Écouter les changements sur le champ 'filiere'
document.getElementById("filiere").addEventListener("change", function() {
    var filiere = this.value;
    showEpreuves(filiere);
});

// Appel initial pour afficher les épreuves en fonction de la filière sélectionnée au chargement de la page
var initialFiliere = document.getElementById("filiere").value;
showEpreuves(initialFiliere);

    function showEpreuves(filiere) {
        // Sélection du conteneur des épreuves
        var epreuvesContainer = document.getElementById("epreuvesContainer");

        // Effacer le contenu précédent du conteneur des épreuves
        epreuvesContainer.innerHTML = "";

        // Nombre d'épreuves pour chaque filière
        var nombreEpreuves = {
            licence: 3,
            master: 4,
            ingenieur: 5
        };

        // Créer les champs d'épreuves en fonction de la filière sélectionnée
        for (var i = 1; i <= nombreEpreuves[filiere]; i++) {
            var label = document.createElement("label");
            label.setAttribute("for", "epreuve" + i);
            label.textContent = "M " + i + ":";

            var input = document.createElement("input");
            input.setAttribute("type", "number");
            input.setAttribute("id", "epreuve" + i);
            input.setAttribute("name", "epreuve" + i);
            input.setAttribute("min", "0");
            input.setAttribute("max", "20");
            input.setAttribute("step", "0.1");
            input.setAttribute("required", "required");

            var divField = document.createElement("div");
            divField.classList.add("field");
            divField.appendChild(label);
            divField.appendChild(input);

            epreuvesContainer.appendChild(divField);
        }
    }
