<?php
session_start();
$header = file_get_contents('../Default/Header.html');
$headerSA = file_get_contents('../Default/HeaderSA.html');
$headerA = file_get_contents('../Default/HeaderA.html');
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

    <title>{Acción} Falló</title>

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
    if ($_SESSION["Perfil"]==1) {
        echo $headerSA;    
    }
    else if($_SESSION["Perfil"] == 2){
        echo $headerA;  
    }
    else{
        echo $header;  
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- START Encabezado de la pagina -->
                <div class="d-flex gap-4 flex-column align-items-center justify-content-center py-5">
                    <h1>{Acción} falló</h1> <!-- titulo -->
                    <img src="../Assets/Images/Error.svg" style="height: 180px;" alt=""> <!-- ilustración -->
                    <a href="../Index/Index.php" class="btn btn-danger">Volver al inicio</a> <!-- botón nueva reserva -->
                </div>
                <!-- END Encabezado de la pagina -->


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
    <!-- END Scripts  -->
</body>

</html>