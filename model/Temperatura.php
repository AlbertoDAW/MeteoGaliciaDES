<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alberto García Olivero
 * Date: 16/05/2018
 * Time: 21:50
 */

class Temperatura
{
    private $id;
    private $id_usuario;
    private $id_estacion;
    private $valTemperatura;

    /**
     * Temperatura constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getIdEstacion()
    {
        return $this->id_estacion;
    }

    /**
     * @param mixed $id_estacion
     */
    public function setIdEstacion($id_estacion)
    {
        $this->id_estacion = $id_estacion;
    }

    /**
     * @return mixed
     */
    public function getValTemperatura()
    {
        return $this->valTemperatura;
    }

    /**
     * @param mixed $valTemperatura
     */
    public function setValTemperatura($valTemperatura)
    {
        $this->valTemperatura = $valTemperatura;
    }


}