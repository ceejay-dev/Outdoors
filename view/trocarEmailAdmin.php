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

                <h3 class="texto"> Alterar email</h3>

                <div class="caixa1">
                    <label for="floatingPassword">Email novo</label>
                    <input type="emailword" class="form-control" id="floatingPassword" placeholder="Insira novo email" name="email1"required>
                </div>

                <div class="caixa1">
                    <label for="floatingPassword">Confirmar email novo</label>
                    <input type="emailword" class="form-control" id="floatingPassword" placeholder="Insira novamente novo email" name="email2"required>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button class="btn btn btn-outline-dark btn-custom alt"name="btn-alterar">Alterar</button>
                    </div>

                    <div class="col-3">
                        <a class="btn btn-outline-danger" href="homeAdmin.php">Voltar</a>
                    </div> 
                </div>
            </form>
        </div>
    </body>
</html>

<?php
if (isset($_POST['btn-alterar'])) {
    include_once (__DIR__ . '/../controllers/UserController.php');
    include_once (__DIR__ . '/../controllers/GestorController.php');

    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $username = $_SESSION['user'];
    if ($email1 === $email2) {
        $adminController = new AdminController();
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email1);
        $adminController->trocarEmailAdmin($user);
    } else {
        ?>
        <script src="../scripts/custom/meujs.js"></script>
        <<script> alertaEmail();</script>
        <?php
    }
}
