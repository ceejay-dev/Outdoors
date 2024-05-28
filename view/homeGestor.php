<?php
include_once (__DIR__ . '/../controllers/GestorController.php');
session_start();
$gestor = new GestorController();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Outdoors Gest </title>
        <link href="../content/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../content/css/meuestilo.css">
        <link rel="stylesheet" href="../content/bootstrap/navbars.css">
        <link rel="icon" href="../content/img/logo.png">
        <script src="../scripts/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../scripts/custom/meujs.js"></script>
    </head>
    <body class="wallpaper">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary navegaco" aria-label="Ninth navbar example">
                <div class="container-xxl">
                    <a class="navbar-brand" href="#"><img class="brand-img" src="../content/img/logo.png" alt="alt"/></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarsExample07XL">
                        <ul class="navbar-nav me-auto mb-4 mb-lg-0">
                            <li class="nav-item"><a class=" nav-link active" href="./registarOutdoor.php">Adicionar Outdoor</a></li>
                            <li class="nav-item"><a class="nav-link active" href="editarOutdoor.php">Editar Outdoor</a></li>
                            <li class="nav-item"><a class=" nav-link active" href="apagarOutdoors.php">Apagar Outdoor</a></li>
                            <li class="nav-item"><a class="nav-link active" href="minhasSolicitacoesG.php">Solicitações</a></li>
                        </ul>

                        <div class="align-self-end">
                            <button class="btn btn btn-outline-dark btn-custom"><a class="nav-link" href="homeGestor.php?op=end">Logout</a></button>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div style="margin-top: 50%;">
            <footer class="py-2 mt-2 rodape" style="background-color: black;">
                <div class="container text-white text-center">
                    <p class="display-5 mb-3" style="font-size:25px; ">@ceejay-dev | XPTO SOLUCTIONS</p>
                    <small class="text-white-50">&copy; All righs reserved to Cândido Ucuahamba from XPTO SOLUCTIONS</small>
                </div>
            </footer>
        </div>
    </body>
</html>

<?php
$gestor->requestsHandler();