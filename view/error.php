<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <!--    Cargamos los estilos.-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/vendor/w3.css">
</head>
<body>
<header>
    <div class="w3-container w3-black">
        <h1>BIENVENIDO A METEOGALICIA</h1>
    </div>
</header>

<div class="w3-container w3-red">
    <h1><?php echo $_GET['mensaje']; ?></h1>
    <a href="../index.php">Volver a inicio</a>
</div>

<footer>
    <div class="w3-container w3-black">
        <h4>© 2018 Alberto García Olivero</h4>
    </div>
</footer>
</body>
</html>