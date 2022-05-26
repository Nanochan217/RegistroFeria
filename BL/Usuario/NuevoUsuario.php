<?php
    include '../../Core/Conexion.php';
    include '../../Entidades/UsuarioEntidades/Credenciales.php';
    include '../../Entidades/UsuarioEntidades/Usuario.php';
    include '../../DAL/UsuarioDAL/DALUsuario.php';
    include '../../DAL/UsuarioDAL/DALCredenciales.php';

    $accion = "Nuevo Usuario";
    $nuevoUsuario = new Usuario();
    $usuarioDAL = new DALUsuario();

    $nuevaCredencial = new Credenciales();
    $credencialDAL = new DALCredenciales();

    $cedulaUsuario = $_POST['cedula'];
    $correoUsuario = $_POST['email'];
    $contrasenaUsuario = $_POST['contrasena'];

    if($usuarioDAL->BuscarCedula($cedulaUsuario) == false && $credencialDAL->BuscarCorreo($correoUsuario) == false)
    {        
        $nuevaCredencial->setCorreo($correoUsuario);
        $nuevaCredencial->setContrasena($contrasenaUsuario);
    
        if($credencialDAL->NuevaCredencial($nuevaCredencial))
        {
            //Obtener la ID de la credencial recien añadida
            $ultimaCredencial = $credencialDAL->UltimaCredencial();
            
            $nombreUsuario = $_POST['nombre'];
            $apellido1Usuario = $_POST['apellido1'];
            $apellido2Usuario = $_POST['apellido2'];
            $idPerfilUsuario = $_POST['tipoPerfil'];
            $idCredencialUsuario = $ultimaCredencial->getId();

            $nuevoUsuario->setCedula($cedulaUsuario);
            $nuevoUsuario->setNombre($nombreUsuario);
            $nuevoUsuario->setApellido1($apellido1Usuario);
            $nuevoUsuario->setApellido2($apellido2Usuario);
            $nuevoUsuario->setIdCredenciales($idCredencialUsuario);
            $nuevoUsuario->setIdPerfil($idPerfilUsuario);

            //Nuevo Usuario
            if($usuarioDAL->NuevoUsuario($nuevoUsuario))
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
            header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
        }
    }
    else
    {
        header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    }
    
/////////////////////////////////////////////////////////////////////////////