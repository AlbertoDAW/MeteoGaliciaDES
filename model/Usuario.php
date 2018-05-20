<?php
/**
 * Created by IntelliJ IDEA.
 * User: Alberto García Olivero
 * Date: 16/05/2018
 * Time: 21:45
 */

class Usuario
{
    private $id;
    private $nick;
    private $pass;
    private $rol;
    private $idEstacion;

    /**
     * Usuario constructor.
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
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * @param mixed $nick
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getIdEstacion()
    {
        return $this->idEstacion;
    }

    /**
     * @param mixed $idEstacion
     */
    public function setIdEstacion($idEstacion)
    {
        $this->idEstacion = $idEstacion;
    }


}