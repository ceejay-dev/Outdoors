<?php
session_start();
include_once (__DIR__ . '/../model/Client.php');
include_once (__DIR__ . '/../controllers/AdminController.php');
//$user = $_SESSION['user'];

$controller = new AdminController();
$clientes = $controller->recuperarClientes();
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
    <body>
        <table class="table table-hover table-striped w-50 m-auto h-25" style="text-align: center;">

            <caption style="caption-side:top; color: black; font-size: 25px;">Lista de clientes</caption>
            <thead class="table table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ativar/Desativar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $i = 0;
                    foreach ($clientes as $cliente):
                        ?>
                        <th scope="row"><?php
                            $i += 1;
                            echo $i;
                            ?></th>
                        <td><?php echo $cliente->getUsername(); ?></td>
                        <td><?php echo $cliente->getNome(); ?></td>
                        <td><?php echo $cliente->getEstadoC(); ?></td>
                        <?php if ($cliente->getEstadoC() === "inativo") { ?>
                            <td> <button type="button" class="btn btn-success" name="btn-ativar" onclick="location.href = 'ativarContas.php?user=<?php echo $cliente->getUsername(); ?>'">Ativar</button> </td>
                            <?php
                        } else if ($cliente->getEstadoC() === "ativo") {
                            ?>
                            <td> <button type="button" class="btn btn-danger" name="btn-desativar" onclick="location.href = 'ativarContas.php?user=<?php echo $cliente->getUsername(); ?>'">Desativar</button> </td>
                            <?php
                        }
                        ?>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: center" colspan="1">
                        <a href="homeAdmin.php"> <button type="button" class="btn btn-outline-danger" name="btn-voltar">Voltar</button> </a>
                    </td>
                </tr>                
            </tfoot>
        </table>
    </body>
</html>

<?php
$controller->requestsHandler();
