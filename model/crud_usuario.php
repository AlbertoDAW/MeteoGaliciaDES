<?php
require_once('../config/conexion.php');
require_once('Usuario.php');

class CrudUsuario
{
    public function __construct()
    {
    }

    //Inserta los datos del usuario
    public function insertar(Usuario $usuario)
    {
        $db = DB::conectar();
        $insert = $db->prepare('INSERT INTO USUARIOS VALUES(NULL,:nick, :pass, :rol, :idEstacion)');
        $insert->bindValue('nick', $usuario->getNick());//Vincula el valor de un parámetro a una variable de sentencia

        /**
         * Advertencia
         * No se recomienda utilizar la función md5 para contraseñas seguras debido a la naturaleza rápida de este algoritmo de «hashing».
         * Véase las Preguntas más frecuentes de «hash» de contraseñas para más detalles y el empleo de mejores prácticas.
         */
        //Encripta la clave con password_hash en vez de md5 que vi que no era segura.
        $pass = password_hash($usuario->getPass(), PASSWORD_DEFAULT);
        $insert->bindValue('pass', $pass);
        $insert->bindValue('rol', $usuario->getRol());
        $insert->bindValue('idEstacion', $usuario->getIdEstacion());
        $insert->execute();
    }

    //Obtiene el usuario para el login.
    public function obtenerUsuario($nick, $password)
    {
        $db = Db::conectar();
        $select = $db->prepare('SELECT * FROM USUARIOS WHERE nick=:nick');//No hace falta AND pass=:pass ya que el nick será clave única y la verificación de pass la hago más adelante.
        $select->bindValue('nick', $nick);
        $select->execute();
        $result = $select->fetch();
        $usuario = new Usuario();
        //Verifica si la clave es correcta.
        if (password_verify($password, $result['pass'])) {
            //Si es correcta, asigna los valores que trae desde la base de datos.
            $usuario->setId($result['id']);
            $usuario->setNick($result['nick']);
            $usuario->setPass($result['pass']);
            $usuario->setRol($result['rol']);
            $usuario->setIdEstacion($result['idEstacion']);
        }
        return $usuario;
    }

    //Obtiene todos los usuarios de la bd.
    public function obtenerUsuarios()
    {
        $db = Db::conectar();
        $select = $db->prepare('SELECT * FROM USUARIOS');
        $select->execute();
        $usuarios = array();
        while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario();
            $usuario->setId($result['id']);
            $usuario->setNick($result['nick']);
            $usuario->setPass($result['pass']);
            $usuario->setRol($result['rol']);
            $usuario->setIdEstacion($result['idEstacion']);
            array_push($usuarios, $usuario);//Añade el usuario al array de usuarios.
        }
        return $usuarios;
    }

    //Busca si existe el nick del usuario en bd.
    public function buscarUsuario($nick)
    {
        $db = Db::conectar();
        $select = $db->prepare('SELECT * FROM USUARIOS WHERE nick=:nick');
        $select->bindValue('nick', $nick);
        $select->execute();
        $registro = $select->fetch();
        return $registro['id'] != NULL;//Si existe un id devolverá true.
    }

    //Elimina el usuario de bd.
    public function eliminarUsuario($id)
    {
        $db = Db::conectar();
        $sql = $db->prepare('DELETE FROM USUARIOS WHERE id=:id');
        $sql->bindValue('id', $id);
        $sql->execute();
    }
}

?>