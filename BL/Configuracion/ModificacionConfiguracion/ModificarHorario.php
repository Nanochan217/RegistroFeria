<?php
    include '../../../Core/Conexion.php';    
    include '../../../DAL/ConfiguracionDAL/DALHorario.php';
    include '../../../Entidades/ConfiguracionEntidades/Horario.php';          

    $horarioDAL = new DALHorario();
    $horario = new Horario();
    $estadoHorario = $_POST[''];
    
    // $horario->setHoraInicio();
    // $horario->setHoraFinal();
    // $horario->setAforoMaximo();
    // $horario->setIdDiaHabil();
    // $horario->setAforoMaximo();
    // $horario->setVisible();
    // $horario->setActive();

    if($var1)
    {
        //Nuevo Horario

    }

    if($var1)
    {
        //Modificar Horario
    }

    if($var1)
    {
        //Desactivar Horario por ID?
    }