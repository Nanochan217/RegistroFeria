<?php
    class DALAcompanante
    {
        function NuevoAcompanante(Acompanante $nuevoAcompanante)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO `ACOMPANANTE` (`CEDULA`,`IDTIPOACOMPANANTE`,`IDCITA`,`ACTIVE`) 
                            VALUES ('".$nuevoAcompanante->getCedula()."','".$nuevoAcompanante->getIdTipoAcompanante()."',
                            '".$nuevoAcompanante->getIdCita()."','".$nuevoAcompanante->getActive()."')";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }