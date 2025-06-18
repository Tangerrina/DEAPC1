<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/inicio.css">
    <title>Início</title>
</head>
<body>

<header>
    <div class="logo-container">
        <img src="../imagens/logo-final.jpeg" alt="TiraBilhete">
        <div class="logo-text">TiraBilhete</div>
    </div>
    <div class="auth-links">
        <?php if (isset($_SESSION["user_id"])): ?>
            <a href="logout.php">TERMINAR SESSÃO</a>
        <?php else: ?>
            <a href="login.html">LOGIN</a>
            <a href="register.html">SIGN UP</a>
        <?php endif; ?>
    </div>
</header>

<h1>VEJA AQUI OS NOSSOS EVENTOS DISPONÍVEIS!</h1>

<?php if (isset($_SESSION["user_id"])): ?>
    <a href="Comprar.php" class="event-button">EVENTOS</a>
<?php else: ?>
    <span class="event-button event-button-disabled">EVENTOS</span>
    <div style="margin-top:20px; color:#ec6f1a; font-size:22px; font-weight:bold;">
        Faz login para ter acesso
    </div>
<?php endif; ?>

</body>
</html>
