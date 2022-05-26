<?php    
    
    include '../../Core/Conexion.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';

    $cambiarCredencial = new Credenciales();
    $credencialDAL = new DALCredenciales();
    $idUsuario = $_POST['idUsuario'];
    $correoUsuario = $_POST['email'];
    $contrasenaUsuario = $_POST['contrasena'];
    
    $cambiarCredencial->setId($idUsuario);
    $cambiarCredencial->setCorreo($correoUsuario);
    $cambiarCredencial->setContrasena($contrasenaUsuario);

    if($credencialDAL->ActualizarCredenciales($cambiarCredencial))
    {
        CambiarInformacion();
    }
    else
        header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        
    //Funcion o metodo para modificar la informacion del Usuario o sobreescribirla
    function CambiarInformacion()
    {
        $actualizarUsuario = new Usuario();
        $usuarioDAL = new DALUsuario();
        $idUsuario = $_POST['idUsuario'];

        $cedulaUsuario = $_POST['cedula'];
        $nombreUsuario = $_POST['nombre'];
        $apellido1Usuario = $_POST['apellido1'];
        $apellido2Usuario = $_POST['apellido2'];
        $idPerfilUsuario = $_POST['tipoPerfil'];
        $idCredencialUsuario = $idUsuario;
        
        $actualizarUsuario->setId($idUsuario);
        $actualizarUsuario->setCedula($cedulaUsuario);
        $actualizarUsuario->setNombre($nombreUsuario);
        $actualizarUsuario->setApellido1($apellido1Usuario);
        $actualizarUsuario->setApellido2($apellido2Usuario);
        $actualizarUsuario->setIdCredenciales($idCredencialUsuario);
        $actualizarUsuario->setIdPerfil($idPerfilUsuario);

        if($usuarioDAL->ActualizarUsuario($actualizarUsuario))
        {        
            header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
        }
        else
        {
            header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////