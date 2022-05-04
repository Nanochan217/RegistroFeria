<?php
$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');$footer = file_get_contents('../Default/Footer.html');
$cssLinks = file_get_contents('../Default/CSSImports.html');
$jsLinks = file_get_contents('../Default/JSImports.html');
$cssDefault = file_get_contents('../Default/Style.css');
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

    <title>Modificar Cita</title>

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

<body class="bg-light">

    <?php
    echo $header;
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Titulo de la pagina -->
                <div class="pt-5 pb-4">
                    <h1 class="text-center">Modificar Cita</h1>

                </div>
                <!-- Formulario START-->
                <form action="../PantallasDestino/AcciónExitosa.php" method="POST" class="row gap-3">

                    <!-- START Sección de datos del solicitante -->
                    <div class="row border rounded bg-white shadow-sm p-5">
                        <h2 class="pb-4">Datos del solicitante</h2>

                        <span class="fw-bold mb-2">Nombre del solicitante: <span class="fw-normal" id="nombreSolicitante">Bryan Monge Solano</span> </span>
                        <span class="fw-bold">Cedula del solicitante: <span class="fw-normal" id="cedulaSolicitante">303330333</span> </span>

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
                                    <label for="dia" class="form-label">Día</label>
                                    <select id="dia" name="dia" class="form-select">
                                        <option selected>Seleccione un día</option>
                                        <option>...</option>
                                    </select>
                                </div>

                                <!-- Hora -->
                                <div class="col-md-6 pb-3">
                                    <label for="horario" class="form-label">Horario</label>
                                    <select id="horario" name="horario" class="form-select">
                                        <option selected>Seleccione una horario</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- END Sección de fecha de la cita -->

                        <!-- START Sección de acompañantes -->
                        <div class="col-md border rounded shadow-sm bg-white p-5">
                            <div class="d-flex gap-3 pb-4 flex-wrap">
                                <h2>Acompañantes</h2>

                                <!-- Radio Buttons -->
                                <div class="d-flex gap-4 pt-2">

                                    <!-- Si -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acompanante" id="acompananteSI">
                                        <label class="form-check-label" for="acompananteSI">Sí</label>
                                    </div>

                                    <!-- No -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acompanante" id="acompananteNo" checked>
                                        <label class="form-check-label" for="acompananteNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Inputs -->
                            <div id="listaAcompanante" style="display: none;">

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
                                <button type="submit" class="btn btn-primary">Modificar</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="Formulario.js"></script>
    <!-- END Scripts  -->
</body>

</html>