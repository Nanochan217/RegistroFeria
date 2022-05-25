<?php
    include '../../Core/Conexion.php';
    include '../../DAL/ConfiguracionDAL/DALConfiguracion.php';
    include '../../DAL/ConfiguracionDAL/DALDiaHabil.php';
    include '../../DAL/ConfiguracionDAL/DALHorario.php';
    include '../../Entidades/ConfiguracionEntidades/Configuracion.php';
    include '../../Entidades/ConfiguracionEntidades/DiaHabil.php';
    include '../../Entidades/ConfiguracionEntidades/Horario.php';
    
    //Funciones del DAL para cada uno de los elementos presentes
    $configuracionDAL = new DALConfiguracion();
    $diaHabilDAL = new DALDiaHabil();
    $horarioDAL = new DALHorario();

    //Objetos de las entidades de cada uno de los elementos presentes
    $configuracion = new Configuracion();
    $diaHabil = new DiaHabil();
    $horarios = new Horario();

    //$idConfiguracion = $_POST['idConfiguracion'];
    $fechaInicio = $_POST['fechaInicial'];
    $fechaFinal = $_POST['fechaFinal'];
    $maxAcompanantes = $_POST['maxAcompanantes'];
    $datosConfiguracion = $_POST['fechas'];//Array de Objetos

    $configuracion->setFechaInicio($fechaInicio);
    $configuracion->setFechaFinal($fechaFinal);
    $configuracion->setAcompanantesMax($maxAcompanantes);

    // if($configuracionDAL->ModificarConfiguracion($configuracion))//T
    // {
        foreach($datosConfiguracion as $datos)
        {
            foreach($datos as $propiedad => $contenido)
            {
                if($propiedad == 'diaHabil')
                {
                    foreach($contenido as $valor)
                    {
                        // $count = 0;
                        // while($count <= 4)
                        // {
                        //     echo $valor[$count];
                        //     //$horarios->setHoraInicio($valor[$count]);
                        //     // $count++;
                        //     echo $valor[$count];
                        //     //$horarios->setHoraFinal($valor[$count]);
                        //     // $count++;
                        //     echo $valor[$count];
                        //     //$horarios->setAforoMaximo($valor[$count]);
                        //     // $count++;
                        //     echo $valor[$count];
                        //     //$horarios->setIdDiaHabil($valor[$count]);
                        //     // $count++;
                        //     echo $valor[$count];
                        //     //$estadoHorario = $valor[$count];
                        //     $count++;
                        // }
                        // $var2 = $valor[0];
                        // echo $var2;
                        // $diaHabil->setDia($valor['dia']);
                        // $estadoDia = $valor['existe'];
                        
                        // if($estadoDia == 1)
                        // {
                        //     $diaHabilDAL->NuevoDiaHabil($diaHabil);
                        // }
                        // else
                        // {
                        //     $diaHabilDAL->ModificarDiaHabil($diaHabil);
                        // }
                        // print_r($valor);
                        // echo "<br>";
                    }
                }
                if($propiedad == 'horario')
                {
                    foreach($contenido as $horario)
                    {
                        foreach($horario as $valor)
                        {
                            $count = 0;
                            while($count <= 4)
                            {
                                echo $valor[$count];
                                //$horarios->setHoraInicio($valor[$count]);
                                //$count++;
                                echo $valor[$count];
                                //$horarios->setHoraFinal($valor[$count]);
                                //$count++;
                                echo $valor[$count];
                                //$horarios->setAforoMaximo($valor[$count]);
                                //$count++;
                                echo $valor[$count];
                                //$horarios->setIdDiaHabil($valor[$count]);
                                //$count++;
                                echo $valor[$count];
                                //$estadoHorario = $valor[$count];
                                $count++;
                            }
                            // $var1 = $valor[0];
                            // echo $var1;                        

                        //    if($estadoHorario == 1)
                        //     {
                        //         $horarioDAL->NuevoHorario($horarios);
                        //     }
                        //     else
                        //     {
                        //         $horarioDAL->ModificarHorario($horarios);
                        //     }
                            // print_r($valor);
                            // echo "<br>";
                        }
                    }
                }
            }
        }
    //}

    //NOMBRES DE LAS PROPIEDADES DE LOS OBJETOS DESDE EL FRONT
    //DIA
    // id;
    // dia;
    // idConfiguracion;
    // visible;
    // active;
    // existe;

    //HORARIO
    // id;
    // horaInicio;
    // horaFinal;
    // aforoMaximo;
    // idDiaHabil;
    // visible;
    // active;
    // existe;    

/////////////////////////////////////////////////////////////////////////////////////    
    // echo $dia['id'];
    // echo $dia['dia'];
    // echo $dia['idConfiguracion'];
    // echo $dia['visible'];
    // echo $dia['active'];
    // echo $dia['existe'];        

    //Extraer los datos de un array por medio de un FOR 
    //o bien por medio de un FOREACH
    //FIJARSE BIEN EN LOS NOMBRES DE LAS COLUMNAS DEL ARRAY QUE VIENE DESDE
    //EL FRONT!!!        

    // if($a->active = 1)
    // {
    //     //Añade un nuevo dia a la Configuracion
    // }
    // //o bien else directo...
    // if($a->active = 0)
    // {
    //     //No añade sino sobreescribe dia a la Configuracion
    // }

    // if($VALIDACION1)
    // {
        
    // }

    // if($VALIDACION2)
    // {

    // }

    // foreach($horariosConfiguracion as $horario)
    // {
    //     echo $dia['id'];
    //     echo $dia['horaInicio'];
    //     echo $dia['horaFinal'];
    //     echo $dia['aforoMaximo'];
    //     echo $dia['idDiaHabil'];
    //     echo $dia['visible'];
    //     echo $dia['active'];
    //     echo $dia['existe'];
    // }


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
    



    //SQL DE CONFIGURACION PARA PRUEBAS
    // INSERT INTO configuracion (nombre, descripcion, fechaInicio, fechaFinal, acompanantesMaximo, estadoConfiguracion, active)
    // VALUES ("a", "a", "2022-05-05", "2022-05-10", 3, 1, 1);

    // INSERT INTO horario (horaInicio, horaFinal, aforoMaximo, idDiaHabil, visible, active)
    // VALUES ("7:00:00","9:00:00",200,1,1,1);