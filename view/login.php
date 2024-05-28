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
            <form method="POST" class="login-form">
                <!--ícone do bonequinho aqui -->
                <div class='imagem'><img class='imagem' src="../content/img/user-icon.jpg" alt="alt"/></div>
                <h3 class="texto"> Outdoors Gest </h3>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"required>
                    <label for="floatingPassword">Password</label>
                </div>

                <input class= "botao" type="submit" value="Entrar" name="btn-entrar"/>

                <span class="linha">ou</span>

                <a href="../view/registerClient.php" class="botao-r"><span>Criar conta</span></a>
            </form>
        </div>
    </body>
</html>

<?php
if (isset($_POST['btn-entrar'])){
    include_once (__DIR__. '/../controllers/UserController.php');
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $controller = new UserController();
    $controller->verificarLogin($username, $password);
    
}
