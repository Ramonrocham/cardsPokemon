<?php
$url = "https://play.pokemonshowdown.com/data/pokedex.json";    
$pokemons = json_decode(file_get_contents($url));