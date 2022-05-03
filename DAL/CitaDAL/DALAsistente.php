<?php
    class DALAsistente
    {
        function NuevoAsistente(Asistente $nuevoAsistente)
        {
            $resultado = false;
            $conexionDB = new Conexion();

            $consultaSql = "INSERT INTO 'ASISTENTE' ('CEDULA','NOMBRE','APELLIDO1','APELLIDO2','CORREO','TELEFONO','IDCOLEGIOPROCEDENCIA','ACTIVE')
                            VALUES ('".$nuevoAsistente->getCedula()."','".$nuevoAsistente->getNombre()."','".$nuevoAsistente->getApellido1()."','".$nuevoAsistente->getApellido2()."'
                            ,'".$nuevoAsistente->getCorreo()."','".$nuevoAsistente->getTelefono()."','".$nuevoAsistente->getIdColegioProcedencia()."','".$nuevoAsistente->getActive()."')";

            if($conexionDB->NuevaConexion($consultaSql))
            {
                $resultado = true;
            }

            $conexionDB->CerrarConexion();
            return $resultado;
        }
    }