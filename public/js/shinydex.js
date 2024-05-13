function changeGeneration () {
    var selectedGeneration = document.getElementById('select-generation').value;
    var pokemons = document.querySelectorAll('.pokemon');
    
    pokemons.forEach(function(pokemon) {
        var generationId = pokemon.getAttribute('value');
        if (selectedGeneration === 'null' || selectedGeneration === generationId) {
            pokemon.style.display = 'block';
        } else {
            pokemon.style.display = 'none';
        }
    });
};

document.addEventListener('DOMContentLoaded', changeGeneration);
document.getElementById('select-generation').addEventListener('change', changeGeneration);