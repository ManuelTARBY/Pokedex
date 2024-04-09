document.getElementById('select-generation').addEventListener('change', function() {
    var selectedGeneration = this.value;
    var pokemons = document.querySelectorAll('.pokemon');
    
    pokemons.forEach(function(pokemon) {
        var generationId = pokemon.getAttribute('value');
        if (selectedGeneration === 'null' || selectedGeneration === generationId) {
            pokemon.style.display = 'block';
        } else {
            pokemon.style.display = 'none';
        }
    });
});
