<?php
session_start();

$id = $_SESSION['idOutdoor'];


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Outdoors Gest </title>
        <link rel="icon" href="../content/img/logo.png">
        <link rel="stylesheet" href="../content/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../content/css/meuestilo.css">
    </head>
    <body class="corpo wallpaper">
        <div>
            <form method="POST" class="update-form" enctype="multipart/form-data">


                <h3 class="texto"> Finalização da solicitação outdoor </h3>

                <div class="caixa1">
                    <label for="floatingPassword">Carregue comprovativo aqui</label>
                    <input type="file" class="form-control" id="comprovativo" placeholder="" name="comprovativo"required>
                </div>

                <div class="botao-a">
                    <button class="btn btn btn-outline-dark btn-custom alt"name="btn-carregar" onclick="minhasSolicitacoesC.php?ot=<?php echo $id; ?>">Carregar</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
if (isset($_POST['btn-carregar'])) {
    include_once (__DIR__ . '/../controllers/AdminController.php');

    $comprovativo = filter_input(INPUT_POST, 'comprovativo');
    $file = $_FILES['comprovativo'];

    $fileName = $file['name'];
    $temporaryName = $file['tmp_name'];
    $path = $_SERVER['DOCUMENT_ROOT'] . '/OutdoorsGest/comprovativo/';

    /*echo "<pre>";
    print_r($_FILES);
    echo "</pre>";*/

    move_uploaded_file($temporaryName, $path . $fileName);
    $controller = new AdminController();
    $controller->submeterComprovativo($id);
}
