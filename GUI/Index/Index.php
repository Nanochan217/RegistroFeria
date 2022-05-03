<?php
//Librerias Necesarias
?>


<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Feria Vocacional 2022</title>
    <style>
        @media (max-width: 600px) {
            .feria {
                display: none;
            }
        }
        body {
            /* background-image: url(../Assets/Images/bg.svg); */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1007%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(248%2c 249%2c 250%2c 1)'%3e%3c/rect%3e%3cpath d='M700 126.93C691.38 126.93 682.18 131.06 682.18 140C682.18 158.01 691.73 180.83 700 180.83C708.07 180.83 714.85 158.52 714.85 140C714.85 131.57 707.72 126.93 700 126.93' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M980 392.78C966.32 392.78 957.47 403.59 957.47 420C957.47 471.64 963.25 528.89 980 528.89C997.85 528.89 1026.67 466.74 1026.67 420C1026.67 398.68 1000.92 392.78 980 392.78' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M108.39 0C108.39 18.58 35.31 68.57 0 68.57C-18.88 68.57 -21 13.29 0 0C33.2 -21 108.39 -15.7 108.39 0' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M496.86 140C496.86 100.09 530.34 104.88 560 66.82C584.88 34.88 573.53 15.47 605.94 0C643.53 -17.94 652.97 0 700 0C770 0 770 0 840 0C910 0 910 0 980 0C1050 0 1050 0 1120 0C1130.77 0 1141.54 -4.59 1141.54 0C1141.54 6.61 1128.31 9.35 1120 22.4C1083.74 79.35 1052.41 82.19 1052.41 140C1052.41 192.57 1082.13 195.16 1120 243.16C1137.35 265.16 1158.56 254.65 1162.86 280C1173.56 343.07 1165.93 353.78 1150 420C1144.5 442.87 1131.03 458.18 1120 458.18C1111.03 458.18 1124.54 431.84 1110 420C1054.54 374.84 1038.27 344.17 980 344.17C941.89 344.17 951.48 384.86 917.24 420C881.48 456.71 881.49 487.88 840 487.88C787.79 487.88 755.78 469.92 729.84 420C701.78 365.98 722.64 348.89 732 280C741.66 208.89 777.72 201.43 767.88 140C761.72 101.57 735.27 80.27 700 80.27C660.6 80.27 649.28 101.64 618.55 140C579.28 189.01 590.17 255 560 255C529.33 255 496.86 194.18 496.86 140' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M1400 81.67C1366.78 71.48 1366.21 29.54 1366.21 0C1366.21 -11.29 1383.11 0 1400 0C1470 0 1489.31 -19.31 1540 0C1559.31 7.36 1559.03 42.23 1540 53.33C1489.03 83.06 1453.68 98.14 1400 81.67' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M171.61 280C219.6 247.79 223.09 238.39 280 230.59C347.29 221.37 351.68 231.27 420 245.95C466.68 255.98 466.68 259.62 510 280C536.68 292.55 540.19 290.37 560 311.82C604.85 360.37 639.33 372.27 639.33 420C639.33 454.69 600.49 449.55 560 476.67C496.01 519.55 495.96 520.96 430.37 560C425.96 562.63 425.18 560 420 560C415.76 560 415.3 561.86 411.52 560C345.3 527.42 343.38 491.11 280 491.11C229.4 491.11 234.75 534.81 183.56 560C164.75 569.26 161.78 560 140 560C70 560 35 595 0 560C-35 525 0 490 0 420C0 376.76 -26.69 351.73 0 333.53C43.31 304 78.24 343.81 140 324.55C164.05 317.05 149.6 294.77 171.61 280' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M1357.14 280C1374.73 236.38 1363.45 216.99 1400 196C1454.88 164.49 1499.81 150.89 1540 175C1569.81 192.89 1540 227.5 1540 280C1540 350 1540 350 1540 420C1540 490 1562.98 512.98 1540 560C1528.76 582.98 1496.85 577.63 1471.56 560C1426.85 528.84 1444.36 500.78 1400 462.42C1363.42 430.78 1318.32 456.76 1309.68 420C1296.89 365.55 1329.57 348.38 1357.14 280' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M657.22 560C657.22 539.36 682.13 495.83 700 495.83C715.94 495.83 724.84 536.43 724.84 560C724.84 568.51 712.42 560 700 560C678.61 560 657.22 571.45 657.22 560' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M700 33.6C680.51 16.58 660.63 9.54 660.63 0C660.63 -7.26 680.32 0 700 0C770 0 770 0 840 0C910 0 910 0 980 0C983.89 0 986.94 -3.63 987.78 0C1003.03 66.37 998.62 70.26 1012.18 140C1025.84 210.26 1053.33 226.28 1042.22 280C1037.24 304.06 1003.48 275.67 980 295.56C920.87 345.67 930.65 359.86 877.01 420C860.65 438.35 859.88 452.53 840 452.53C814.98 452.53 788.4 445.59 787.21 420C784.4 359.33 823.38 351.6 832 280C840.23 211.6 851.65 197.39 820.91 140C785.65 74.19 760.65 86.58 700 33.6' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M1458.33 280C1480.45 245.83 1511.22 242.31 1540 242.31C1552.06 242.31 1540 261.15 1540 280C1540 350 1540 350 1540 420C1540 490 1552.2 502.2 1540 560C1537.42 572.2 1519.22 570.69 1510.44 560C1461.72 500.69 1438.88 494.57 1425 420C1412.82 354.57 1422.95 334.67 1458.33 280' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M0 385C32.19 385 88.15 393.39 88.15 420C88.15 454.97 25.82 508.15 0 508.15C-18.26 508.15 0 464.08 0 420C0 402.5 -11.88 385 0 385' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3cpath d='M222.35 420C222.35 372.1 253.97 297.5 280 297.5C305.07 297.5 324.55 369.32 324.55 420C324.55 438.35 302.56 435.56 280 435.56C251.46 435.56 222.35 441.13 222.35 420' stroke='rgba(237%2c 237%2c 237%2c 0.51)' stroke-width='2'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1007'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    include '../Default/Header.html';
    ?>

    <div class="container-sm py-5">
        <div class="row bg-white rounded border shadow-sm p-5">
            <div class="col-4-md mx-auto">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-center">Feria vocacional 2022</h1>
                    <div class="text-center small alert alert-warning mt-2 mb-3 py-1" role="alert">
                        Fecha maxima de registro: <span class="fw-bold" id="fechaMaxima">Lunes 1 de Noviembre</span>
                    </div>
                    <p style="text-align: center" class="pb-2 ">
                        La tradicional feria vocacional del Colegio Vocacional de Artes y Oficios volverá a abrirse al publico. Todos los estudiantes que estén interesados en
                        asistir deben reservar una cita.
                    </p>
                    <a href="../Formulario/Formulario.php" class="btn btn-lg btn-primary">Reservar una Cita</a>
                </div>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-4-md mx-auto">
                <div class="d-flex flex-column align-items-center">
                    <h4 class="text-center pb-3 pt-5">¿Ya tiene una cita?</h4>
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
    include '../Default/Footer.html';
    ?>



    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPassRecoveryLabel">Editar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="correoRecovery" class="form-label pb-3">Ingrese su correo electrónico y le enviaremos un enlace con los pasos a realizar.
                        </label>
                        <input type="email" class="form-control" id="correoRecovery" name="correoRecovery" placeholder="Ingrese su correo electrónico">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="Index.js"></script>
</body>

</html>