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
        $correoNuevo = $_POST['correoInput'];
        $contrasena = $_POST['contrasena'];
        
        $cambiarCredencial->setId($idUsuarioActivo);
        $cambiarCredencial->setCorreo($correoNuevo);
        $cambiarCredencial->setContrasena($contrasena);
        
        if($correoActual == $correoNuevo)
        {
            if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
            {
                header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
            }
            else
            {                
                header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
            }
        }
        else if($correoActual == $correoNuevo)
        {
            if($credencialDAL->BuscarCorreo($correoNuevo) == false)
            {                
                if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
                {
                    header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
                }
                else
                {                
                    header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
                }
            }            
        }
        else
        {
            echo false;
        }

        // if($credencialDAL->BuscarCorreo(1, $correo))
        // {
            // if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
            // {
            //     header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
            // }
            // else
            // {                
            //     header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
            // }
        // }
        // else
        // {
        //     echo "El correo ".$correo." se encuentra registrado...";
        // }
    }
    else
    {
        //Hacer un alert con JS para una mejor visualización de la Alerta
        echo "<h1>ESTAS MODIFICANDO DATOS DE OTRA PERSONA, NO TIENES AUTORIZACION</h1>";        
    }
/////////////////////////////////////////////////////////////////////////////////
