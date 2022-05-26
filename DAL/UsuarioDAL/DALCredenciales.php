<?php
    class DALCredenciales
    {
        function NuevaCredencial(Credenciales $nuevaCredencial)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $contrasena = $nuevaCredencial->getContrasena();
            
            $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
            
            $consultaSql = "INSERT INTO `CREDENCIALES`(`CORREO`, `CONTRASENA`, `ACTIVE`) 
                    VALUES ('".$nuevaCredencial->getCorreo()."','".$contrasenaEncriptada."', 1)";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Método para buscar la ultima credencial creada y devolverla al BL
        function UltimaCredencial()
        {
            $ultimaCredencial = new Credenciales();
            $conexionDB = new Conexion();
            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `ID`=(SELECT MAX(`ID`) FROM `CREDENCIALES`) AND `ACTIVE` = 1";
            $credencial = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($credencial)>0)
            {
                while($filaCredencial = $credencial->fetch_assoc())
                {
                    $ultimaCredencial->setId($filaCredencial["id"]);
                    $ultimaCredencial->setCorreo($filaCredencial["correo"]);
                    $ultimaCredencial->setContrasena($filaCredencial["contrasena"]);
                    $ultimaCredencial->setActive($filaCredencial["active"]);
                }
            }
            else
            {
                $ultimaCredencial = null;
            }
            
            $conexionDB->CerrarConexion();
            return $ultimaCredencial;
        }
        
        function ActualizarCredenciales(Credenciales $modificarCredenciales)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            if($modificarCredenciales->getContrasena() == null)
            {
                $consultaSql = "UPDATE `CREDENCIALES` SET `CORREO`='".$modificarCredenciales->getCorreo()."' 
                    WHERE `ID`=".$modificarCredenciales->getId();
            }
            else
            {
                $contraseñaEncriptada = password_hash($modificarCredenciales->getContrasena(), PASSWORD_DEFAULT);
                $consultaSql = "UPDATE `CREDENCIALES` SET `CORREO`='".$modificarCredenciales->getCorreo()."', 
                `CONTRASENA`='".$contraseñaEncriptada."' WHERE `ID`=".$modificarCredenciales->getId();
            }

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }
            
            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarTodasCredenciales()
        {
            $credencialesDB = array();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `ACTIVE` = 1";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasCredencial = $respuestaDB->fetch_assoc())
                {
                    $credencial = new Credenciales();
                    $credencial->setId($filasCredencial["id"]);
                    $credencial->setCorreo($filasCredencial["correo"]);
                    $credencial->setContrasena($filasCredencial["contrasena"]);
                    $credencial->setActive($filasCredencial['active']);
                    $credencialesDB[]= $this->dismount($credencial);
                }
            }
            else
            {
                $credencialesDB = null;
            }
            
            $conexionDB->CerrarConexion();
            return $credencialesDB;
        }

        function BuscarIdCredencial($idUsuario)
        {
            $credencialesDB = new Credenciales();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `ID` = '$idUsuario'";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaUsuario = $respuestaDB->fetch_assoc())
                {
                    $credencialesDB->setId($filaUsuario["id"]);
                    $credencialesDB->setCorreo($filaUsuario["correo"]);
                    $credencialesDB->setContrasena($filaUsuario["contrasena"]);
                    $credencialesDB->setActive($filaUsuario["active"]);
                }
            }
            else
            {
                $credencialesDB = null;
            }

            $credencialesDB = $this->dismount($credencialesDB);
            $conexionDB->CerrarConexion();
            return $credencialesDB;
        }

        //Funcion para verificar que no existan datos iguales en la DB
        function BuscarCorreo($correo)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `CREDENCIALES` WHERE `CORREO` = '".$correo."'";             

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaCredencial = $respuestaDB->fetch_assoc())
                {
                    if($correo != $filaCredencial["correo"])
                        break;
                    else
                        $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarCredencial($idUsuario)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "UPDATE `CREDENCIALES` SET `ACTIVE` = 0 WHERE `ID`= '".$idUsuario."'";

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