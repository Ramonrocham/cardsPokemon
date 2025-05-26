<?php
require 'tiposPokemon.php';

$url = "https://play.pokemonshowdown.com/data/pokedex.json";    
$pokemons = json_decode(file_get_contents($url));

$idAnterior = -1;
$idInicio = 1;
$quantidade = 20;
$contador = 0;
$maxPokemon = 1025;
if(!empty($_GET['idInicio'])){
    $idInicio = $_GET['idInicio'];  
}else{
    $idInicio = 1;
}


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
    <header>
        <div class="container">
            <div class="conteudo-header">
                <h1>PokeGuia</h1>
                <p>Cartas com informações sobre todos os pokemons da pokedex!</p>
            </div>
        </div>
    </header>
    <main>
        <div class="container"> 
            <div class="ant-prox">
                <div><a href="index.php?idInicio=<?= ($idInicio - $quantidade >1) ? $idInicio - $quantidade:1?>" class="btnPass">Anteriores</a></div>
                <div class="contador"><?= "$idInicio - ".$idInicio - 1 + $quantidade." / $maxPokemon"?></div>
                <div><a href="index.php?idInicio=<?= ($idInicio + $quantidade > $maxPokemon) ? $maxPokemon - $quantidade + 1 : $idInicio + $quantidade?>" class="btnPass">Proximos</a></div>
            </div>
        </div>
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
            
            <div class="area-card" style="background: radial-gradient(circle at 50% 5%, <?=$tiposPokemon[$poke->types[0]]['cor']?> 45%, #fff 36%); ">
                <div class="area-conteudo" >
                    <div class="id-pokemon"><span>id: <?=$poke->num?></span></div>
                    <div class="nome-pokemon"> <?= $poke->name?> </div>
                    <div class="img-pokemon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/<?=$poke->num?>.png" alt=""></div>
                    <div class="tipo-pokemon-area">
                        <?php foreach($poke->types as $tipo){
                            echo "<div class='tipo-pokemon' style= 'background-color:".$tiposPokemon[$tipo]['cor'].";'>".$tiposPokemon[$tipo]['ptbr']."</div>";
                        }?>
                    </div>
                </div>
            </div>
            <?php endforeach;$contador=0;?>
        </div>
        <div class="container"> 
            <div class="ant-prox">
                <div><a href="index.php?idInicio=<?= ($idInicio - $quantidade >1) ? $idInicio - $quantidade:1?>" class="btnPass">Anteriores</a></div>
                <div class="contador"><?= "$idInicio - ".$idInicio - 1 + $quantidade." / $maxPokemon"?></div>
                <div><a href="index.php?idInicio=<?= ($idInicio + $quantidade > $maxPokemon) ? $maxPokemon - $quantidade + 1 : $idInicio + $quantidade?>" class="btnPass">Proximos</a></div>
            </div>
        </div>
    </main>
</body>
</html>


<!--"https://pokeapi.co/api/v2/pokemon?limit=100&offset=749";
     //"https://pokeapi.co/api/v2/pokemon?limit=100000&offset=0" offset=0&limit=20
    //https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/750.png