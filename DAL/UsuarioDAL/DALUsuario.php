<?php
    class DALUsuario 
    {
        //Añade un nuevo Usuario a la Base de Datos
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

        function DesactivarUsuario(Usuario $desactivarUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT FROM `USUARIO` WHERE `ID`= '".$desactivarUsuario->getId()."' SET `ACTIVE` =".$desactivarUsuario->getActive();

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
