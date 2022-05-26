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

    if($_SESSION['idUsuario'] == $idUsuarioActivo)
    {
        //Datos desde el Formulario del correo y contraseña nuevos
        $correo = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        
        $cambiarCredencial->setId($idUsuarioActivo);
        $cambiarCredencial->setCorreo($correo);
        $cambiarCredencial->setContrasena($contrasena);
        
        if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
        {
            header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
        }
        else
        {
            header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        }
    }
    else
    {
        //Hacer un alert con JS para una mejor visualización de la Alerta
        echo "<h1>ESTAS MODIFICANDO DATOS DE OTRA PERSONA, NO TIENES AUTORIZACION</h1>";        
    }
/////////////////////////////////////////////////////////////////////////////////
