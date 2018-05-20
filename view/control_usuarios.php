<?php
//Incluimos la libreria Jquery4php
include_once('../core/vendor/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
YsJQueryAutoloader::register();

//Importamos la clase que hace las llamadas al web service.
include_once('../service/NetworkService.php');
include_once('../model/Usuario.php');

// Iniciar una nueva sesión o reanudar la existente.
session_start();
//Si no hay sesion vuelve al index.
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
} else {
//Obtenemos el usuario de la sesión que anteriormente he serializado.
    $usuario = unserialize($_SESSION['usuario']);
    $networkService = new NetworkService();
// Se obtienen las estaciones para rellenar el select.
    $estaciones = $networkService->getEstaciones();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>MeteoGalicia</title>
    <!--    Cargamos los estilos.-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/vendor/w3.css">
    <!--    Cargamos la libreria jQuery.-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
<header>
    <div class="w3-container w3-black">
        <h1>METEOGALICIA</h1>
    </div>
</header>

<!--------------------------------MENU SUPERIOR------------------------------------>

<div class="w3-bar w3-green">
    <div class="w3-dropdown-hover w3-green">
        <a href="#" class="w3-button w3-green w3-hover-light-green">Control de usuarios</a>
        <div class="w3-dropdown-content w3-bar-block w3-card-4 w3-green">
            <a href="dashboard.php" class="w3-bar-item w3-button w3-green w3-hover-light-green">Dashboard</a>
            <a href="../controller/usuarios_controller.php?salir"
               class="w3-bar-item w3-button w3-green w3-hover-red">Salir</a>
        </div>
    </div>
</div>

<h3 class="w3-container w3-blue">Insertar nuevo usuario</h3>
<div>
    <form class="w3-container" id="datos">
        <div class="w3-row w3-section">
            <label for="reg_nick_input" class="w3-label">Nick</label>
            <input id="reg_nick_input" class="w3-input w3-border" type="text" name="nick" required>
        </div>
        <div class="w3-row w3-section">
            <label for="reg_pass_input" class="w3-label">Password</label>
            <input id="reg_pass_input" class="w3-input w3-border" type="password" name="password" required>
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
            <button id="insertar_usuario_btn" class="w3-btn w3-green">Insertar</button>
        </div>
        <!--------------------------------GUARDAR USUARIO EN BASE DE DATOS------------------------------>
        <?php
        echo YsJQuery::newInstance()//Creamos una nueva instancia
        ->onClick()//Utilizamos el evento onClick.
        ->in('#insertar_usuario_btn')//Indicamos el id del elemento html afectado
        ->execute(
            YsJQuery::post(
                "../controller/usuarios_controller.php",
                array(
                    "insertar_usuario" => true,
                    "nick" => YsJQuery::val()->in('#reg_nick_input'), //Obtiene los valores para enviarlos al controller.
                    "password" => YsJQuery::val()->in('#reg_pass_input'),
                    "rol" => YsJQuery::val()->in('#reg_rol_select'),
                    "id_estacion" => YsJQuery::val()->in('#reg_estacion_select'),
                ),
                new YsJsFunction('alert(response)', 'response'),//Muestra la respuesta del controlador en un alert.
                YsJQueryConstant::DATA_TYPE_HTML
            )
        );
        ?>
    </form>
</div>

<h3 class="w3-container w3-blue">Listado de usuarios</h3>

<?php
echo YsJQuery::newInstance()//Creamos una nueva instancia
->onLoad()//Utilizamos el evento onClick.
->in('window')//Indicamos el id del elemento html afectado
->execute(
    YsJQuery::load(
        "../controller/usuarios_controller.php",
        array(
            "buscar_usuarios" => true
        )
    )
        ->in("#div_result_usuarios")//Es donde se va a mostrar el resultado.
);
?>

<div id="div_result_usuarios" class="w3-container w3-row w3-section">
</div>

<h3 class="w3-container w3-blue">Eliminación de usuarios</h3>
<form class="w3-container">
    <div class="w3-row w3-section">
        <label for="del_id_input" class="w3-label">Id</label>
        <input id="del_id_input" class="w3-input w3-border" type="text" name="id" required>
    </div>
    <div class="w3-row w3-section">
        <button id="eliminar_usuario_btn" class="w3-btn w3-green">Eliminar</button>
    </div>
    <!--------------------------------ELIMINAR USUARIO EN BASE DE DATOS------------------------------>
    <?php
    echo YsJQuery::newInstance()//Creamos una nueva instancia
    ->onClick()//Utilizamos el evento onClick.
    ->in('#eliminar_usuario_btn')//Indicamos el id del elemento html afectado
    ->execute(
        YsJQuery::post(
            "../controller/usuarios_controller.php",
            array(
                "eliminar_usuario" => true,
                "id" => YsJQuery::val()->in('#del_id_input')
            ),
            new YsJsFunction('alert(response)', 'response'),//Muestra la respuesta del controlador en un alert.
            YsJQueryConstant::DATA_TYPE_HTML
        )
    );
    ?>
</form>
<footer>
    <div class="w3-container w3-black">
        <h4>© 2018 Alberto García Olivero</h4>
    </div>
</footer>

</body>
</html>