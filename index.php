<?php
// Iniciar una nueva sesión o reanudar la existente.
session_start();
//Destruye la variable especificada para que tenga que volverse a logear.
unset($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!--    Cargamos los estilos.-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/vendor/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header>
    <div class="w3-container w3-black w3-center">
        <h1>Bienvenido a METEOGALICIA</h1>
    </div>
</header>

<div class="w3-container w3-green">
    <h2>Login</h2>
</div>
<div class="w3-container">

    <form class="w3-container w3-card-4 w3-light-grey w3-text-green w3-margin" action="controller/usuarios_controller.php"
          method="post">
        <h2 class="w3-center">Iniciar sesión</h2>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border" name="nick" type="text" placeholder="Nick">
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-unlock-alt"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border" name="password" type="password" placeholder="Password">
            </div>
        </div>

        <input type="hidden" name="entrar" value="entrar">
        <button class="w3-btn w3-green" style="width:120px">Aceptar</button>
        <p>Si aún no tienes cuenta ve al siguiente link <a href="view/registrarse.php">Registrarse</a></p>
    </form>
</div>
<footer>
    <div class="w3-container w3-black">
        <h4>© 2018 Alberto García Olivero</h4>
    </div>
</footer>
</body>
</html>
