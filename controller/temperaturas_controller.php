<?php
require_once('../config/conexion.php');
require_once('../model/Temperatura.php');
require_once('../model/crud_temperatura.php');

// Iniciar una nueva sesión o reanudar la existente.
session_start();

//Instancia de la clase Usuario.
$temperatura = new Temperatura();

//Instancia de la clase CrudTemperatura que será la encargada de las funciones básicas de la base de datos.
$crud = new CrudTemperatura();
//Si la peticion es para registrarse, obtenemos los datos.
if (isset($_POST['insertar'])) {
    $temperatura->setIdUsuario($_POST['id_usuario']);
    $temperatura->setIdEstacion($_POST['id_estacion']);
    $temperatura->setValTemperatura($_POST['valTemperatura']);
    if ($temperatura->getIdUsuario() != null &&
        $temperatura->getValTemperatura() != null &&
        $temperatura->getIdEstacion() != null) {//Si tiene todos los valores.

        $crud->insertar($temperatura);//Inserta la temperatura en base de datos.
        echo 'LA TEMPERATURA SE HA GUARDADO CORRECTAMENTE.';
        return true;
    } else {//Si no, muestra un mensaje de error.
        echo 'Para poder guardar la temperatura antes tiene que seleccionar una estación.';
        return false;
    }
} elseif (isset($_POST['obtener'])) {//Si no, si la peticion es para entrar.
    ///TODO OBTENER LAS TEMPERATURAS QUE TIENE GUARDADAS UN USUARIO PARA LUEGO MOSTRARSELAS EN UNA TABLA.
    $temperatura = $crud->obtenerTemperaturasPorUsuario($_POST['id_usuario']);
}

?>