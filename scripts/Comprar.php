<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Bilheteira</title>
    <link rel="stylesheet" href="../styles/comprar.css" />
    <script>
    function atualizarPreco(select, precoBase, idPreco) {
        const quantidade = parseInt(select.value);
        const precoTotal = (precoBase * quantidade).toFixed(2).replace('.', ',');
        document.getElementById(idPreco).innerText = `Preço: ${precoTotal}€`;
    }
    window.onload = function() {
        document.getElementById('basquetebol-qty').addEventListener('change', function() {
            atualizarPreco(this, 99.99, 'preco-basquetebol');
        });
        document.getElementById('futebol-qty').addEventListener('change', function() {
            atualizarPreco(this, 69.99, 'preco-futebol');
        });
        document.getElementById('cinema-qty').addEventListener('change', function() {
            atualizarPreco(this, 9.99, 'preco-cinema');
        });
        document.getElementById('concertos-qty').addEventListener('change', function() {
            atualizarPreco(this, 89.99, 'preco-concertos');
        });

        document.querySelectorAll('button').forEach(function(botao) {
            botao.addEventListener('click', function() {
                window.location.href = 'compraConcluida.html';
            });
        });
    }
    </script>
</head>
<body>

<header>
  <div class="logo-container">
    <img src="../imagens/logo-final.jpeg" alt="TiraBilhete">
    <div class="logo-text">TiraBilhete</div>
  </div>
  <nav class="header-links">
    <a href="Inicio.php">Início</a>
  </nav>
</header>
<hr class="header-line">

<h1>Bilheteira de Eventos</h1>
<div class="container">
    <div class="card">
        <h2>NBA Finals<br>Indiana Pacers - OKC<br>Game 6 - 1:30</h2>
        <p id="preco-basquetebol">Preço: 99,99€</p>
        <label for="basquetebol-qty">Quantidade:</label>
        <select id="basquetebol-qty">
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
        </select>
        <button>Comprar</button>
    </div>
    <div class="card">
        <h2>Champions League Final<br>PSG - Inter<br>Munich - 20:00</h2>
        <p id="preco-futebol">Preço: 69,99€</p>
        <label for="futebol-qty">Quantidade:</label>
        <select id="futebol-qty">
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
        </select>
        <button>Comprar</button>
    </div>
    <div class="card">
        <h2>Cinema NOS<br>Missão: Impossível - O Ajuste de Contas Final</h2>
        <p id="preco-cinema">Preço: 9,99€</p>
        <label for="cinema-qty">Quantidade:</label>
        <select id="cinema-qty">
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
        </select>
        <button>Comprar</button>
    </div>
    <div class="card">
        <h2>GRAND NATIONAL TOUR - KENDRICK LAMAR AND SZA<br>19:00 27 Julho - Estádio do Restelo (Lisboa)</h2>
        <p id="preco-concertos">Preço: 89,99€</p>
        <label for="concertos-qty">Quantidade:</label>
        <select id="concertos-qty">
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
        </select>
        <button>Comprar</button>
    </div>
</div>
</body>
</html>