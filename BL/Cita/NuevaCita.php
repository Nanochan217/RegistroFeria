<?php
    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALCita.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../Entidades/CitasEntidades/Cita.php';
    include '../../Entidades/CitasEntidades/Asistente.php';
    include '../../Entidades/CitasEntidades/Acompanante.php';

    $asistenteDAL = new DALAsistente();
    $citaDAL = new DALCita();
    $acompananteDAL = new DALAcompanante();

    //Arrays
    $datosAsistente = $_POST['asistente'];
    $datosCita = $_POST['cita'];
    $datosAcompanante = $_POST['acompanantes'];
    //echo "ola";

    $idAsistente = NuevoAsistente($datosAsistente);

    if (isset($idAsistente))
    {
        $idCita = CrearCita($datosCita, $idAsistente);

        if (isset($idCita))
        {
            if (NuevoAcompanante($datosAcompanante, $idCita))
                echo 1;
            else
            {
                $acompananteDAL->DesactivarAcompanante(null, $idCita);
                $citaDAL->DesactivarCita($idCita);
                echo 0;
            }
        }
        else
        {
            $asistenteDAL->DesactivarAsistente($idAsistente);
            echo 0;
        }
    }
    else
    {
        echo 0;
    }


    function NuevoAsistente($datosNuevoAsistente)
    {
        $asistenteDAL = new DALAsistente();
        $nuevoAsistente = new Asistente();

        foreach ($datosNuevoAsistente as $datos)
        {            
            $nuevoAsistente->setCedula($datosNuevoAsistente[$datos]);
            $nuevoAsistente->setNombre($datosNuevoAsistente[$datos]);
            $nuevoAsistente->setApellido1($datosNuevoAsistente[$datos]);
            $nuevoAsistente->setApellido2($datosNuevoAsistente[$datos]);
            $nuevoAsistente->setCorreo($datosNuevoAsistente[$datos]);
            $nuevoAsistente->setTelefono($datosNuevoAsistente[$datos]);
            $nuevoAsistente->setIdColegioProcedencia($datosNuevoAsistente[$datos]);
        }

        $idNuevoAsistente = $asistenteDAL->NuevoAsistente($nuevoAsistente);

        if (isset($idNuevoAsistente))
            return $idNuevoAsistente;
        else
            return null;
    }

    function CrearCita($datosNuevoCita, $idAsistenteNuevo)
    {
        $citaDAL = new DALCita();
        $nuevaCita = new Cita();

        foreach ($datosNuevoCita as $datos)
        {                        
            $nuevaCita->setDia($datos['fechaCita']);
            $nuevaCita->setHora($datos['horario']);
            $nuevaCita->setIdAsistente($idAsistenteNuevo);            
        }

        $idNuevaCita = $citaDAL->NuevaCita($nuevaCita);

        if (isset($idNuevaCita))
            return $idNuevaCita;
        else
            return null;
    }

    function NuevoAcompanante($datosNuevoAcompanante, $idCitaNueva)
    {
        $resultado = true;
        $acompananteDAL = new DALAcompanante();
        $nuevoAcompanante = new Acompanante();

        //OJO con el ciclo
        foreach ($datosNuevoAcompanante as $value)
        {
            foreach ($value as $datos)
            {
                $nuevoAcompanante->setCedula($datos['cedula']);
                $nuevoAcompanante->setNombre($datos['nombre']);
                $nuevoAcompanante->setIdTipoAcompanante($datos['idTipoAcompanante']);
                $nuevoAcompanante->setIdCita($idCitaNueva);

                if ($acompananteDAL->NuevoAcompanante($nuevoAcompanante))
                    continue;
                else
                {
                    $resultado = false;
                    break;
                }
            }
        }

        return $resultado;
    }

    // $cedulasRegistradas = array();
    // $contador = 1;
    // $asistenteDAL = new DALAsistente();
    // $citaDAL = new DALCita();
    // $acompananteDAL = new DALAcompanante();    
        
    // //Cantidad de Acompañantes
    // $cantidadAcompanantes = $_POST['cantidadAcompanantes'];
    
    // //Objetos para almacenar los datos del Formulario
    // $nuevoAsistente = new Asistente();
    // $nuevoAcompanante = new Acompanante();
    // $nuevaCita = new Cita();    

    // //Datos del Asistente
    // $cedulaAsistente = $_POST['cedula'];
    // $nombreAsistente = $_POST['nombre'];
    // $apellido1Asistente = $_POST['apellido1'];
    // $apellido2Asistente = $_POST['apellido2'];
    // $correoAsistente = $_POST['email'];
    // $telefonoAsistente = $_POST['telefono'];
    // $colegioAsistente = $_POST['colegioProcedencia'];

    // // //Datos de la Cita
    // $diaCita = $_POST['diaCita'];
    // $horaCita = $_POST['horarioCita'];

    // if($asistenteDAL->BuscarCedula($cedulaAsistente) == false)
    // {        
    //     $nuevoAsistente->setCedula($cedulaAsistente);
    //     $nuevoAsistente->setNombre($nombreAsistente);
    //     $nuevoAsistente->setApellido1($apellido1Asistente);
    //     $nuevoAsistente->setApellido2($apellido2Asistente);
    //     $nuevoAsistente->setCorreo($correoAsistente);
    //     $nuevoAsistente->setTelefono($telefonoAsistente);
    //     $nuevoAsistente->setIdColegioProcedencia($colegioAsistente);
    //     $nuevoAsistente->setActive(1);

    //     if($asistenteDAL->NuevoAsistente($nuevoAsistente))
    //     {
    //         //Se obtiene la ID del último Asistente registrado
    //         $idAsistente = $asistenteDAL->UltimoAsistente();
            
    //         $nuevaCita->setDia($diaCita);
    //         $nuevaCita->setHora($horaCita);
    //         $nuevaCita->setConfirmado(0);
    //         $nuevaCita->setIdAsistente($idAsistente);
    //         $nuevaCita->setIdEstadoCita(2);
    //         $nuevaCita->setActive(1);           

    //         if($citaDAL->NuevaCita($nuevaCita))
    //         {
    //             //Regresa la última la id de la cita recien registrada
    //             $idCita = $citaDAL->UltimaCita();

    //                 while($contador <= $cantidadAcompanantes)
    //                 {  
    //                     //Datos del Acompañante
    //                     $cedulaAcompanante = $_POST['cedulaAcompanante'.$contador];
    //                     $nombreAcompanante = $_POST['nombreAcompanante'.$contador];
    //                     $tipoAcompanante = $_POST['parentescoAcompanante'.$contador];

    //                     $nuevoAcompanante->setCedula($cedulaAcompanante);
    //                     $nuevoAcompanante->setNombre($nombreAcompanante);
    //                     $nuevoAcompanante->setIdTipoAcompanante($tipoAcompanante);
    //                     $nuevoAcompanante->setIdCita($idCita);
    //                     $nuevoAcompanante->setActive(1);

    //                     if($cantidadAcompanantes != 0)
    //                     {
    //                         if($acompananteDAL->BuscarCedula($cedulaAcompanante) == false)
    //                         {
    //                             if($acompananteDAL->NuevoAcompanante($nuevoAcompanante))
    //                             {
    //                                 $contador++;
    //                             }
    //                             else
    //                             {
    //                                 //echo "<h1>NUEVA ACOMPANANTE ERROR</h1>";
    //                                 $citaDAL->DesactivarCita($idCita);
    //                                 $asistenteDAL->DesactivarAsistente($idAsistente);                                    
    //                                 header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //                                 echo "Ocurrió un error...<br>Intentelo más tarde...";
    //                             }
    //                         }
    //                         else
    //                         {
    //                             echo "Ya hay un Acompañante registrado con la cédula: ".$cedulaAcompanante."";
    //                         }
    //                     }                                                
    //                 }                    

    //             header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");
    //             //echo "Ocurrió un error...<br>Intentelo más tarde...";
    //         }
    //         else
    //         {                
    //             $asistenteDAL->DesactivarAsistente($idAsistente);
    //             header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //             echo "Ocurrió un error...<br>Intentelo más tarde...";
    //         }
    //     }
    //     else
    //     {            
    //         header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //         echo "Ocurrió un error...<br>Intentelo más tarde...";
    //     }
    // }
    // else
    // {        
    //     header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //     echo "Ya hay un Asistente registrado con la cedula : ".$cedulaAsistente."";
    // }        

///////////////////////////////////////////////////////////////////////////////////////////