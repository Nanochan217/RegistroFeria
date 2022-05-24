<?php
    include '../../Core/Conexion.php';
    include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';
    include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
    include '../../DAL/ConfiguracionDAL/DALHorario.php';
    include '../../Entidades/ConfiguracionEntidades/Configuracion.php';
    include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';
    include '../../Entidades/ConfiguracionEntidades/Horario.php';
    
    









    // $contadorDias = 1;
    // $contadorHorarios = 1;

    // //Entidades de Configuracion y demás
    // $cambiosConfiguracion = new Configuracion();
    // $cambiosDiaHabil = new DiaHabil();
    // $cambiosHorario = new Horario();

    // //DAL de Configuracion y demás
    // $configuracionDAL = new DALConfiguracion();
    // $diaHabilDAL = new DALDiaHabil();
    // $horarioDAL = new DALHorario();

    // //Captura de Datos Configuracion
    // $idConfiguracion = $_POST['idConfiguracion'];
    // $fechaInicio = $_POST['fechaInicial'];
    // $fechaFinal = $_POST['fechaFinal'];
    // $acompanantesMaximo = $_POST['maxAcompanantes'];


    //VER EL WHILE DE ACOMPANANTES PARA HACER EL CICLO CON DIA HABIL Y HORARIO
    //Captura de Datos Dia Habil
    //VER EJEMPLO DE CITAS (LA ITERACION DEL INPUT AL PRESIONAR EL BOTON DE NUEVOS ACOMP.)
    // $cantidadDias = $_POST['cantidadDias'.$contadorDias];//OJO CON ESTO
    // $diaHabil = $_POST['dia'.$contadorDias];

    // //Captura de Datos Horario
    // //VER EJEMPLO DE CITAS (LA ITERACION DEL INPUT AL PRESIONAR EL BOTON DE NUEVOS ACOMP.)
    // $cantidadHorarios = $_POST['cantidadHorario'.$contadorHorario];
    // $horaInicioHorario = $_POST['horaInicial'.$contadorDias];
    // $horaFinalHorario = $_POST['horaFinal'.$contadorDias];
    // $aforoMaximo = $_POST['aforo'.$contadorDias];

    // //Asignar datos a las entidades de Configuracion
    // $cambiosConfiguracion->setId($idConfiguracion);
    // $cambiosConfiguracion->setFechaInicio($fechaInicio);
    // $cambiosConfiguracion->setFechaFinal($fechaFinal);
    // $cambiosConfiguracion->setAcompanantesMax($acompanantesMaximo);

    //DESFRAGMENTAR ESTO Y ACOMODARLO EN LAS ESTRUCTURAS IF!!!!!!!!!!!!!!!!!!!!
    // if($configuracionDAL->ModificarConfiguracion($cambiosConfiguracion))
    // {
    //     //Asignar datos a las entidades de Dia Habil
    //     $cambiosDiaHabil->setId($idConfiguracion);
    //     $cambiosDiaHabil->setDia($diaHabil);

    //     if($diaHabilDAL->ModificarDiaHabil($$cambiosDiaHabil))
    //     {
    //         //Asignar datos a las entidades de Horario
    //         $cambiosHorario->setHoraInicio($horaInicioHorario);
    //         $cambiosHorario->setHoraFinal($horaFinalHorario);
    //         $cambiosHorario->setAforoMaximo($aforoMaximo);
    //         $cambiosHorario->setIdDiaHabil($idConfiguracion);

    //         if($horarioDAL->ModificarHorario($cambiosHorario))
    //         {
    //             echo "<h1>EXITO</h1>";
    //             //header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //         }
    //         else
    //         {
    //             echo "<h1>ERROR MODIFICAR HORARIO</h1>";
    //             //header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //         }
    //     }
    //     else
    //     {
    //         echo "<h1>ERROR MODIFICAR DIA</h1>";
    //         //header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    //     }
    // }
    // else
    // {
    //     echo "<h1>ERROR MODIFICAR CONFIG</h1>";
    //     //header("Location: ../../GUI/PantallasDestino/AcciónErronea.php");
    // }

        //OJO CON EL CANTIDADDIAS (DEVUELVE UN SQL NO UN DATO NUMERICO!!!! REVISAR DAL)
    // if($cantidadDias > $diaHabilDAL->cantidadDias($idConfiguracion))
    // {
    //     //SECCION DONDE SE AÑADEN Y SE MODIFICAN LOS DIAS HABILES
    //     while("EXPRESION")
    //     {
    //         //CICLO PARA MODIFICAR (SOBREESCRIBIR DATOS (NO SIN ANTES BUSCAR SI EXISTE))
    //         //SINO EXISTE SE AÑADE...
    //     }
    // }
    // else
    // {
    //     //SECCION DONDE SOLO SE MODIFICAN LOS DIAS HABILES (EN CASO DE NO AÑADIR NADA)
    // }

    // if($cantidadHorarios > 1)
    // {
    //     //SECCION DONDE SE AÑADEN Y SE MODIFICAN LOS HORARIOS
    //     while("EXPRESION")
    //     {
    //         //CICLO PARA MODIFICAR (SOBREESCRIBIR DATOS (NO SIN ANTES BUSCAR SI EXISTE))
    //         //SINO EXISTE SE AÑADE...
    //     }
    // }
    // else
    // {
    //     //SECCION DONDE SOLO SE MODIFICAN LOS HORARIOS (EN CASO DE NO AÑADIR NADA)
    // }
    