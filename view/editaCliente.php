<?php
include_once (__DIR__ . '/../controllers/ProvinciaController.php');
include_once (__DIR__ . '/../controllers/AdminController.php');
include_once (__DIR__ . '/../model/Client.php');
session_start();
$user = $_SESSION['user'];

$id = $_SESSION['idCliente'];

$controller = new AdminController();
$paises = $controller->recuperarPaises();
        
$cliente = $controller->recuperarClientebyUsername($user);
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
        <script src="../scripts/custom/validateTel.js"></script>
    </head>
    <!--Colocar title em todos os inputs de forma a direcionar o user sobre oq deve escrever-->
    <body class="corpo"; style="background: url('../content/img/slide2.jpg') center; background-size: cover">
        <div>
            <form class="form-caixa row g-3" method="POST">
                
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Nome Completo/Nome da empresa</label>
                    <input name="nome" type="text" class="form-control" id="nome" value="<?php echo $cliente->getNome(); ?>">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="tipo">Tipo de cliente</label>
                    <select name="tipo" class="form-select" id="tipo">
                        <option value="<?php echo $cliente->getTipo();?>"> <?php echo $cliente->getTipo(); ?> </option>
                        <option value="particular">Particular</option>
                        <option value="empresa">Empresarial</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="atividade">Atividade</label>
                    <input name="atividade" type="text" class="form-control" id="atividade" onchange="habilitarDesabilitarInput()" value="<?php echo $cliente->getAtividade(); ?>">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="provincia">Província</label>
                    <select name="provincia" class="form-select" id="provinciaSelect">
                        <option value="<?php echo $cliente->getProvincia(); ?>"><?php echo $cliente->getProvincia(); ?></option>
                        <?php
                        $provinciaController->recuperarProvincias();
                        ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="municipio">Municício</label>
                    <select name="municipio" class="form-select" id="municipioSelect">
                        <option value="<?php echo $cliente->getMunicipio();?>"><?php echo $cliente->getMunicipio(); ?></option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="comuna">Comuna</label>
                    <select name="comuna" class="form-select" id="comunaSelect">
                        <option value="<?php echo $cliente->getComuna(); ?>"><?php echo $cliente->getComuna(); ?></option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="nacionalidade">Nacionalidade</label>
                    <select name="nacionalidade" class="form-select" id="nacionalidade">
                        <option><?php echo $cliente->getNacionalidade(); ?></option>
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?php echo $pais->getIdPaises(); ?>"><?php echo $pais->getNomePaises(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="inputAddress2" class="morada-label">Morada</label>
                    <input name="morada" type="text" class="form-control" id="morada" value="<?php echo $cliente->getMorada(); ?>">
                </div>

                <div class="col-md-8">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $cliente->getEmail(); ?>">
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="col-md-8">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input name="telefone" type="tel" class="form-control" id="telefone" value="<?php echo $cliente->getTelefone(); ?>">
                    <small id="telefone"></small>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                    <input name="username" type="hidden" value="<?php echo $cliente->getUsername(); ?>">

                <div class="col-md-8">
                    <label for="password1" class="form-label">Password</label>
                    <input name="password1" type="password" class="form-control" id="passe" value="<?php echo $cliente->getPassword(); ?>">
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="col-md-8">
                    <label for="password2" class="form-label">Confirmar Password</label>
                    <input name="password2" type="password" class="form-control" id="password2">
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button name="btn-editar" type="submit" class="btn btn-outline-light" >Editar</button>
                    </div>
                    <div class="col-3">
                        <button name="btn-voltar" class="btn btn-outline-danger" onclick="location.href = 'homeLogged.php'">Voltar</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="../scripts/jquery/jquery.min.js"></script>
        <script src="../scripts/custom/cascata.js"></script>
        <script src="../scripts/custom/accountType.js"></script>
    </body>
</html>

<?php
if (isset($_POST['btn-editar'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $atividade = $_POST['atividade'];
    $nacionalidade = $_POST['nacionalidade'];
    $morada = $_POST['morada'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $username = $_POST['username'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];
    $provincia = $_POST['provincia'];
    $municipio = $_POST['municipio'];
    $comuna = $_POST['comuna'];
    $idd = $_POST['id'];
    if ($password == $password2) {
        $cliente = new Client();

        $cliente->setNome($nome);
        $cliente->setTipo($tipo);
        if (!isset($atividade)){
            $cliente->setAtividade($atividade);
        } else {
            $cliente->setAtividade("nenhuma");
        }
        $cliente->setProvincia($provincia);
        $cliente->setMunicipio($municipio);
        $cliente->setComuna($comuna);
        $cliente->setNacionalidade($nacionalidade);
        $cliente->setMorada($morada);
        $cliente->setEmail($email);
        $cliente->setTelefone($telefone);
        $cliente->setUsername($username);
        $cliente->setPassword($password);
        $cliente->setIdCliente($idd);
        $controller->editarCliente($cliente);
    } else {
        ?>
        <script src="../scripts/custom/meujs.js"></script>
        <script> alertaPassword();</script>
        <?php
    }
} if (isset($_POST['btn-voltar'])) {
    $url = "homeLogged.php";
    $controller->redirect($url);
}


