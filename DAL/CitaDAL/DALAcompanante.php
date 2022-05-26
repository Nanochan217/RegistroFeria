<?php
    class DALAcompanante
    {
        function NuevoAcompanante(Acompanante $nuevoAcompanante)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO `ACOMPANANTE` (`CEDULA`, `NOMBRE`,`IDTIPOACOMPANANTE`,`IDCITA`,`ACTIVE`) 
                            VALUES ('".$nuevoAcompanante->getCedula()."', '".$nuevoAcompanante->getNombre()."',
                            '".$nuevoAcompanante->getIdTipoAcompanante()."','".$nuevoAcompanante->getIdCita()."',
                            '".$nuevoAcompanante->getActive()."')";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        //Funcion para verificar que no existan datos iguales en la DB
        function BuscarCedula($cedula)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM `ACOMPANANTE` WHERE `CEDULA` = '".$cedula."'  AND `ACTIVE` = 1";

            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaAcompanante = $respuestaDB->fetch_assoc())
                {
                    if($cedula != $filaAcompanante["cedula"])
                        break;
                    else
                        $resultado = true;
                }
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function DesactivarAcompanante($idAcompanante)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "UPDATE `ACOMPANANTE` SET `ACTIVE` = 0 WHERE `ID`= '".$idAcompanante."'";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////