<?php
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header("Location: ../../GUI/Index/Index.php");    

    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $actualizarUsuario = new Usuario();
    $cambiarCredencial = new Credenciales();
    $usuarioDAL = new DALUsuario();
    $credencialDAL = new DALCredenciales();    
    $idUsuarioActivo = $_POST['idUsuario'];//Dato de un Input oculto
    $correoActual = $_SESSION["CorreoUsuario"];

    if($_SESSION['idUsuario'] == $idUsuarioActivo)
    {
        //Datos desde el Formulario del correo y contraseña nuevos        
        $correoNuevo = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        
        $cambiarCredencial->setId($idUsuarioActivo);
        $cambiarCredencial->setCorreo($correoNuevo);
        $cambiarCredencial->setContrasena($contrasena);
        
        if($correoActual == $correoNuevo)
        {
            if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
            {
                $_SESSION["Accion"] = "¡Credenciales<br>actualizadas correctamente!";
                header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
            }
            else
            {     
                $_SESSION["Accion"] = "Ocurrió un error a la hora<br>de cambiar tus credenciales";   
                header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
            }
        }
        else if($correoActual != $correoNuevo)
        {
            if($credencialDAL->BuscarCorreo($correoNuevo) == false)
            {                
                if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
                {
                    $_SESSION["Accion"] = "¡Credenciales<br>actualizadas correctamente!";
                    header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
                }
                else
                {             
                    $_SESSION["Accion"] = "Ocurrió un error a la hora<br>de cambiar tus credenciales";   
                    header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
                }
            }
            else
            {
                echo "Ñ";
                $_SESSION["Accion"] = "El correo proporcionado (".$correoNuevo." ya existe en nuestro Sistema)";
  //              header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
            }
        }                
    }
    else
    {
        echo "Ñ";
        $_SESSION["Accion"] = "No estas autorizado para<br>modificar estas credenciales";
//        header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    }
/////////////////////////////////////////////////////////////////////////////////
