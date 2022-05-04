<?php
$header = file_get_contents('../Default/Header.html');
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
                        <form action="../../BL/LogIn/NuevaContrasena.php" method="post">
                            <div class="mb-3">
                                <label for="newPassword1" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="newPassword1" name="newPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword2" class="form-label">Repetir Contraseña</label>
                                <input type="password" class="form-control" id="newPassword2" name="newPassword2" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Cambiar Contraseña</button>
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

    <!-- START Scripts  -->
    <?php
    echo $jsLinks;;
    ?>
    <!-- END Scripts  -->
</body>

</html>