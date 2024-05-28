<?php
include_once (__DIR__ . '/../model/Gestor.php');
include_once (__DIR__ . '/../controllers/AdminController.php');
include_once (__DIR__ . '/../controllers/ProvinciaController.php');
$adminController = new AdminController();

$provinciaController = new ProvinciaController();
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
    <body class="corpo gestor-body">
        <div>
            <form class="gestor-form row g-3" method="POST">
                <input type="hidden" name="type" value="gestor">
                <input type="hidden" name="estado" value="inativo">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Cândido Ucuahamba/XPTO SOLUTIONS" name="nome"required>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Província</label>
                    <select class="form-select" id="provinciaSelect" name="provincia"required>
                        <option selected>Selecione a província: </option>
                        <?php
                        $provinciaController->recuperarProvincias();
                        ?>
                    </select>
                </div>


                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Municício</label>
                    <select class="form-select" id="municipioSelect" name="municipio"required>
                        <option selected>Selecione o município: </option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Comuna</label>
                    <select class="form-select" id="comunaSelect" name="comuna"required>
                        <option selected>Selecione a comuna: </option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Morada</label>
                    <input name="morada" type="text" class="form-control" id="inputAddress2" placeholder="Insira a sua morada"required>
                </div>

                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="exemplo@gmail.com" name="email"required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Telefone</label>
                    <input type="number" class="form-control" id="telefone" placeholder="9XXXXXXXX" name="telefone" minlength="9" maxlength="12" required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class=" col-md-8">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="iamexemplo" aria-label="Username" aria-describedby="addon-wrapping" name="username"required>
                </div>

                <div class="col-md-8">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="pass1"required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="col-md-8">
                    <label for="inputPassword4" class="form-label">Confirmar Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="pass2" class="teste" required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button name="btn-registrar" type="submit" class="btn btn-outline-light">Registrar</button>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-outline-danger" onclick="location.href = './homeAdmin.php'">Voltar</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="../scripts/jquery/jquery.min.js"></script>
        <script src="../scripts/custom/cascata.js"></script>
    </body>
</html>

<?php
if (isset($_POST['btn-registrar'])) {
    $nome = $_POST['nome'];
    $provincia = $_POST['provincia'];
    $municipio = $_POST['municipio'];
    $comuna = $_POST['comuna'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $morada = $_POST['morada'];
    $username = $_POST['username'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $type = $_POST['type'];
    $estado = $_POST['estado'];

    if ($pass1 == $pass2) {
        $gestor = new Gestor();

        $gestor->setNome($nome);
        $gestor->setProvincia($provincia);
        $gestor->setMunicipio($municipio);
        $gestor->setComuna($comuna);
        $gestor->setMorada($morada);
        $gestor->setEmail($email);
        $gestor->setTelefone($telefone);
        $gestor->setUsername($username);
        $gestor->setPassword($pass1);
        $gestor->setType($type);
        $gestor->setEstado($estado);

        $adminController->registroGestor($gestor);
        ?>
        <?php
    } else {
        ?>
        <script src="../scripts/custom/meujs.js"></script>
        <script> alertaPassword();</script>
        <?php
    }
}