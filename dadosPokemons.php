<?php

header('content-Type: application/json');

require 'apiPokemon.php';

$idInicio = empty($_GET['idInicio'])?1: $_GET['idInicio'];

$quantidade = 20;

$idAnterior = -1;
$count = 0;

$result = [];

foreach($pokemons as $poke){
    if($idAnterior == $poke->num || $poke->num < $idInicio){
        continue;
    }
    if($count == $quantidade || $poke->num<1){
        break;
    }
    $count++;
            
    $idAnterior = $poke->num;

    array_push($result, [
        'id' => $poke->num,
        'nome' => $poke->name,
        'tipos' => $poke->types
    ]);
}

echo json_encode($result);