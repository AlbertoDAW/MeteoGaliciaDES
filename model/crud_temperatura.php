<?php
require_once('../config/conexion.php');
require_once('Temperatura.php');

class CrudTemperatura
{
    public function __construct()
    {
    }

    //Inserta la temeperatura
    public function insertar(Temperatura $temperatura)
    {
        $db = DB::conectar();
        $insert = $db->prepare('INSERT INTO TEMPERATURAS VALUES(NULL,:id_usuario, :id_estacion, :valTemperatura)');
        $insert->bindValue('id_usuario', $temperatura->getIdUsuario());//Vincula el valor de un parámetro a una variable de sentencia
        $insert->bindValue('id_estacion', $temperatura->getIdEstacion());
        $insert->bindValue('valTemperatura', $temperatura->getValTemperatura());
        $insert->execute();
    }

    //Obtiene todas las temperaturas de la base de datos.
    public function obtenerTemperaturas()
    {
        $db = Db::conectar();
        $select = $db->prepare('SELECT * FROM TEMPERATURAS');
        $select->execute();
        $result = $select->fetch();
        //TODO RECORRER RESULT Y DEVOLVER UNA LISTA DE OBJETOS TEMPERATURA
        return $result;
    }

    //Obtiene las temperaturas registradas por un usuario.
    public function obtenerTemperaturasPorUsuario($id_usuario)
    {
        $db = Db::conectar();
        $select = $db->prepare('SELECT * FROM TEMPERATURAS WHERE $id_usuario=:$id_usuario');
        $select->bindValue('$id_usuario', $id_usuario);
        $select->execute();
        $result = $select->fetch();
        //TODO RECORRER RESULT Y DEVOLVER UNA LISTA DE OBJETOS TEMPERATURA
        return $result;
    }
}

?>