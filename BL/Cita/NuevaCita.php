<?php    
    include '../../Core/GenerarPDF/fpdf/fpdf.php';
    include '../../Core/Conexion.php';
    include '../../DAL/CitaDAL/DALCita.php';
    include '../../DAL/CitaDAL/DALAsistente.php';
    include '../../DAL/CitaDAL/DALAcompanante.php';
    include '../../DAL/CitaDAL/DALComprobante.php';
    include '../../Entidades/CitasEntidades/Cita.php';
    include '../../Entidades/CitasEntidades/Asistente.php';
    include '../../Entidades/CitasEntidades/Acompanante.php';
    include '../../Entidades/CitasEntidades/Comprobante.php';        
    
    $cedulasRegistradas = array();
    $contador = 1;
    $asistenteDAL = new DALAsistente();
    $citaDAL = new DALCita();
    $acompananteDAL = new DALAcompanante();
    $comprobanteCita = new DALComprobante();
        
    //Cantidad de Acompañantes
    $cantidadAcompanantes = $_POST['cantidadAcompanantes'];
    
    //Objetos para almacenar los datos del Formulario
    $nuevoAsistente = new Asistente();
    $nuevoAcompanante = new Acompanante();
    $nuevaCita = new Cita();
    $nuevoComprobante = new Comprobante();

    //Datos del Asistente
    $cedulaAsistente = $_POST['cedula'];
    $nombreAsistente = $_POST['nombre'];
    $apellido1Asistente = $_POST['apellido1'];
    $apellido2Asistente = $_POST['apellido2'];
    $correoAsistente = $_POST['email'];
    $telefonoAsistente = $_POST['telefono'];
    $colegioAsistente = $_POST['colegioProcedencia'];

    // //Datos de la Cita
    $diaCita = $_POST['diaCita'];
    $horaCita = $_POST['horarioCita'];

    if($asistenteDAL->BuscarCedula($cedulaAsistente) == false)
    {        
        $nuevoAsistente->setCedula($cedulaAsistente);
        $nuevoAsistente->setNombre($nombreAsistente);
        $nuevoAsistente->setApellido1($apellido1Asistente);
        $nuevoAsistente->setApellido2($apellido2Asistente);
        $nuevoAsistente->setCorreo($correoAsistente);
        $nuevoAsistente->setTelefono($telefonoAsistente);
        $nuevoAsistente->setIdColegioProcedencia($colegioAsistente);
        $nuevoAsistente->setActive(1);

        if($asistenteDAL->NuevoAsistente($nuevoAsistente))
        {
            //Se obtiene la ID del último Asistente registrado
            $idAsistente = $asistenteDAL->UltimoAsistente();
            
            $nuevaCita->setDia($diaCita);
            $nuevaCita->setHora($horaCita);
            $nuevaCita->setConfirmado(0);
            $nuevaCita->setIdAsistente($idAsistente);
            $nuevaCita->setIdEstadoCita(2);
            $nuevaCita->setActive(1);           

            if($citaDAL->NuevaCita($nuevaCita))
            {
                //Regresa la última la id de la cita recien registrada
                $idCita = $citaDAL->UltimaCita();

                    while($contador <= $cantidadAcompanantes)
                    {  
                        //Datos del Acompañante
                        $cedulaAcompanante = $_POST['cedulaAcompanante'.$contador];
                        $nombreAcompanante = $_POST['nombreAcompanante'.$contador];
                        $tipoAcompanante = $_POST['parentescoAcompanante'.$contador];

                        $nuevoAcompanante->setCedula($cedulaAcompanante);
                        $nuevoAcompanante->setNombre($nombreAcompanante);
                        $nuevoAcompanante->setIdTipoAcompanante($tipoAcompanante);
                        $nuevoAcompanante->setIdCita($idCita);
                        $nuevoAcompanante->setActive(1);

                        if($cantidadAcompanantes != 0)
                        {
                            if($acompananteDAL->BuscarCedula($cedulaAcompanante) == false)
                            {
                                if($acompananteDAL->NuevoAcompanante($nuevoAcompanante))
                                {
                                    $contador++;
                                }
                                else
                                {
                                    //echo "<h1>NUEVA ACOMPANANTE ERROR</h1>";
                                    $citaDAL->DesactivarCita($idCita);
                                    $asistenteDAL->DesactivarAsistente($idAsistente);
                                    break;
                                    header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
                                }
                            }
                        }                                                
                    }                    

                header("Location: ../../GUI/PantallasDestino/AcciónExitosa.php");                                                                                                                
                //$comprobanteCita->GenerarPDF($nuevoAsistente , $nuevoAcompanante, $nuevaCita, $contador);                    
            }
            else
            {                
                $asistenteDAL->DesactivarAsistente($idAsistente);
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

///////////////////////////////////////////////////////////////////////////////////////////