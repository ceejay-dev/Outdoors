<?php
session_start();
include_once (__DIR__.'/../model/Outdoor.php');
include_once (__DIR__ . '/../controllers/GestorController.php');
$controller = new GestorController();

$outdoors = $controller->recuperarOutdoorsDisp();
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

            <caption style="caption-side:top; color: black; font-size: 25px;">Lista de outdoors disponíveis</caption>
            <thead class="table table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo</th>
                    <th scope="col" colspan="3">Localização</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $i = 0;
                    foreach ($outdoors as $outdoor):
                        ?>
                        <th scope="row"><?php
                            $i += 1;
                            echo $i;
                            ?></th>
                        <td><?php echo $outdoor->getTipoOutdoor(); ?></td>
                        <td colspan="3"><?php echo $outdoor->getProvinciaO().", ". $outdoor->getMunicipioO().", ". $outdoor->getComunaO();?></td>
                        <td><?php echo $outdoor->getPreco(); ?></td>
                        <td><?php echo $outdoor->getEstado(); ?></td>
                </tr> 
                 <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: center" colspan="1">
                        <a href="../home.php"> <button type="button" class="btn btn-outline-danger" name="btn-voltar">Voltar</button> </a>
                    </td>
                </tr>                
            </tfoot>
        </table>
    </body>
</html>