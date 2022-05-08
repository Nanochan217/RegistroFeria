<?php
session_start();
if($_SESSION['Perfil'] != 1)
    header("Location: ../PantallasDestino/AccesoDenegado.php");
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
                                    <label for="maxAcompañantes" class="form-label">Maximo de acompañantes por persona</label>
                                    <input type="number" class="form-control" id="maxAcompañantes" name="maxAcompañantes" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gap-3 p-0">
                        <div class="col-lg border rounded shadow-sm bg-white p-5">
                            <h2 class="pb-4">Días hábiles</h2>
                            <div class="row g-3">
                                <div>
                                    <label for="dia1" class="form-label">Día 1</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="dia1" name="dia1" value="2022-05-04" min="2022-05-04" max="2022-05-22" required>
                                        <button class="btn btn-outline-primary" type="button" id="selectDia1">Seleccionar</button>
                                    </div>
                                </div>
                                <div>
                                    <label for="dia2" class="form-label">Día 2</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="dia2" name="dia2" value="2022-05-04" min="2022-05-04" max="2022-05-22" required>
                                        <button class="btn btn-outline-primary" type="button" id="selectDia2">Seleccionar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Button Agregar Acompañante -->
                            <div class="d-grid gap-2 mt-3" id="addDia">
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
                                                <button class="btn " type="button" id="horarioVisible1"><i style="font-size: 20px; color:#0D6EFD;" class="bi bi-eye"></i></button>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <button class="btn " type="button" id="horarioVisible1"><i style="font-size: 20px; color:red;" class="bi bi-trash3"></i></button>
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

    <!-- Modal -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cita #1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="h4 pb-2 ">Datos del solicitante</p>
                    <p class="mb-2">Cédula: <span class="fw-normal" id="cedula">303330333</span></p>
                    <p class="mb-2">Nombre: <span class="fw-normal" id="cedula">Bryan Monge Solano</span></p>
                    <p class="mb-2">Correo: <span class="fw-normal" id="cedula">thebryanmonge@gmail.com</span></p>
                    <p class="mb-2">Teléfono: <span class="fw-normal" id="cedula">8888-8888</span></p>
                    <p class="mb-2">Colegio Proveniencia: <span class="fw-normal" id="cedula">Colegio Vocacional de Artes y Oficios</span></p>
                    <hr class="my-4">
                    <p class="h4 pb-2">Datos de la cita</p>
                    <p class="mb-2">Día: <span class="fw-normal" id="cedula">Lunes 23</span></p>
                    <p class="mb-2">Hora: <span class="fw-normal" id="cedula">9:00am → 11:00am</span></p>
                    <hr class="my-4">
                    <p class="h4 pb-2">Acompañantes</p>
                    <p class="mb-2">1- <span class="fw-normal" id="cedula">202220222 Antonia García Mata</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </div>
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
    </Script>
    <!-- END Scripts  -->
</body>

</html>