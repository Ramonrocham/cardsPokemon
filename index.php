<?php

$url = "https://play.pokemonshowdown.com/data/pokedex.json";

    
$pokemons = json_decode(file_get_contents($url));
$idAnterior = -1;
$idInicio = 0;
$quantidade = 20;
$contador = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeGuia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="container">
            <?php foreach ($pokemons as $poke):
            if($idAnterior == $poke->num || $poke->num < $idInicio){
                continue;
            }
            if($contador == $quantidade || $poke->num<1){
                break;
            }
            $contador++;
            
            $idAnterior = $poke->num;
            ?>
            
            <div class="area-card">
                <div class="area-conteudo">
                    
                    <div class="nome-pokemon"> <?= $poke->name?> </div>
                    <div class="img-pokemon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/<?=$poke->num?>.png" alt=""></div>
                    <div class="tipo-pokemon-area">
                        <?php foreach($poke->types as $tipo){
                            echo "<div class='tipo-pokemon'>".$tipo."</div>";
                        }?>
                    </div>
                </div>
            </div>

            <?php endforeach;$contador=0;?>
        </div>
        
    </main>
</body>
</html>


<!--"https://pokeapi.co/api/v2/pokemon?limit=100&offset=749";
     //"https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0" offset=0&limit=20
    //https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/750.png