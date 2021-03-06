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

    <title>Administrar Sistema </title>

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
    echo $headerSA;
    ?>

    <div class="container-sm py-5">
        <div class="row pb-5">
            <div class="col-4-md mx-auto">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-center">Administración del sistema</h1>
                </div>
            </div>
        </div>
        <div class="row g-4 mb-4">
            <div class="col">
                <div class="d-grid">
                    <a href="./EditarForm.php" class="btn btn-primary py-4">
                        <i class="bi bi-gear" style="font-size: 25px;"></i>
                        <h5 class="card-title">Formulario</h5>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="d-grid">
                    <a href="./Usuarios.php" class="btn btn-primary py-4">
                        <i class="bi bi-people" style="font-size: 25px;"></i>
                        <h5 class="card-title">Usuarios</h5>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="d-grid">
                    <a href="./Citas.php" class="btn btn-primary py-4">
                        <i class="bi bi-calendar-check" style="font-size: 25px;"></i>
                        <h5 class="card-title">Citas</h5>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="d-grid">
                    <a href="./Estadisticas.php" class="btn btn-primary py-4">
                        <i class="bi bi-bar-chart" style="font-size: 25px;"></i>
                        <h5 class="card-title">Estadisticas</h5>
                    </a>
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