function getPokedexByType(pokemons, poketypes, types) {
    // Réinitialise la position de la combo Génération et vide le champ de recherche par nom
    var selectElement = document.getElementById("select-generation");
    selectElement.selectedIndex = 0;
    document.getElementById("search-by-name").value = "";
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
        <table class="w-11/12 border-separate border-spacing-1">
        <tr class="bg-neutral-400 h-10">
        <th>Numéro</th>
        <th>Nom</th>
        <th>Types</th>
        </tr>
        `;
        for (let k = 0 ; k < pokemons.length ; k++) {
            var pokemon = pokemons[k];
            if (listePokemon.includes(pokemon.id)) {
                contenuHTML += `<tr class="bg-neutral-200 h-10">
                        <td><div class="flex justify-center">${pokemon.pokedex_id}</div></td>
                        <td><a href="/pokemon/${pokemon.pokedex_id}" class="flex justify-center hover:text-neutral-500">${pokemon.name_fr}</a></td>
                        <td class="flex justify-center"> 
                        `;
                var lesLogos = pokemon.logos.split(",");
                for (let l = 0 ; l < lesLogos.length ; l++) {
                    contenuHTML += `<div class="flex justify-center"><img class="h-8 m-2" src="${lesLogos[l]}"></div> `;
                }
                contenuHTML += "</td>";
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
    // Réinitialise la position de la combo Type et vide le champ de recherche par nom
    var selectElement = document.getElementById("select-type");
    selectElement.selectedIndex = 0;
    document.getElementById("search-by-name").value = "";
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
        <table class="w-11/12 border-separate border-spacing-1">
        <tr class="bg-neutral-400 h-10">
        <th>Numéro</th>
        <th>Nom</th>
        <th>Types</th>
        </tr>
        `;
        for (let j = 0 ; j < pokemons.length ; j++) {
            var pokemon = pokemons[j];
            if (pokemon.generation_id == gene) {
                contenuHTML += `<tr class="bg-neutral-200 h-10">
                        <td><div class="flex justify-center">${pokemon.pokedex_id}</div></td>
                        <td><a href="/pokemon/${pokemon.pokedex_id}" class="flex justify-center hover:text-neutral-500">${pokemon.name_fr}</a></td>
                        <td class="flex justify-center"> 
                        `;
                var lesLogos = pokemon.logos.split(",");
                for (let k = 0 ; k < lesLogos.length ; k++) {
                    contenuHTML += `<div class="flex justify-center"><img class="h-8 m-2" src="${lesLogos[k]}"></div> `;
                }
                contenuHTML += "</td>";
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
                    <table class="w-11/12 border-separate border-spacing-1">
                    <tr class="bg-neutral-400 h-10">
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Types</th>
                    </tr>
                    `;
        for (let j = 0; j < pokemons.length; j++) {
            var pokemon = pokemons[j];
            if (pokemon.name_fr.toLowerCase().startsWith(valeurRecherche.toLowerCase())) {
                contenuHTML += `<tr class="bg-neutral-200 h-10">
                                    <td><div class="flex justify-center">${pokemon.pokedex_id}</div></td>
                                    <td><a href="/pokemon/${pokemon.pokedex_id}" class="flex justify-center hover:text-neutral-500">${pokemon.name_fr}</a></th>
                                    <td class="flex justify-center"> 
                                    `;
                var lesLogos = pokemon.logos.split(",");
                for (let k = 0; k < lesLogos.length; k++) {
                    contenuHTML += `<div class="flex justify-center"><img class="h-8 m-2" src="${lesLogos[k]}"></div> `;
                }
                contenuHTML += "</td>";
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