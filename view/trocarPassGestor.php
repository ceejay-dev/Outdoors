<?php
session_start();
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
            <form method="POST" class="update-form">


                <h3 class="texto"> Alterar palavra-passe</h3>

                <div class="caixa1">
                    <label for="floatingPassword">Passe nova</label>
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Insira nova passe" name="pass1"required>
                </div>

                <div class="caixa1">
                    <label for="floatingPassword">Confirmar passe nova</label>
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Insira novamente nova passe" name="pass2"required>
                </div>

                <div class="botao-a">
                    <button class="btn btn btn-outline-dark btn-custom alt"name="btn-alterar">Alterar</button>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
if (isset($_POST['btn-alterar'])) {
    include_once (__DIR__ . '/../controllers/AdminController.php');
    include_once (__DIR__ . '/../controllers/GestorController.php');

    $password = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $username = $_SESSION['user'];
   
    if ($password === $pass2) {
        $gestorController = new GestorController();
        $adminController = new AdminController();
        $id = $adminController->recuperarIdGestorbyUsername($username);
        
        $gestorController->trocarPass($password, $id);
    } else {
        ?>
        <script src="../scripts/custom/meujs.js"></script>
        <script> alertaPassword(); </script>
        <?php
    }
}
