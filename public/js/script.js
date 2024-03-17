function getPokedexByType(pokemons, poketypes, types) {
    // Réinitialise la position de la combo Génération
    var selectElement = document.getElementById("select-generation");
    selectElement.selectedIndex = 0;
    // Récupère la valeur sélectionnée dans le sélecteur du type
    var select = document.getElementById("select-type");
    var value = select.value;
    console.log(pokemons);
    if (value !== "null") {
        // Récupère l'id du type recherché
        var idType;
        for (let i = 0 ; i < types.length ; i ++) {
            var leType = types[i];
            if (leType.name === value) {
                idType = leType.id;
                break;
            }
        }
        // Récupère les id des pokemons ayant le type recherché
        var listePokemon = [];
        for (let j = 0 ; j < poketypes.length ; j++) {
            var poketype = poketypes[j];
            if (poketype.type_id === idType) {
                listePokemon.push(poketype.pokemon_id);
            }
        }
        // Contruit le code HTML qui sera inséré à la place de l'ancien pour reconstituer le tableau filtré 
        var contenuHTML = `
        <table class="table-pokedex">
        <tr class="first-lign-pokedex">
        <th>Numéro</th>
        <th>Nom</th>
        <th>Type</th>
        </tr>
        `;
        for (let k = 0 ; k < pokemons.length ; k++) {
            var pokemon = pokemons[k];
            if (listePokemon.includes(pokemon.id)) {
                contenuHTML += `<tr class="lign-pokedex">
                        <th>${pokemon.pokedex_id}</th>
                        <th><a href="/pokemon/${pokemon.pokedex_id}">${pokemon.name_fr}</a></th>
                        <th class="th-logo"> 
                        `;
                var lesLogos = pokemon.logos.split(",");
                for (let l = 0 ; l < lesLogos.length ; l++) {
                    contenuHTML += `<img class="img-type" src="${lesLogos[l]}"> `;
                }
                contenuHTML += "</th>";
            }
        }
        contenuHTML += "</table>";
        var elt = document.getElementById("tab-poke");
        elt.innerHTML = contenuHTML;
    }
    else {
        window.location.href = '/pokedex';
    }
}

function getPokedexByGeneration(pokemons, generations) {
    // Réinitialise la position de la combo Type
    var selectElement = document.getElementById("select-type");
    selectElement.selectedIndex = 0;
    // Récupère la valeur sélectionnée dans la combo Génération
    var select = document.getElementById("select-generation");
    var value = select.value;
    if (value !== "null") {
        var gene;
        for (let i = 0 ; i < generations.length ; i ++) {
            var generation = generations[i];
            if (generation.number == value) {
                gene = generation.id;
                break;
            }
        }
        // Contruit le code HTML qui sera inséré à la place de l'ancien pour reconstituer le tableau filtré 
        var contenuHTML = `
        <table class="table-pokedex">
        <tr class="first-lign-pokedex">
        <th>Numéro</th>
        <th>Nom</th>
        <th>Type</th>
        </tr>
        `;
        for (let j = 0 ; j < pokemons.length ; j++) {
            var pokemon = pokemons[j];
            if (pokemon.generation_id == gene) {
                contenuHTML += `<tr class="lign-pokedex">
                        <th>${pokemon.pokedex_id}</th>
                        <th><a href="/pokemon/${pokemon.pokedex_id}">${pokemon.name_fr}</a></th>
                        <th class="th-logo"> 
                        `;
                var lesLogos = pokemon.logos.split(",");
                for (let k = 0 ; k < lesLogos.length ; k++) {
                    contenuHTML += `<img class="img-type" src="${lesLogos[k]}"> `;
                }
                contenuHTML += "</th>";
            }
        }
        contenuHTML += "</table>";
        var elt = document.getElementById("tab-poke");
        elt.innerHTML = contenuHTML;
    }
    else {
        window.location.href = '/pokedex';
    }

}

function getPokedexByName(pokemons) {
    // Récupère le contenu du champ de recherche par nom et vérifie qu'il y ait au moins 2 caractères de saisis
    var valeurRecherche = document.getElementById("search-by-name").value;
    if (valeurRecherche.length > 0) {
        // Réinitialise la position des combos Type et Génération
        var selectElement = document.getElementById("select-type");
        selectElement.selectedIndex = 0;
        selectElement = document.getElementById("select-generation");
        selectElement.selectedIndex = 0;
        // Contruit le code HTML qui sera inséré à la place de l'ancien pour reconstituer le tableau filtré 
        var contenuHTML = `
                    <table class="table-pokedex">
                    <tr class="first-lign-pokedex">
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Type</th>
                    </tr>
                    `;
        for (let j = 0; j < pokemons.length; j++) {
            var pokemon = pokemons[j];
            if (pokemon.name_fr.toLowerCase().startsWith(valeurRecherche.toLowerCase())) {
                contenuHTML += `<tr class="lign-pokedex">
                                    <th>${pokemon.pokedex_id}</th>
                                    <th><a href="/pokemon/${pokemon.pokedex_id}">${pokemon.name_fr}</a></th>
                                    <th class="th-logo"> 
                                    `;
                var lesLogos = pokemon.logos.split(",");
                for (let k = 0; k < lesLogos.length; k++) {
                    contenuHTML += `<img class="img-type" src="${lesLogos[k]}"> `;
                }
                contenuHTML += "</th>";
            }
        }
        contenuHTML += "</table>";
        var elt = document.getElementById("tab-poke");
        elt.innerHTML = contenuHTML;
    }
    else {
        window.location.href = '/pokedex';
    }
}