<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPORT CSS -->
    <?php
    include '../Default/CSSImports.html';
    ?>

    <title>Registrarse a la feria</title>
    <!-- START CSS  -->
    <style>
        <?php
        include '../Default/Style.css';
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
    include '../Default/Header.html';
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
                <form action="../PantallasDestino/AcciónExitosa.php" method="POST" class="row gap-3">

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
                                <input type="Number" class="form-control " id="telefono" name="telefono" min="0" required>
                            </div>

                            <!-- Colegio de procedencia -->
                            <div class="col-md-4 pb-3">
                                <label for="colegioProcedencia" class="form-label">Colegio de Procedencia</label>
                                <select id="colegioProcedencia" name="colegioProcedencia" class="form-select" required>
                                    <option selected>Seleccione un colegio</option>
                                    <option>...</option>
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
                                    <label for="dia" class="form-label">Día</label>
                                    <select id="dia" name="dia" class="form-select" required>
                                        <option selected>Seleccione un día</option>
                                        <option>...</option>
                                    </select>
                                </div>

                                <!-- Hora -->
                                <div class="col-md-6 pb-3">
                                    <label for="horario" class="form-label">Horario</label>
                                    <select id="horario" name="horario" class="form-select" required>
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
                                <!-- Aquí irán los estudiantes -->
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
                                <button type="submit" class="btn btn-primary">Enviar Reserva</button>
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
    include '../Default/Footer.html';
    ?>

    <!-- START Scripts  -->
    <?php
    include '../Default/JSImports.html';
    ?>
    <script src="Formulario.js"></script>
    <!-- END Scripts  -->
</body>

</html>