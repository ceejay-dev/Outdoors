<?php
$id = $_SESSION['idCliente'];
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Outdoors Gest </title>
        <link href="../content/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../content/css/meuestilo.css">
        <link rel="stylesheet" href="content/bootstrap/navbars.css">
        <link rel="icon" href="../content/img/logo.png">
        <script src="../scripts/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../scripts/custom/meujs.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary navegaco" aria-label="Ninth navbar example">
                <div class="container-xl">
                    <a class="navbar-brand" href="#"><img class="brand-img" src="../content/img/logo.png" alt="alt"/></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarsExample07XL">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="homeLogged.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="listaOutdoorsC.php?id=<?php echo $id?>">Solicitar outdoor</a>
                            </li>

                            <li class="nav-item">
                                <!--INICIAR SESSÃO COM O NOME PARA COLOCAR NESTE LINK UM GET NOME-->
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <button class="btn dropdown-toggle link-primary show" data-bs-toggle="dropdown" aria-expanded="true">
                                                <?php echo $username; ?>
                                            </button>
                                            <ul class="dropdown-menu " data-bs-popper="static">
                                                <li><a class="dropdown-item nav-link active" href="editaCliente.php?id=<?php echo $id; ?>">Editar dados</a></li>
                                                <li><a class="dropdown-item nav-link active" href="minhasSolicitacoesC.php">Meu carrinho</a></li>
                                                <li><a class="dropdown-item nav-link active" href="#">Meus outdoors</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                        <div class="align-self-end">
                            <button class="btn btn btn-outline-dark btn-custom"><a class="nav-link" href="homeLogged.php?op=end">Logout</a></button>
                        </div>
                    </div>
                </div>
            </nav>
        </header>



