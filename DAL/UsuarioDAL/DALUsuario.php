<?php
    class DALUsuario 
    {        
        function NuevoUsuario(Usuario $nuevoUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO `USUARIO`(`CEDULA`, `NOMBRE`, `APELLIDO1`, `APELLIDO2`, `IDCREDENCIALES`, `IDPERFIL`, `ACTIVE`) 
                    VALUES ('".$nuevoUsuario->getCedula()."','".$nuevoUsuario->getNombre()."','".$nuevoUsuario->getApellido1()."',
                    '".$nuevoUsuario->getApellido2()."','".$nuevoUsuario->getIdCredenciales()."','".$nuevoUsuario->getIdPerfil()."', 1)";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
        
        function ActualizarUsuario(Usuario $modificarUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $consultaSql = "UPDATE `USUARIO` SET `CEDULA`='".$modificarUsuario->getCedula()."', `NOMBRE`='".$modificarUsuario->getNombre()."',
                `APELLIDO1`='".$modificarUsuario->getApellido1()."',
                `APELLIDO2`='".$modificarUsuario->getApellido2()."',
                `IDPERFIL`='".$modificarUsuario->getIdPerfil()."' WHERE `ID`=".$modificarUsuario->getId();

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarTodosUsuario()
        {
            $usuariosDB = array();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `USUARIO` WHERE `ACTIVE` = 1";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasUsuario = $respuestaDB->fetch_assoc())
                {
                    $usuario = new Usuario();
                    $usuario->setId($filasUsuario["id"]);
                    $usuario->setCedula($filasUsuario["cedula"]);
                    $usuario->setNombre($filasUsuario["nombre"]);
                    $usuario->setApellido1($filasUsuario["apellido1"]);
                    $usuario->setApellido2($filasUsuario["apellido2"]);
                    $usuario->setIdCredenciales($filasUsuario["idCredenciales"]);
                    $usuario->setIdPerfil($filasUsuario["idPerfil"]);
                    $usuario->setActive($filasUsuario['active']);
                
                    $usuariosDB[]= $this->dismount($usuario) ;
                }
            }
            else
            {
                $usuariosDB = null;
            }

            $conexionDB->CerrarConexion();
            return $usuariosDB;

        
        }

        //Buscar al Usuario durante el LogIn para extraer sus datos
        function BuscarSesionUsuario($idUsuario)
        {
            $usuarioDB = new Usuario();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `USUARIO` WHERE `ID` =".$idUsuario;

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {
                    $usuarioDB->setId($filaUsuario["id"]);
                    $usuarioDB->setCedula($filaUsuario["cedula"]);
                    $usuarioDB->setNombre($filaUsuario["nombre"]);
                    $usuarioDB->setApellido1($filaUsuario["apellido1"]);
                    $usuarioDB->setApellido2($filaUsuario["apellido2"]);
                    $usuarioDB->setIdCredenciales($filaUsuario["idCredenciales"]);
                    $usuarioDB->setIdPerfil($filaUsuario["idPerfil"]);
                    $usuarioDB->setActive($filaUsuario['active']);
                }
            }
            else
            {
                $usuarioDB = null;
            }
            
            $conexionDB->CerrarConexion();
            return $usuarioDB;
        }

        function BuscarIdUsuario($idUsuario)
        {
            $usuarioDB = new Usuario();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `USUARIO` WHERE `ID` =".$idUsuario;

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {
                    $usuarioDB->setId($filaUsuario["id"]);
                    $usuarioDB->setCedula($filaUsuario["cedula"]);
                    $usuarioDB->setNombre($filaUsuario["nombre"]);
                    $usuarioDB->setApellido1($filaUsuario["apellido1"]);
                    $usuarioDB->setApellido2($filaUsuario["apellido2"]);
                    $usuarioDB->setIdCredenciales($filaUsuario["idCredenciales"]);
                    $usuarioDB->setIdPerfil($filaUsuario["idPerfil"]);
                    $usuarioDB->setActive($filaUsuario['active']);
                }
            }
            else
            {
                $usuarioDB = null;
            }
            
            $usuarioDB = $this->dismount($usuarioDB);
            $conexionDB->CerrarConexion();
            return $usuarioDB;
        }

        //Funcion para verificar que no existan datos iguales en la DB
        function BuscarCedula($cedula)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `USUARIO` WHERE `CEDULA` = '".$cedula."'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {                    
                    if($cedula != $filaUsuario["cedula"])
                        break;
                    else
                        $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarCorreo($correo)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `USUARIO` WHERE `CORREO` = '".$correo."'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {                    
                    if($correo != $filaUsuario["correo"])
                        break;
                    else
                        $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarUsuario($idUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "UPDATE `USUARIO` SET `ACTIVE` = 0 WHERE `ID`= '".$idUsuario."'";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
        
        function dismount($object)
        {
            $reflectionClass = new ReflectionClass(get_class($object));
            $array = array();
            foreach ($reflectionClass->getProperties() as $property) {
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($object);
                $property->setAccessible(false);
            }
            return $array;
        }   
    }

///////////////////////////////////////////////////////////////////////////////////////////