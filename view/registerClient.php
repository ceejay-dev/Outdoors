<?php
include_once (__DIR__ . '/../controllers/AdminController.php');
include_once (__DIR__ . '/../controllers/ProvinciaController.php');
$adminController = new AdminController();
$paises = $adminController->recuperarPaises();

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
                <input type="hidden" name="type" value="cliente">
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Nome Completo/Nome da Empresa</label>
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Cândido Ucuahamba/XPTO SOLUTIONS"required>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="tipo">Tipo de cliente</label>
                    <select name="tipo" class="form-select" id="tipo" onchange="habilitarDesabilitarInput()">
                        <option selected>Selecione o tipo: </option>
                        <option value="particular" id="particular">particular</option>
                        <option value="empresa" id="empresarial">empresarial</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="atividade">Atividade</label>
                    <input name="atividade" type="text" class="form-control" id="atividade" placeholder="Insira a atividade da empresa">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="provincia">Província</label>
                    <select name="provincia" class="form-select" id="provinciaSelect"required>
                        <option > Selecione a província: </option>
                        <?php
                        $provinciaController->recuperarProvincias();
                        ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="municipio">Municício</label>
                    <select name="municipio" class="form-select" id="municipioSelect" required>
                        <option > Selecione o município: </option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="comuna">Comuna</label>
                    <select name="comuna" class="form-select" id="comunaSelect">
                        <option > Selecione a comuna: </option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="nacionalidade">Nacionalidade</label>
                    <select name="nacionalidade" class="form-select" id="nacionalidade">
                        <option selected>Selecione a nacionalidade: </option>
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?php echo $pais->getIdPaises(); ?>"><?php echo $pais->getNomePaises(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label for="inputAddress2" class="morada-label">Morada</label>
                    <input name="morada" type="text" class="form-control" id="morada" placeholder="Insira a sua morada"required>
                </div>

                <div class="col-md-8">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="exemplo@gmail.com"required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="col-md-8">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input name="telefone" type="number" class="form-control" id="telefone" placeholder="Insira o número de telefone" minlength="9" maxlength="12">
                    <small id="telefone"></small>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class=" col-md-8">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" placeholder="iamexemplo" aria-label="Username" aria-describedby="addon-wrapping"required>
                </div>

                <div class="col-md-8">
                    <label for="password1" class="form-label">Password</label>
                    <input name="password1" type="password" class="form-control" id="passe"required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="col-md-8">
                    <label for="password2" class="form-label">Confirmar Password</label>
                    <input name="password2" type="password" class="form-control" id="password2"required>
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button name="btn-registrar" type="submit" class="btn btn-outline-light">Registrar</button>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-outline-danger" onclick="location.href = '../home.php'">Voltar</button>
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
if (isset($_POST['btn-registrar'])) {
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
    $type = $_POST['type'];

    if ($password == $password2) {
        $cliente = new Client();

        $cliente->setNome($nome);
        $cliente->setTipo($tipo);
        if (!isset($atividade)){
            $cliente->setAtividade($atividade);
        } else {
            $cliente->setAtividade("nenhuma");
        }
        //$cliente->setAtividade($atividade);
        $cliente->setProvincia($provincia);
        $cliente->setMunicipio($municipio);
        $cliente->setComuna($comuna);
        $cliente->setNacionalidade($nacionalidade);
        $cliente->setMorada($morada);
        $cliente->setEmail($email);
        $cliente->setTelefone($telefone);
        $cliente->setUsername($username);
        $cliente->setPassword($password);
        $cliente->setType($type);

        $adminController->registroCliente($cliente);
    } else {
        ?>
        <script src="../scripts/custom/meujs.js"></script>
        <script> alertaPassword();</script>
        <?php
    }
}
