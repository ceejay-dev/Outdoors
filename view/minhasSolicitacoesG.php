<?php

include_once (__DIR__ . '/../model/Aluguer.php');
include_once (__DIR__ . '/../controllers/GestorController.php');
session_start();

$id = $_SESSION['idGestor'];

$controller = new GestorController();
$pedidos = $controller->recuperarMeusPedidos($id);
var_dump($controller->recuperarMeusPedidos($id));
$filtroOut = filter_input(INPUT_GET, 'ot');
$ot = isset($filtroOt) ? $filtroOt : NULL;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href='../content/img/logo.png'>
        <link rel="stylesheet" href="../content/bootstrap/css/bootstrap.min.css">
        <title>Outdoors Gest</title>
    </head>
    <body class="gestor-body">
        <table class="table table-hover table-striped w-50 m-auto h-25" style="text-align: center;">

            <caption style="caption-side:top; color: black; font-size: 25px;">Meus pedidos</caption>
            <thead class="table table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data de Início do aluguer</th>
                    <th scope="col">Data de Fim do aluguer</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Tipo de Outdoor</th>
                    <th scope="col" colspan="3">Localização</th>
                    <th scope="col">Finalizar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $i = 0;
                    foreach ($pedidos as $aluguer):
                        ?>
                        <th scope="row"><?php
                            $i += 1;
                            echo $i;
                            ?></th>
                        <td><?php echo $aluguer->getDataI(); ?></td>
                        <td><?php echo $aluguer->getDataF(); ?></td>
                        <td><?php echo $aluguer->getPagamento(); ?></td>
                        <td><?php echo $aluguer->getTipoDeOutdoor(); ?></td>
                        <td colspan="3"><?php echo $aluguer->getProvincia() . ", " . $aluguer->getMunicipio() . ", " . $aluguer->getComuna(); ?></td>
                        <td><button type="button" class="btn btn-info mx-2" name="btn-aceitar" id="btn-finalizar" >Aceitar</button></td>
                        <td><button type="button" class="btn btn-info mx-2" name="btn-recusar" id="btn-finalizar" href = "homeGestor.php">Recusar</button></td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: center" colspan="1">
                        <a href="homeGestor.php"> <button type="button" class="btn btn-outline-danger mx-2" name="btn-voltar" id="btn-voltar">Voltar</button> </a>
                    </td>
                </tr>                
            </tfoot>
        </table>
    </body>
</html>