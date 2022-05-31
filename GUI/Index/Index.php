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

    <title>Feria Vocacional 2022</title>

    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">

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

    <div class="container-sm py-5">
        <div class="row pb-5">
            <div class="col-4-md mx-auto">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-center">Feria Vocacional 2022</h1>
                    <p style="width: 70%;" class="text-center py-2 ">
                        La tradicional feria vocacional del Colegio Vocacional de Artes y Oficios volverá a abrirse al publico. Todos los estudiantes que estén interesados en
                        asistir deben reservar una cita.
                    </p>
                    <a href="../Formulario/Formulario.php" class="btn btn-lg btn-primary">Reservar una Cita</a>
                    <div class="text-center small alert alert-warning mt-4 py-1" role="alert">
                        Fecha maxima de registro: <span class="fw-bold" id="fechaMaxima">Lunes 1 de Noviembre</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto bg-white rounded border shadow-sm p-5">
                <div class="d-flex flex-column align-items-center">
                    <h4 class="text-center pb-3">¿Ya tiene una cita?</h4>
                    <div class="d-flex gap-4">
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="Editar Cita">Editar Cita</button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="Cancelar Cita">Cancelar Cita</button>
                    </div>
                    <span class="pt-3">Si no recuerdas los datos de su cita,
                        <button type="button" class="link-primary bg-transparent p-0" style="border: none" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="Consultar Cita">
                            haz click aquí
                        </button>
                    </span>
                </div>

            </div>
        </div>

    </div>
    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPassRecoveryLabel">Editar Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="correoRecovery" class="form-label pb-3">Ingrese su correo electrónico y le enviaremos un enlace con los pasos a realizar.
                            </label>
                            <input type="email" class="form-control" id="correoRecovery" name="correoRecovery" placeholder="Ingrese su correo electrónico" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <script src="Index.js"></script>
    <!-- END Scripts  -->
</body>

</html>