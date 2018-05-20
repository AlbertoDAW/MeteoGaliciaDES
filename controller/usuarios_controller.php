<?php
require_once('../config/conexion.php');
require_once('../model/usuario.php');
require_once('../model/crud_usuario.php');

// Iniciar una nueva sesión o reanudar la existente.
session_start();

//Instancia de la clase Usuario.
$usuario = new Usuario();

//Instancia de la clase CrudUsuario que será la encargada de las funciones básicas de la base de datos.
$crud = new CrudUsuario();

//Si la peticion es para registrarse o para insertar un nuevo usuario, obtenemos los datos.
if (isset($_POST['registrarse']) || isset($_POST['insertar_usuario'])) {//La diferencia es que uno manda al inicio al terminar y otro devuelve un mensaje.
    $usuario->setNick($_POST['nick']);
    $usuario->setPass($_POST['password']);
    $usuario->setRol($_POST['rol']);
    $usuario->setIdEstacion($_POST['id_estacion']);
    if ($usuario->getNick() != null &&
        $usuario->getPass() != null &&
        $usuario->getRol() != null &&
        $usuario->getIdEstacion() != null) {//Si tiene todos los valores.

        if (!$crud->buscarUsuario($usuario->getNick())) {//Mira que el nick del usuario no exista en bd.
            $crud->insertar($usuario);//Si no existe lo inserta el usuario en bd.
            if (isset($_POST['registrarse'])) {
                header('Location: ../index.php');//Va al index.
            } else {
                echo 'Se ha añadido correctamente en nuevo usuario.';
            }
        } else {//En caso de que el usuario ya exista va a la página de error con el mensaje.
            if (isset($_POST['registrarse'])) {
                header('Location: ../view/error.php?mensaje=El nombre de usuario ya existe.');
            } else {
                echo 'No se ha podido añadir el usuario porque ya existe uno con el mismo nick.';
            }
        }
    } else {
        echo 'Faltan datos';
    }
} elseif (isset($_POST['buscar_usuarios'])) {
    $usuarios = $crud->obtenerUsuarios();
    if (!empty($usuarios)) {
        echo "<div class='w3-responsive'>";
        echo "<table class='w3-table-all w3-centered w3-small'>";
        echo "<thead><tr class='w3-amber'>";
        echo "<th>Id</th>";
        echo "<th>Nick</th>";
        echo "<th>Rol</th>";
        echo "<th>IdEstacion</th>";
        echo "<th>Opciones</th>";
        echo "</tr></thead>";
        foreach ($usuarios as $user) {//Por cada usuario creamos las columnas con su valor.
            echo "<tr>";
            echo "<td>" . $user->getId() . "</td>";
            echo "<td>" . $user->getNick() . "</td>";
            echo "<td>" . $user->getRol() . "</td>";
            echo "<td>" . $user->getIdEstacion() . "</td>";
            echo "<td><button id='eliminar_usuario_btn' class='w3-button'>Eliminar</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron usuarios en la base de datos.";
    }
} elseif (isset($_POST['eliminar_usuario'])) {//Si no, si la peticion es para eliminar usuario.
    if (!empty($_POST['id'])) {//Si el id no está vacío.
        $crud->eliminarUsuario($_POST['id']);
        echo 'Se ha eliminado correctamente el usuario indicado.';
    } else {
        echo 'Tiene que poner el id del usuario que quiere eliminar.';
    }

} elseif (isset($_POST['entrar'])) {//Si no, si la peticion es para entrar.
    //Obtiene el usuario
    $usuario = $crud->obtenerUsuario($_POST['nick'], $_POST['password']);
    // Si el id del objeto devuelto no es null, quiere decir que encontró un registro en la base de datos.
    if ($usuario->getId() != NULL) {
        $_SESSION['usuario'] = serialize($usuario); //Se añade el usuario a la sesión.
        header('Location: ../view/dashboard.php'); //envia a la página que simula la cuenta //TODO ENVIAR A DASHBOARD
    } else {
        // Si los datos son incorrectos envia a la página de error con el mensaje.
        header('Location: ../view/error.php?mensaje=El nick o el password es incorrecto.');
    }
} elseif (isset($_GET['salir'])) { //Si no, si la peticion es para salir.
    header('Location: ../index.php');//Nos manda al index.
    unset($_SESSION['usuario']); //Destruye la sesión.
} else {
    echo 'Contacte con el administrador del sitio web.';
}
?>