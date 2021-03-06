<?php
    class DALAcompanante
    {
        function NuevoAcompanante(Acompanante $nuevoAcompanante)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "INSERT INTO `ACOMPANANTE` (`CEDULA`, `NOMBRE`,`IDTIPOACOMPANANTE`,`IDCITA`) 
            VALUES ('" . $nuevoAcompanante->getCedula() . "', '" . $nuevoAcompanante->getNombre() . "',
            '" . $nuevoAcompanante->getIdTipoAcompanante() . "','" . $nuevoAcompanante->getIdCita() . "')";

            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
        
        function BuscarCedula($cedula)
        {
            $resultado = 0;
            $contador = 1;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $primeraConsulta = "SELECT * FROM `ASISTENTE` WHERE `CEDULA` = '" . $cedula . "'  AND `ACTIVE` = 1";
            $segundaConsulta = "SELECT * FROM `ACOMPANANTE` WHERE `CEDULA` = '" . $cedula . "'  AND `ACTIVE` = 1";
            
            while($contador <= 2)
            {
                if($contador == 1)
                    $respuestaDB = $conexionDB->NuevaConsulta($primeraConsulta);
                else if($contador == 2)
                    $respuestaDB = $conexionDB->NuevaConsulta($segundaConsulta);

                if(mysqli_num_rows($respuestaDB)>0)
                {
                    while($fila = $respuestaDB->fetch_assoc())
                    {
                        if($cedula != $fila["cedula"])
                            break;
                        else
                            $resultado++;
                    }
                }

                $contador++;
            }

            $conexionDB->CerrarConexion();
            
            if($resultado == 0)            
                return true;   
            else
                return false;                        
        }

        function DesactivarAcompanante($idAcompanante, $idCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            if(isset($idAcompanante))            
                $consultaSql = "UPDATE `ACOMPANANTE` SET `ACTIVE` = 0 WHERE `ID`= '" . $idAcompanante . "'";
            else if(isset($idCita))
                $consultaSql = "UPDATE `ACOMPANANTE` SET `ACTIVE` = 0 WHERE `IDCITA`= '" . $idCita . "'";
            
            if($conexionDB->NuevaConsulta($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function BuscarAcompananteIdCita($idCita)
        {
            $acompanante = new Acompanante();
            $conexionDB = new Conexion();
            $conexionDB->NuevaConexion();

            $consultaSql = "SELECT * FROM `ACOMPANANTE` WHERE `IDCITA` = '".$idCita."'";

            $respuestaDB = $conexionDB->NuevaConsulta($consultaSql);

            if (mysqli_num_rows($respuestaDB) > 0)
            {
                while ($filaAcompanante = $respuestaDB->fetch_assoc())
                {                    
                    $acompanante->setId($filaAcompanante["id"]);
                    $acompanante->setCedula($filaAcompanante["cedula"]);
                    $acompanante->setNombre($filaAcompanante["nombre"]);
                    $acompanante->setIdTipoAcompanante($filaAcompanante["idTipoAcompanante"]);
                    $acompanante->setIdCita($filaAcompanante["idCita"]);
                    $acompanante->setActive($filaAcompanante['active']);                    
                }
            }
            else
            {
                $acompanante = null;
            }

            $acompanante = $this->dismount($acompanante);
            $conexionDB->CerrarConexion();
            return $acompanante;
        }

        function dismount($object)
        {
            $reflectionClass = new ReflectionClass(get_class($object));
            $array = array();
            foreach ($reflectionClass->getProperties() as $property)
            {
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($object);
                $property->setAccessible(false);
            }
            return $array;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////