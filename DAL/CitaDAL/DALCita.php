<?php
    class DALCita
    {
        function NuevaCita(Cita $nuevaCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaDB = "INSERT INTO 'CITA'('DIA','HORA','CONFIRMADO','IDASISTENTE','IDACOMPANANTE','IDESTADOCITA','ACTIVE') 
            VALUES ('".$nuevaCita->getDia()."','".$nuevaCita->getHora()."','".$nuevaCita->getConfirmado()."',
            '".$nuevaCita->getIdAsistente()."','".$nuevaCita->getIdAcompanante()."','".$nuevaCita->getIdEstadoCita()."','".$nuevaCita->getActive()."')";

            if($conexionDB->NuevaConexion($consultaDB))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }

        function ModificarCita(Cita $modificarCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaDB = "UPDATE 'CITA' SET 'DIA'='".$modificarCita->getDia()."' SET 'HORA'='".$modificarCita->getHora()."'";

            if($conexionDB->NuevaConexion($consultaDB))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }


        function BuscarCita($idAsistente)
        {
            $citaConsultada = new Cita();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'CITA' WHERE 'ACTIVE'=1 AND 'IDASISTENTE'=".$idAsistente;//PENDIENTE VER COMO BUSCAR LA CEDULA (PROBABLEMENTE SE BUSCARA POR ID)
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filaCita = $respuestaDB->fetch_assoc())
                {
                    $citaConsultada->setId($filaCita["ID"]);
                    $citaConsultada->setDia($filaCita["DIA"]);
                    $citaConsultada->setHora($filaCita["HORA"]);
                    $citaConsultada->setConfirmado($filaCita["CONFIRMADO"]);
                    $citaConsultada->setIdAsistente($filaCita["IDASISTENTE"]);
                    $citaConsultada->setIdEstadoCita($filaCita["ESTADOCITA"]);
                    $citaConsultada->setActive($filaCita["ACTIVE"]);
                }
            }
            else
            {
                $citaConsultada = null;
            }

            $conexionDB->CerrarConexion();
            return $citaConsultada;
        }

        function BuscarTodasCitas()
        {
            $citasSistema = array();
            $conexionDB = new Conexion();

            $consultaSql = "SELECT * FROM 'CITAS' WHERE 'ACTIVE' = 1";
            $respuestaDB = $conexionDB->NuevaConexion($consultaSql);

            if(mysqli_num_rows($respuestaDB)>0)
            {
                while($filasCitas = $respuestaDB->fetch_assoc())
                {
                    $citas = new Cita();
                    $citas->setId($filasCitas["ID"]);
                    $citas->setDia($filasCitas["DIA"]);
                    $citas->setHora($filasCitas["HORA"]);
                    $citas->setConfirmado($filasCitas["CONFIRMADO"]);
                    $citas->setIdAsistente($filasCitas["IDASISTENTE"]);
                    $citas->setIdEstadoCita($filasCitas["ESTADOCITA"]);
                    $citas->setActive($filasCitas["ACTIVE"]);
                    $citasSistema[]=$citas;
                }
            }
            else
            {
                $citasSistema = null;
            }

            $conexionDB->CerrarConexion();
            return $citasSistema;
        }

        function DesactivarCita(Cita $desactivarCita)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "SELECT FROM 'CITA' WHERE 'ID'= '".$desactivarCita->getId()."' SET 'ACTIVE' =".$desactivarCita->getActive();

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }
