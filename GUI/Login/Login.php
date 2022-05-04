<?php
session_start();
unset($_SESSION);

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

    <title>Iniciar Sesión</title>

    <!-- START CSS  -->
    <style>
        <?php
        echo $cssDefault;
        ?>
    </style>
    <!-- END CSS  -->
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row pb-4">
            <div class="col">
                <img class="mx-auto d-block" width="150px" src="../Assets/Images/LogoCovao.png">
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto bg-white rounded border shadow-sm p-5">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center pb-3">Iniciar Sesión</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="../../BL/LogIn/NuevaSesion.php" method="post">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div id="PassRecovery" class="form-text">
                                    <button type="button" class="link-primary bg-transparent" style="border: none" data-bs-toggle="modal" data-bs-target="#modalPassRecovery">
                                        ¿Olvidó su contraseña?
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Ingresar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- Modal Password Recovery -->
    <div class="modal fade" id="modalPassRecovery" tabindex="-1" aria-labelledby="modalPassRecovery" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="../../BL/LogIn/VerificarCorreo.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPassRecoveryLabel">Recuperar Contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="correoRecovery" class="form-label pb-3">Ingrese su correo electrónico y le enviaremos un enlace para restablecer su contraseña.</label>
                            <input type="email" class="form-control" id="correoRecovery" name="correoRecovery" placeholder="Ingrese su correo electrónico" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="Submit" class="btn btn-primary">Enviar Confirmación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <!-- END Scripts  -->
</body>

</html>