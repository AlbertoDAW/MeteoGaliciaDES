<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alberto García Olivero
 * Date: 20/05/2018
 * Time: 13:24
 */
//Incluimos la libreria Jquery4php
include_once('../core/vendor/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
YsJQueryAutoloader::register();

//Importamos la clase que hace las llamadas al web service.
include_once('../service/NetworkService.php');
include_once('../core/constants.php');
include_once('../model/Usuario.php');

// Iniciar una nueva sesión o reanudar la existente.
session_start();
//Si no hay sesion vuelve al index.
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
} else {
//Obtenemos el usuario de la sesión que anteriormente he serializado.
    $usuario = unserialize($_SESSION['usuario']);
//Se instancia la clase encargada de las peticiones al web service de meteogalicia.
    $networkService = new NetworkService();
//Se obtiene la estacion de referencia del usuario.
    $estacion = $networkService->getEstacionById($usuario->getIdEstacion())[0];//Obtenemos la estación por el id.
// Se obtienen las estaciones para rellenar el select.
    $estaciones = $networkService->getEstaciones();
}
?>
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
        <button class="w3-button w3-green w3-hover-light-green">Dashboard</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4 w3-green">
            <a href="control_usuarios.php" class="w3-bar-item w3-button w3-green w3-hover-light-green">Control de
                usuarios</a>
            <a href="../controller/usuarios_controller.php?salir"
               class="w3-bar-item w3-button w3-green w3-hover-red">Salir</a>
        </div>
    </div>
</div>


<!-----------------------------Su estación de referencia--------------------------->


<h3 class="w3-container w3-blue">Su estación de referencia</h3>
<div class='w3-responsive'>
    <table class='w3-table-all w3-centered w3-small'>
        <thead>
        <tr class='w3-amber'>
            <?php
            foreach ($estacion as $clave => $valor) {//Por cada campo de la estación creamos una columna.
                switch ($clave) {
                    case 'lnIconoCeo':
                        echo "<th>Estado do ceo</th>";
                        break;
                    case 'lnIconoTemperatura':
                        echo "<th>Temperatura</th>";
                        break;
                    case 'lnIconoVento':
                        echo "<th>Vento</th>";
                        break;
                    default:
                        echo "<th>" . ucfirst($clave) . "</th>";//ucfirst convierte la primera letra en mayuscula.
                }
            }
            echo "</tr></thead>";
            echo "<tr>";
            foreach ($estacion as $clave => $valor) {//Por cada campo de la estación creamos una columna con su valor.
                switch ($clave) {
                    case 'lnIconoCeo':
                        echo "<td><img src='" . URL_CEO . $valor . ".png' alt=''></td>";
                        break;
                    case 'lnIconoTemperatura':
                        echo "<td><img src='" . URL_TEMP . $valor . ".png' alt=''></td>";
                        break;
                    case 'lnIconoVento':
                        echo "<td><img src='" . URL_VENTO . $valor . ".png' alt=''></td>";
                        break;
                    default:
                        echo "<td>" . $valor . "</td>";
                }
            }
            ?>
        </tr>
    </table>
</div>


<!--------------------------Estaciones Meteorológicas de Galicia------------------------------>

<h3 class="w3-container w3-blue">Estaciones Meteorológicas de Galicia</h3>
<form id="form1" class="row form-group mt-3">
    <label for="select_estacion"></label>
    <select id="select_estacion" name="select_estacion" class="w3-select w3-border">
        <option value="">Selecione una estación</option>
        <?php
        foreach ($estaciones as $item)://Por cada estación crea una optión en el select con el id como value.
            echo '<option value="' . $item['idEstacion'] . '">' . $item['estacion'] . '</option>';
        endforeach;
        ?>
    </select>

    <?php
    echo YsJQuery::newInstance()//Creamos una nueva instancia
    ->onChange()//Utilizamos el evento onChange del select.
    ->in('#select_estacion')//Indicamos el id del elemento html afectado
    ->execute(YsJQuery::load(
        "../controller/estacion_controller.php",
        array(
            "id" => YsJQuery::val()->in('#select_estacion') //Obtiene el valor del select para enviarlo al controller.
        )
    )
        ->in("#div_result_estacion")//Es donde se va a mostrar el resultado.
    );
    ?>
</form>

<!-- DIV donde se escribirá el resultado de la estación seleccionada -->
<div id="div_result_estacion" class="w3-row"></div>

<!--------------------------------GUARDAR TEMPERATURA EN BASE DE DATOS------------------------------>
<div class="w3-container w3-margin">
<button id="guardar_temp_btn" class="w3-btn w3-green">Guardar temperatura en base de datos
</button>
<?php
echo YsJQuery::newInstance()//Creamos una nueva instancia
->onClick()//Utilizamos el evento onClick.
->in('#guardar_temp_btn')//Indicamos el id del elemento html afectado
->execute(
    YsJQuery::post(
        "../controller/temperaturas_controller.php",
        array(
            "insertar" => true,
            "id_usuario" => $usuario->getId(),
            "id_estacion" => YsJQuery::text()->in('#idEstacion'),//Obtiene el valor del td para enviarlo al controller.
            "valTemperatura" => YsJQuery::text()->in('#valorTemperatura')
        ),
        new YsJsFunction('alert(response)', 'response'),//Muestra la respuesta del controlador en un alert.
        YsJQueryConstant::DATA_TYPE_HTML
    )
);
?>
</div>

<footer>
    <div class="w3-container w3-black">
        <h4>© 2018 Alberto García Olivero</h4>
    </div>
</footer>
</body>
</html>
