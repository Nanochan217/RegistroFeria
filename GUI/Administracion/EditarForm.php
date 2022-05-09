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

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center pt-5 pb-4">
                    <h1>Editar Formulario</h1> <!-- titulo -->
                </div>
                <!-- END Encabezado de la pagina -->

                <form action="" method="POST" class="row gap-3">

                    <div class="row gapx-4 border rounded bg-white shadow-sm p-5">
                        <div class="col-md-6">
                            <h2 class="pb-4">Disponibilidad</h2>
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label for="fechaInicial" class="form-label">Fecha inicial</label>
                                    <input type="date" class="form-control" id="fechaInicial" name="fechaInicial" value="2022-05-04" min="2022-05-04" max="2022-05-22" required>
                                </div>

                                <div class="col-md-5">
                                    <label for="fechaFinal" class="form-label">Fecha final</label>
                                    <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" value="2022-05-04" min="2022-05-04" max="2022-05-22" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="pb-4">Acompañantes</h2>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="maxAcompanantes" class="form-label">Maximo de acompañantes por persona</label>
                                    <input type="number" class="form-control" id="maxAcompanantes" name="maxAcompanantes" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gap-3 p-0">
                        <div class="col-lg border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Días hábiles</h2>
                            <!-- START Dia 1 -->
                            <div id="dias">

                            </div>
                            <!-- Button Agregar Acompañante -->
                            <div class="d-grid gap-2" id="addDia">
                                <button class="btn btn-outline-primary" type="button" id="btnAddDia">+ Agregar día</button>
                            </div>
                        </div>
                        <div class="col-lg border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Horario del día 1</h2>
                            <div class="row p-3 gx-3 gapx-4 bg-light border rounded">
                                <div class="col-md-4 mt-0">
                                    <label for="horaInicial1" class="form-label">Hora inicial</label>
                                    <input type="time" class="form-control" id="horaInicial1" name="horaInicial1" required>
                                </div>

                                <div class="col-md-4 mt-0">
                                    <label for="horaFinal1" class="form-label">Hora final</label>
                                    <input type="time" class="form-control" id="horaFinal1" name="horaFinal1" required>
                                </div>
                                <div class="col-md-4 mt-0">
                                    <div class="d-flex flex-column">
                                        <label for="horaFinal1" class="form-label">Acciones</label>

                                        <div class="d-flex flex-wrap gap-3">

                                            <div class="d-flex flex-column">
                                                <button class="btn border-secondary rounded-pill" type="button" id="horarioVisible1"><i style="font-size: 20px; color:#69727A;" class="bi bi-eye"></i></button>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <button class="btn border-danger rounded-pill" type="button" id="horarioVisible1"><i style="font-size: 20px; color:#DC3545;" class="bi bi-trash3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button Agregar Acompañante -->
                            <div class="d-grid gap-2 mt-3" id="addHorario">
                                <button class="btn btn-outline-primary" type="button" id="btnAddHorario">+ Agregar horario</button>
                            </div>
                        </div>
                    </div>
                    <div class="row gap-3 p-0">
                        <div class="col position-relative px-0 py-5">
                            <div class="d-flex gap-3 position-absolute top-0 end-0">
                                <a href="./Index.php" class="btn btn-danger">Descartar</a>
                                <button type="submit" class="btn btn-primary">Enviar Reserva</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- IMPORT Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <Script>
        $("#navEditarFormulario").addClass("active");

        var configuracion = <?php echo BuscarConfiguraciones() ?>;
        var dias = <?php echo BuscarDiasHabiles() ?>;
        console.log(typeof(dias));
        console.log(dias);
        console.log(dias.length);
        var horarios = <?php echo BuscarHorarios() ?>;

        $(document).ready(function() {

            $("#fechaInicial").val(configuracion[0].fechaInicio);
            $("#fechaFinal").val(configuracion[0].fechaFinal);
            $("#maxAcompanantes").val(configuracion[0].acompanateMax);

            recargarDias();

            $("#btnAddDia").click(function() {
                let fecha = new Date();
                //let fechaHoy = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();



                dias[dias.length] = {
                    "id": UltimoID(),
                    "dia": fechaHoy(),
                    "idConfiguracion": "1",
                    "visible": "1",
                    "active": "1"
                }
                console.log(dias);

                function fechaHoy() {
                    function pad2(n) {
                        return (n < 10 ? '0' : '') + n;
                    }

                    var date = new Date();
                    var month = pad2(date.getMonth() + 1); //months (0-11)
                    var day = pad2(date.getDate()); //day (1-31)
                    var year = date.getFullYear();

                    var formattedDate = year + "-" + month + "-" + day;

                    return formattedDate;
                }

                function UltimoID() {
                    let ultimoID
                    UltimoID = (parseInt(dias[dias.length - 1].id) + 1).toString();
                    return UltimoID;
                }

                recargarDias();
            });
            // $(".eliminarDia").click(function() {
            //     dias[$(this).val()].active = "0";
            //     console.log(dias)
            //     recargarDias();
            // });

        });

        function eliminarDia(value) {
            dias[value].active = "0";
            console.log(dias)
            recargarDias();
        }

        function ocultarDia(value, id) {
            if (dias[value].visible == "0") {
                dias[value].visible = "1"
            } else {
                dias[value].visible = "0";
            }
            console.log(dias)
            recargarDias();
        }




        function recargarDias() {
            let contador = 0;
            $("#dias").html('')
            $.each(dias, function(i, dia) {
                if (dia.active == 1) {
                    contador++;
                    $("#dias").append(`<div class="row mx-0 p-3 gx-3 gapx-4 bg-light border rounded mb-3">
                                        <div class="col-md-8 mt-0">
                                            <label for="dia${contador}" class="form-label">Día ${contador}</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="dia${contador}" name="dia${contador}" value="${dia.dia}" min="2022-05-04" max="2022-05-22" required>
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="diaSeleccionado" id="diaSeleccionado${contador}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-0">
                                            <div class="d-flex flex-column">
                                                <label class="form-label">Acciones</label>
        
                                                <div class="d-flex flex-wrap gap-3">
        
                                                    <div class="d-flex flex-column">
                                                        <button class="btn ${(dia.visible==1) ? "btn-outline-secondary" : "btn-secondary"} rounded-pill" type="button" id="ocultarDia${contador}" value="${i}" onclick="ocultarDia(this.value, this.id)">${(dia.visible==1) ? '<i style="font-size: 20px; " class="bi bi-eye"></i>' : '<i style="font-size: 20px; " class="bi bi-eye-slash"></i>'}</button>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <button class="btn btn-outline-danger rounded-pill eliminarDia" type="button" id="eliminarDia${contador}" value="${i}" onclick="eliminarDia(this.value)"><i style="font-size: 20px; " class="bi bi-trash3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`)
                }
            });
        }
    </Script>
    <!-- END Scripts  -->
</body>

</html>