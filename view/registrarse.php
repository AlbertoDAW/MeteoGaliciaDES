<?php
//Importamos la clase que hace las llamadas al web service.
include_once('../service/NetworkService.php');

$networkService = new NetworkService();
// Se obtienen las estaciones para rellenar el select.
$estaciones = $networkService->getEstaciones();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrarse</title>
    <!--    Cargamos los estilos.-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/vendor/w3.css">
</head>
<body>
<header>
    <div class="w3-container w3-black w3-center">
        <h1>Bienvenido a METEOGALICIA</h1>
    </div>
</header>
<div class="w3-container w3-green">
    <h1>Registrarse</h1>
</div>
<div>
    <form class="w3-container" action="../controller/usuarios_controller.php" method="post">
        <div class="w3-row w3-section">
            <label for="reg_nick_input" class="w3-label">Nick</label>
            <input id="reg_nick_input" class="w3-input w3-border" type="text" name="nick" required>
        </div>
        <div class="w3-row w3-section">
            <label for="reg_pass_input" class="w3-label" required>Password</label>
            <input id="reg_pass_input" class="w3-input w3-border" type="password" name="password">
        </div>
        <div class="w3-row w3-section">
            <label for="reg_rol_select" class="w3-label"></label>
            <select id="reg_rol_select" class="w3-select w3-border" name="rol" required>
                <option value="" selected disabled>Seleccione un Rol</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="guest">Guest</option>
            </select>
        </div>
        <div class="w3-row w3-section">
            <label for="reg_estacion_select" class="w3-label"></label>
            <select id="reg_estacion_select" class="w3-select w3-border" name="id_estacion" required>
                <option value="" selected disabled>Selecione una estación</option>
                <?php
                foreach ($estaciones as $item)://Por cada estación crea una optión en el select con el id como value.
                    echo '<option value="' . $item['idEstacion'] . '">' . $item['concello'] . ' - ' . $item['estacion'] . '</option>';
                endforeach;
                ?>
            </select>
        </div>
        <div class="w3-row w3-section">
            <input type="hidden" name="registrarse" value="registrarse">
            <button class="w3-btn w3-green">Registrarse</button>
        </div>
        <div class="w3-row w3-section">
            <a href="../index.php">Ahora no</a>
        </div>
    </form>
</div>
<footer>
    <div class="w3-container w3-black">
        <h4>© 2018 Alberto García Olivero</h4>
    </div>
</footer>

</body>
</html>