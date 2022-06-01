<?php
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

    <title>Recuperar Contraseña</title>

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
                <img class="mx-auto d-block" width="150px" src="../Assets/Images/logoCovao.png">
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto bg-white rounded border shadow-sm p-5">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center pb-3">Recuperar Contraseña</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="mb-3">
                                <label for="newPassword1" class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control" id="newPassword1" name="newPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword2" class="form-label">Repetir nueva contraseña</label>
                                <input type="password" class="form-control" id="newPassword2" name="newPassword2" required>
                            </div>
                            <button id="cambiarContrasena" type="button" class="btn btn-primary mt-3">Cambiar Contraseña</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button id="mostrarModal" type="button" class="btn btn-primary" style="display: none;" data-bs-toggle="modal" data-bs-target="#contraseñaCambiada"> </button>

    <!-- Modal -->
    <div class="modal fade" id="contraseñaCambiada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contraseña actualizada correctamente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <a href="./Login.php" class="btn btn-success">Ir al login</a>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container" id="contenedorNotificaciones"></div>

    <!--  Footer  -->
    <?php
    echo $footer;
    ?>

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <!-- END Scripts  -->
</body>

</html>