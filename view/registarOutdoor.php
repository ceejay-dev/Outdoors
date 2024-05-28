<?php
include_once (__DIR__ . '/../controllers/ProvinciaController.php');
include_once (__DIR__ . '/../controllers/GestorController.php');
include_once (__DIR__ . '/../model/Outdoor.php');

$provinciaController = new ProvinciaController();
$controller = new GestorController();
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
    <!--Colocar title em todos os inputs de forma a direcionar o user sobre oq deve escrever-->
    <body class="corpo wallpaper">
        <div>
            <form class="out-form row g-3" method="POST">
                <input type="hidden" name="estado" value="disponivel">
                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Tipo de outdoor</label>
                    <select name="tipo" class="form-select" id="specificSizeSelect">
                        <option selected>Selecione o tipo: </option>
                        <option value="Painel Luminoso">Painel Luminoso</option>
                        <option value="Painel Não Luminoso">Painel Não Luminoso</option>
                        <option value="Faixadas">Faixadas</option>
                        <option value="Placas Indicativas">Placas indicativas</option>
                        <option value="Lampoles">Lampoles</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="provincia">Província</label>
                    <select name="provincia" class="form-select" id="provinciaSelect">
                        <option >Selecione a província: </option>
                        <?php
                        $provinciaController->recuperarProvincias();
                        ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Municício</label>
                    <select name="municipio" class="form-select" id="municipioSelect">
                        <option >Selecione o município: </option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Comuna</label>
                    <select name="comuna" class="form-select" id="comunaSelect">
                        <option >Selecione a comuna: </option>
                    </select>
                </div>

                <div class="col-md-8">
                    <label for="inputEmail4" class="form-label">Preço</label>
                    <input name="preco" type="text" class="form-control" id="preco" placeholder="90.000.00">
                    <div data-lastpass-icon-root="true" class="div-form"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button name="btn-registrar" type="submit" class="btn btn-outline-light">Registrar</button>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-outline-danger" name="btn-voltar">Voltar</button>
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
    $tipo = $_POST['tipo'];
    $provincia = $_POST['provincia'];
    $municipio = $_POST['municipio'];
    $comuna = $_POST['comuna'];
    $preco = $_POST['preco'];
    $estado = $_POST['estado'];

    $outdoor = new Outdoor();
    $outdoor->setTipoOutdoor($tipo);
    $outdoor->setPreco($preco);
    $outdoor->setProvinciaO($provincia);
    $outdoor->setMunicipioO($municipio);
    $outdoor->setComunaO($comuna);
    $outdoor->setEstado($estado);

    $controller->registroOutdoor($outdoor);
}

if (isset($_POST['btn-voltar'])) {
    $url = "homeGestor.php";
    $controller->redirect($url);
}

