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
                <button class="anterior" onclick="anterior()"><<<</button>
                <button class="proximo" onclick="proximo()">>>></button>
            </div>
        </div>
        <div class="container"  id="container-cards">
            
        </div>
        <div class="container">
            <div class="msg"></div> 
            <div class="ant-prox">
                <button class="anterior" onclick="anterior()"><<<</button>
                <button class="proximo" onclick="proximo()">>>></button>
            </div>
        </div>
    </main>
    <script>
        
        let idInicio = 1;
        const maxPokemon = 1025;
        let tipos = [];
        let showMsg = document.querySelector(".msg");
        showMsg.innerHTML = "Carregando cards..."

        async function getTipos() {
            let tp = await fetch('tiposPokemon.php');
            let resp = await tp.json();

            return resp;
        };

        async function carregarTipos() {
            tipos = await getTipos();
        }

        carregarTipos();
        
        function carregarDados(){
            fetch('dadosPokemons.php?idInicio='+idInicio)
            .then(res => res.json())
            .then(data => {
                const containerCards = document.querySelector('#container-cards');
                containerCards.innerHTML = '';
                data.forEach(poke =>{
                    showMsg.innerHTML = '';

                    const card = document.createElement('div');
                    card.className = 'area-card';
                    card.style.background = `radial-gradient(circle at 50% 5%, ${tipos[poke.tipos[0]].cor} 45%, #fff 36%)`
                    card.innerHTML = `
                        <div class="area-conteudo">
                        <div class="id-pokemon"><span>id: ${poke.id}</span></div>
                        <div class="nome-pokemon"> ${poke.nome} </div>
                        <div class="img-pokemon"><img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${poke.id}.png" alt=""></div>
                        <div class="tipo-pokemon-area">
                            ${poke.tipos.map(tipo => `<div class="tipo-pokemon" style= "background-color:${tipos[tipo].cor};">${tipos[tipo].ptbr}</div>`).join('')}
                        </div>
                        </div>
                    `;
                    containerCards.appendChild(card);
                });
            });
        }
        carregarDados();

        function proximo(){
            idInicio += 20;
            if(idInicio>maxPokemon) idInicio=maxPokemon-20;
            carregarDados();
        }
        function anterior(){
            idInicio -= 20;
            if(idInicio<1) idInicio=1;
            carregarDados();
        }
    </script>
</body>
</html>

