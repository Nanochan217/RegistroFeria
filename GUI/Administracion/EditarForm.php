<?php
session_start();
if ($_SESSION['Perfil'] != 1)
    header("Location: ../PantallasDestino/AccesoDenegado.php");

$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');

include '../../BL/Configuracion/BuscarTodasConfiguraciones.php';

?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPORT CSS -->
    <?php
    echo $cssLinks;
    ?>

    <title>Editar Formulario</title>

    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

    <!-- IMPORT Header -->
    <?php
    echo $headerSA;
    ?>

    <div class="container py-5">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center pb-4">
                    <h1>Configuración del Formulario</h1> <!-- titulo -->
                </div>
                <!-- END Encabezado de la pagina -->

                <form action="../../BL/Configuracion/ModificarConfiguracion.php" method="POST" class="row gap-3">

                    <div class="row gapx-4 border rounded bg-white shadow-sm p-5">
                        <div class="col-md-6">
                            <div class="d-flex ">
                                <h2 class="pb-4">Disponibilidad</h2>
                                <div class="form-check form-switch mt-2 ms-3 ">
                                    <input class="form-check-input" type="checkbox" role="switch" id="estadoConfiguracion" onclick="actualizarDisponibilidad('estadoConfiguracion')">
                                </div>
                            </div>
                            <div class="row g-3">
                                <input type="hidden" class="form-control" id="idConfiguracion" name="idConfiguracion" value="1"> <!-- idConfiguracion -->
                                <div class="col-md-5">
                                    <label for="fechaInicio" class="form-label">Fecha inicial</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" id="fechaInicio" value="2022-05-04" min="2022-05-04" max="2022-05-22">
                                        <button class="btn btn-outline-secondary" type="button" id="actualizarFechaInicial" onclick="actualizarDisponibilidad('fechaInicial')"><i class="bi bi-arrow-repeat"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label for="fechaFinal" class="form-label">Fecha final</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" id="fechaFinal" value="2022-05-04" min="2022-05-04" max="2022-05-22">
                                        <button class=" btn btn-outline-secondary" type="button" id="actualizarFechaFinal" onclick="actualizarDisponibilidad('fechaFinal')"><i class="bi bi-arrow-repeat"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="pb-4">Acompañantes</h2>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="acompanantesMaximo" class="form-label">Maximo de acompañantes por persona</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="acompanantesMaximo" min="0" oninput="formatearInputToNumero(this.id, this.value)">
                                        <button class="btn btn-outline-secondary" type="button" id="actualizarAcompanantesMaximo" onclick="actualizarAcompanantes()">
                                            <i class="bi bi-arrow-repeat" id="acompanantesIcono"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gap-3 p-0">
                        <!-- dias -->
                        <div class="col-lg border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Días hábiles</h2>
                            <div id="dias"></div>
                            <!-- Button Agregar dia -->
                            <div class="d-grid gap-2" id="addDia">
                                <button class="btn btn-outline-primary" type="button" id="btnAddDia" onclick="agregarDia()"><i class="bi bi-plus-circle align-middle lh-1 me-2" style="font-size: 18px;"></i>Agregar día</button>
                            </div>
                        </div>
                        <!-- horarios -->
                        <div class="col-lg border rounded shadow-sm bg-white p-5" id="contenedorHorarios">
                            <h2 class="pb-4">Horarios</h2>
                            <div class="d-flex flex-column justify-content-center" id="sinDatos" style="display:none !important;">
                                <img src="../Assets/Images/sinDatos.svg" style="height:200px;">
                                <h5 class="text-center mt-4 opacity-75 pb-3">No hay horarios asociados a este día.</h5>
                            </div>
                            <div class="d-flex flex-column justify-content-center" id="seleccionarDiaPrimero">
                                <img src="../Assets/Images/seleccionarDia.svg" style="height:200px;">
                                <h5 class="text-center mt-4 opacity-75">Seleccione un día para ver los horarios.</h5>
                            </div>
                            <div id="horarios">
                            </div>
                            <div class="d-grid gap-2" id="addHorario" style="display: none !important;">
                                <button class="btn btn-outline-primary" type="button" id="btnAddHorario" onclick="agregarHorario(idDia)"><i class="bi bi-plus-circle align-middle lh-1 me-2" style="font-size: 18px;"></i>Agregar horario</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="btnNotificacion" hidden></button>


    <div class="toast-container" id="contenedorNotificaciones"></div>




    <!-- IMPORT Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <Script>
        var configuracion = <?php echo BuscarConfiguraciones() ?>;
        var dias = <?php echo BuscarDiasHabiles() ?>;

        $(document).ready(function() {
            //rellena los inputs con los datos provenientes de la BD
            $("#fechaInicio").val(configuracion[0].fechaInicio);
            $("#fechaFinal").val(configuracion[0].fechaFinal);
            $("#acompanantesMaximo").val(configuracion[0].acompanateMax);
            (configuracion[0].estadoFormulario == '1') ? $("#estadoConfiguracion").prop("checked", true): $("#estadoConfiguracion").prop("checked", false);

            if (dias != null) {
                //agrega los datos provenientes de la BD a inputs hidden
                dias.forEach(dia => {
                    if (dia.active == 1) {
                        agregarDiaUsuario(dia)
                    }
                });
            }
        });

        //agrega un dia a la interfaz
        function agregarDia() {
            //se crea el dia
            let nuevoDia = {
                "dia": fechaHoy(),
                "idConfiguracion": "1",
                "visible": "1",
                "active": "1",
            }
            agregarDiaUsuario(nuevoDia); //se muestra en pantalla para el usuario
        }



        //agregar dia a la interfaz
        function agregarDiaUsuario(dia) {
            let contenedor = `<div class="row mx-0 p-3 gap-3 bg-light border rounded mb-3 justify-content-between" id="diaUsuario${dia.id}">
                                <div class="col-auto mt-0">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="dia${dia.id}" value="${dia.dia}" >
                                        <button class="btn btn-outline-secondary" type="button" id="actualizarAcompanantesMaximo" onclick="actualizarDia(${dia.id}, 'dia${dia.id}', 'actualizarDia')">
                                            <i class="bi bi-arrow-repeat" id="acompanantesIcono"></i>
                                        </button>
                                    </div>
                                </div>                                

                                <div class="col-auto mt-0">
                                    <div class="d-flex flex gap-1 px-0">
                                        <div class="d-flex flex-column">
                                            <label class="btn btn-outline-primary px-3 me-md-2 labelRadio" for="seleccionarDia${dia.id}"><i class="bi bi-circle"></i></label>
                                            <input class="btn-check" type="radio" id="seleccionarDia${dia.id}" name="diaSeleccionado" value="${(dia.id)}" onclick="mostrarHorarios(${dia.id}, this.id)" style="cursor: pointer;">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <button class="btn ${(dia.visible==1) ? "btn-light" : "btn-secondary"} border py-1 px-3 me-md-2" type="button" id="diaVisible${dia.id}" value="${dia.visible}" onclick="actualizarDia(${dia.id}, this.id, 'actualizarDiaVisible')">${(dia.visible==1) ? '<i id="diaVisible' + dia.id + 'Icono" style="font-size: 18px; " class="bi bi-eye"></i>' : '<i id="diaVisible' + dia.id + 'Icono" style="font-size: 18px; " class="bi bi-eye-slash"></i>'}</button>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-danger py-1 px-3" type="button" id="diaActive${dia.id}" value="${dia.active}" onclick="actualizarDia(${dia.id}, this.id, 'actualizarDiaActive')"><i style="font-size: 18px; " class="bi bi-trash3"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>`

            $('#dias').append(contenedor);
        }

        //agrega un horario a la interfaz
        function agregarHorario(idDiaHabil) {
            //se crea el horario
            let nuevoHorario = {
                "horaInicio": horaHoy(),
                "horaFinal": horaHoy(),
                "aforoMaximo": '300',
                "idDiaHabil": '', //en proceso!!!!!!!!!!!!!!!!!!!!
                "visible": "1",
                "active": "1",
            }
            agregarHorarioUsuario(nuevoHorario); //se muestra en pantalla para el usuario
        }


        //agregar horario a la interfaz
        function agregarHorarioUsuario(horario) {
            let contenedor = `<div class="row mb-3 mx-0 p-3 gx-3 gapx-4 bg-light border rounded" id="horarioUsuario${horario.id}">
                                
                                <div class="col-md-6 mt-0">
                                    <div class="row mx-0 mb-4">
                                        <label for="horaInicio${horario.id}" class="form-label ">Hora inicial</label>
                                        <div class="input-group">
                                            <input type="time" class="form-control" id="horaInicio${horario.id}" value="${horario.horaInicio}">
                                            <button class="btn btn-outline-secondary" type="button" id="actualizarAcompanantesMaximo" onclick="actualizarHorario(${horario.id}, 'horaInicio${horario.id}', 'actualizarHoraInicio')">
                                                <i class="bi bi-arrow-repeat" id="acompanantesIcono"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mx-0">
                                        <label for="horaFinal${horario.id}" class="form-label ">Hora final</label>
                                        <div class="input-group">
                                            <input type="time" class="form-control" id="horaFinal${horario.id}" value="${horario.horaFinal}" >
                                            <button class="btn btn-outline-secondary" type="button" id="actualizarAcompanantesMaximo" onclick="actualizarHorario(${horario.id}, 'horaFinal${horario.id}', 'actualizarHoraFinal')">
                                                <i class="bi bi-arrow-repeat" id="acompanantesIcono"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mt-0">
                                    <div class="row mx-0 mb-4">
                                        <label for="aforoMaximo${horario.id}" class="form-label ">Aforo máximo</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="aforoMaximo${horario.id}" value="${horario.aforoMaximo}" oninput="formatearInputToNumero(this.id, this.value)">
                                            <button class="btn btn-outline-secondary" type="button" id="actualizarAcompanantesMaximo" onclick="actualizarHorario(${horario.id}, 'aforoMaximo${horario.id}', 'actualizarAforoMaximo')">
                                                <i class="bi bi-arrow-repeat" id="acompanantesIcono"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mx-0">
                                        <div class="d-flex flex-column ">
                                            <label for="horaFinal1" class="form-label">Acciones</label>
 
                                            <div class="d-flex flex-wrap gap-3">
                                                <div class="d-flex flex-column">
                                                    <button class="btn ${(horario.visible==1) ? "btn-light" : "btn-secondary"} border py-1 px-3" type="button" id="horarioVisible${horario.id}" value="${horario.visible}" onclick="actualizarHorario(${horario.id}, this.id, 'actualizarHorarioVisible')">${(horario.visible==1) ? '<i id="iconoOcultarHorario' + horario.id + '" style="font-size: 18px; " class="bi bi-eye"></i>' : '<i id="iconoOcultarHorario' + horario.id + '" style="font-size: 18px; " class="bi bi-eye-slash"></i>'}</button>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <button class="btn btn-danger py-1 px-3" type="button" id="horarioActive${horario.id}" value="${horario.active}" onclick="actualizarHorario(${horario.id}, this.id, 'actualizarHorarioActive')"><i style="font-size: 18px; " class="bi bi-trash3"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>`

            $('#horarios').append(contenedor);
        }
    </Script>

    <script src="./editarForm.js"></script>
    <!-- END Scripts  -->
</body>

</html>