<?php
    include '../../Core/Conexion.php';    
    include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';    
    include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';    

    $diaHabilDAL = new DALDiaHabil();
    $diaHabil = new DiaHabil();
    $estadoDia = $_POST[''];
    
    // $diaHabil->setDia();
    // $diaHabil->setidConfiguracion(1);
    // $diaHabil->setVisible();
    // $diaHabil->setActive();

    if($var1)
    {
        //Nuevo Dia
        echo $diaHabilDAL->NuevoDiaHabil($i);
    }

    if($var1)
    {
        //Modificar Dia
        echo $diaHabilDAL->ModificarDiaHabil($i);
    }

    if($var1)
    {
        //Desactivar Dia por ID?
        echo $diaHabilDAL->DeshabilitarDiaHabil($i);
    }

        

        