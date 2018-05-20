<?php
/**
 * CONTROLADOR QUE OBTENDRÁ LOS DATOS DE LA ESTACIÓN SELECIONADA Y LOS MOSTRARÁ EN UNA TABLA
 */

//Importamos la clase que hace las llamadas al web service.
include_once('../service/NetworkService.php');
include_once('../core/constants.php');


//Se instancia el objeto networkService;
$networkService = new NetworkService();
if (isset($_POST) && !empty($_POST) && !empty($_POST["id"])) {
    $estacion = $networkService->getEstacionById($_POST["id"])[0];//Obtenemos la estación por el id que nos pasan por post.
    echo "<div class='w3-responsive'>";
    echo "<table class='w3-table-all w3-centered w3-small'>";
    echo "<thead><tr class='w3-amber'>";
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
                echo "<td id='" . $clave . "'>" . $valor . "</td>";//Le pongo el id al td para luego poder recuperar el valor por ajax.
        }
    }
    echo "</tr>";
    echo "</table>";
} else {
    echo "<p>Ninguna estación seleccionada.";
}
?>
