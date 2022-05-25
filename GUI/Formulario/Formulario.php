<?php
session_start();
$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$headerA = file_get_contents('../Default/HeaderA.html');
$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');

include '../../BL/Cita/BuscarTodosDatos.php';
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

    <title>Registrarse a la feria</title>
    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>@media (max-width: 768px) {
            #textoEliminar {
                display: inline !important;
                margin-top: 10px;
            }
        }
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light" onload="cargarDias(), cargarColegios()">

    <?php
    if ($_SESSION["Perfil"] == 1)
    {
        echo $headerSA;
    }
    else if ($_SESSION["Perfil"] == 2)
    {
        echo $headerA;
    }
    else
    {
        echo $header;
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Reservar Cita</h1>
                    <div class="alert alert-warning text-center small my-3 py-1 mx-auto" style="width: fit-content;" role="alert">
                        Fecha maxima de registro: <span class="fw-bold" id="fechaMaxima">Lunes 1 de Noviembre</span>
                    </div>
                </div>

                <!-- Formulario START-->
                <form action="../../BL/Cita/NuevaCita.php" method="POST" class="row gap-3">

                    <!-- START Sección de datos del solicitante -->
                    <div class="row border rounded bg-white shadow-sm p-5">
                        <h2 class="pb-4">Datos del solicitante</h2>

                        <!-- Imputs 1 -->
                        <div class="row">

                            <!-- Cedula -->
                            <div class="col-md-3 pb-3">
                                <label for="cedula" class="form-label">Cedula</label>
                                <input type="text" class="form-control " id="cedula" name="cedula" required>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-3 pb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control " id="nombre" name="nombre" required>
                            </div>

                            <!-- Apellido 1 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido1" class="form-label">Primer apellido</label>
                                <input type="text" class="form-control " id="apellido1" name="apellido1" required>
                            </div>

                            <!-- Apellido 2 -->
                            <div class="col-md-3 pb-3">
                                <label for="apellido2" class="form-label">Segundo apellido</label>
                                <input type="text" class="form-control " id="apellido2" name="apellido2" required>
                            </div>
                        </div>

                        <!-- Imputs 2 -->
                        <div class="row">

                            <!-- Correo -->
                            <div class="col-md-4 pb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="text" class="form-control " id="email" name="email" required>
                            </div>

                            <!-- Telefono -->
                            <div class="col-md-4 pb-3">
                                <label for="telefono" class="form-label">Telefono</label>
                                <input type="tel" class="form-control " id="telefono" name="telefono" min="0" required>
                            </div>

                            <!-- Colegio de procedencia -->
                            <div class="col-md-4 pb-3">
                                <label for="colegioProcedencia" class="form-label">Colegio de Procedencia</label>
                                <select id="colegioProcedencia" name="colegioProcedencia" class="form-select" required>
                                    <option value="none" selected disabled hidden>Seleccione un colegio</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END Sección de datos del solicitante -->

                    <div class="row gap-3 p-0">

                        <!-- START Sección de fecha de la cita -->
                        <div class="col-md border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Fecha de la cita</h2>

                            <!-- Inputs -->
                            <div class="row">

                                <!-- Día -->
                                <div class="col-md-6 pb-3">
                                    <label for="diaCita" class="form-label">Día</label>
                                    <select id="diaCita" name="diaCita" class="form-select" oninput="cargarHorarios(this.value)" required>
                                        <option value="none" selected disabled hidden>Seleccione un día</option>
                                    </select>
                                </div>

                                <!-- Hora -->
                                <div class="col-md-6 pb-3">
                                    <label for="horarioCita" class="form-label">Horario</label>
                                    <select id="horarioCita" name="horarioCita" class="form-select" required disabled>
                                        <option value="none" selected disabled hidden>Seleccione un dia primero</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- END Sección de fecha de la cita -->

                        <!-- START Sección de acompañantes -->                        
                        <div class="col-md border rounded shadow-sm bg-white p-5">
                            <input type="text" name="estadoAcompanantes" id="estadoAcompanantes" value="N" hidden> 
                            <div class="d-flex gap-3 pb-4 flex-wrap">
                                <h2>Acompañantes</h2>

                                <!-- Radio Buttons -->
                                <div class="d-flex gap-4 pt-2">

                                    <!-- Si -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acompanante" id="acompananteSI" required>
                                        <label class="form-check-label" for="acompananteSI">Sí</label>
                                    </div>

                                    <!-- No -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acompanante" id="acompananteNo" checked required>
                                        <label class="form-check-label" for="acompananteNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Inputs -->
                            <div id="listaAcompanante" style="display: none;">
                                <div class="col-md-6 pb-3" hidden="true">
                                    <label for="cantidadAcompanantes" class="form-label">Cantidad de Acompanantes</label>
                                    <input type="text" class="form-control" id="cantidadAcompanantes" name="cantidadAcompanantes" value="">
                                </div>
                                <!-- Aquí irán los acompanantes -->
                            </div>

                            <!-- Button Agregar Acompañante -->
                            <div class="d-grid gap-2" id="addAcompanante" style="display: none!important;">
                                <button class="btn btn-outline-primary" type="button" id="btnAddAcompanante">+ Agregar acompañante</button>
                            </div>
                            <div class="alert alert-secondary" id="AcompananteMsj" role="alert">
                                No asistirás con ningún acompañante
                            </div>
                        </div>
                        <!-- END Sección de acompañantes -->

                    </div>

                    <div class="row gap-3 p-0">
                        <div class="col position-relative px-0 py-5">
                            <div class="d-flex gap-3 position-absolute top-0 end-0">
                                <a href="../Index/Index.php" class="btn btn-danger">Descartar</a>
                                <!-- <a type="submit" href="../../BL/Cita/NuevaCita.php" class="btn btn-primary">Enviar Reserva</a> -->
                                <button type="submit" id="nuevaCita" class="btn btn-primary">Enviar Reserva</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- Formulario END -->

            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <script src="./Formulario.js"></script>
    <script>
        var dias = <?php echo BuscarDias() ?>;
        var horarios = <?php echo BuscarHorarios() ?>;
        var colegios = <?php echo BuscarTodosColegios() ?>;
        var fecha = [];
        let contador = 0;

        function cargarDias() {
            dias.forEach(dia => {
                if (dia.visible == 1 && dia.active == 1) {

                    let fecha = formatearDia(dia.dia);
                    $("#diaCita").append(`<option value="${dia.id}">${fecha[0]} ${fecha[1]} de ${fecha[2]}</option>`)
                }
            });
        }

        function cargarColegios() {
            colegios.forEach(colegio => {
                if (colegio.active == 1) {
                    $("#colegioProcedencia").append(`<option value="${colegio.id}">${colegio.nombre}</option>`)
                }
            });
        }

        function formatearDia(fecha) {
            let diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
            let mesAnio = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            let fechaNueva = new Date(fecha);

            return [diasSemana[fechaNueva.getDay()], fechaNueva.getDate() + 1, mesAnio[fechaNueva.getMonth()]]
        }

        function cargarHorarios(idDia) {
            let contadorHorarios = 0;
            $("#horarioCita").html("")
            $("#horarioCita").append(`<option value="none" selected disabled hidden>Seleccione un horario</option>`)
            horarios.forEach(horario => {
                if (horario.idDiaHabil == idDia) {
                    $("#horarioCita").append(`<option value="${horario.id}">${horario.horaInicio} - ${horario.horaFinal}</option>`)
                    $("#horarioCita").prop("disabled", false);
                    contadorHorarios++;
                }
            });
            if (contadorHorarios == 0) {
                $("#horarioCita").prop("disabled", true);
                $("#horarioCita").html("")
                $("#horarioCita").append(`<option value="none" selected disabled hidden>Sin horarios disponibles</option>`)
            }
        }
    </script>
    <!-- END Scripts  -->
</body>

</html>