<?php
session_start();
include_once (__DIR__ . '/../controllers/AdminController.php');
include_once (__DIR__ . '/../controllers/GestorController.php');
include_once (__DIR__ . '/../model/Outdoor.php');

$filtroOt = filter_input(INPUT_GET, 'ot');
$ot = isset($filtroOt) ? $filtroOt : NULL;

$controler = new GestorController();

$outdoor = $controler->recuperarOutdoorbyId($ot);

$controllerAdm = new AdminController();

if ($controllerAdm->verificaPrimeiroPedido($_SESSION['idCliente'])){
    $numeroPedido = $controllerAdm->controleNumeroPedidos($_SESSION['idCliente']);
}
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
    <body class="corpo"; style="background: url('../content/img/slide2.jpg') center; background-size: cover">
        <div>
            <form class="aluguer-form row g-3" method="POST" onsubmit="return validarData()">

                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Tipo de outdoor</label>
                    <input name="tipo" type="text" class="form-control" id="tipo" value="<?php echo $outdoor->getTipoOutdoor(); ?>" disabled="tipo">
                </div>

                <!--COLOCAR APENAS UM INPUT PARA A LOCALIZAÇÃO DO OUTDOOR-->
                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Localização</label>
                    <input name="localizacao" type="text" class="form-control" id="localizacao" value="<?php echo $outdoor->getProvinciaO() . "," . $outdoor->getMunicipioO() . "," . $outdoor->getComunaO(); ?>" disabled="localizacao">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Preço unitário</label>
                    <input name="preco" type="number" class="form-control" id="preco" value="<?php echo $outdoor->getPreco(); ?>" disabled="preco">
                </div>
                
                <div class="col-md-12">
                    <label class="form-label" for="specificSizeSelect">Imagem</label>
                    <input type="file" class="form-control" id="imagem" placeholder="" name="imagem">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="preco">Data de início do aluguer: </label>
                    <input name="dataI" type="date" class="form-control" id="dataI" placeholder="">
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="preco">Data de término do aluguer: </label>
                    <input name="dataF" type="date" class="form-control" id="dataF" placeholder="">
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button name="btn-solicitar" type="submit" class="btn btn-outline-light" onclick="carregarComprovativo.php?ot=<?php echo $outdoor->getIdOutdoor(); ?>"<?php $_SESSION['idOutdoor'] = $outdoor->getIdOutdoor(); ?>>Solicitar</button>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-outline-danger" href="listaOutdoorsC.php?ot=<?php echo $outdoor->getIdOutdoor(); ?>">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <script src="../scripts/jquery/jquery.min.js"></script>
        <script src="../scripts/custom/validationData.js"></script>
    </body>
</html>

<?php
if (isset($_POST['btn-voltar'])) {
    $url = "listaOutdoorsC.php";
    $controler->redirect($url);
} else if (isset($_POST['btn-solicitar'])) { 
    $dataI = $_POST['dataI'];
    $dataF = $_POST['dataF'];
    $preco = $outdoor->getPreco();

    $datatInicial = new DateTime($dataI);
    $dataFinal = new DateTime($dataF);

    // Calcular a diferença entre as datas para obter o número de dias
    $intervalo = $datatInicial->diff($dataFinal);

    // Número de dias em função da data de início e fim do aluguer
    $numeroDias = $intervalo->days;

    $pagamento = $preco*$numeroDias;
    echo '<script> alert("O pagamento total será de: '.$pagamento.' AKZ");</script>';
    $fk_outdoor = $outdoor->getIdOutdoor();
    
    $fk_cliente = $_SESSION['idCliente'];
    //echo '<script> alert("O cliente é o : '.$fk_cliente.'");</script>';
    
    
    $controllerAdm->solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente, $numeroPedido, $fk_gestor);
}
