<?php
include_once (__DIR__ . '/../model/Gestor.php');
include_once (__DIR__ . '/../services/GestorService.php');

class GestorController {

    //atributo
    private $gestorService;

    //construtor
    public function __construct() {
        $this->gestorService = new GestorService();
    }

    //redireccionador
    public function redirect($url) {
        echo (' <script> window.location.replace(" ' . $url . ' "); </script> ');
    }


    //lidar com parametros na url
    public function requestsHandler() {

        $filterOp = filter_input(INPUT_GET, 'op');
        $op = isset($filterOp) ? $filterOp : NULL;
        
        $filterId = filter_input(INPUT_GET, 'id');
        $id = isset($filterId) ? $filterId : NULL;
        
        $filtroId = filter_input(INPUT_GET, 'ident');
        $edit = isset($filtroId) ? $filtroId : NULL;
        
        try {
            //funcao terminar sessao, then send to index user not registed
            if ($op == 'end') {
                session_destroy();
                $url = "../home.php";
                //redirecciona para o home
                $this->redirect($url);
            } else if ($id != NULL){
                $resultado = $this->gestorService->apagarOutdoor($id);
                if ($resultado == true){
                    $url = "apagarOutdoors.php";
                    $this->redirect($url);
                }
            } else if ($edit != NULL){
                $_SESSION['ident'] = $edit;
                $url = "editOutdoor.php";
                $this->redirect($url);
            } 
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //inserir outdoors
    public function registroOutdoor(Outdoor $outdoor) {
        $query = $this->gestorService->registroOutdoor($outdoor);

        if ($query === true) {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaOutdoorCriado();</script>
            <?php
            //$url = './homeGestor.php';
            //$this->redirect($url);
        } else {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaOutdoorFail();</script>
            <?php
        }
    }

    //lista de outdoors
    public function recuperarOutdoors() {
        return $this->gestorService->recuperarOutdoors();
    }

    //lista de outdoors disponiveis 
    public function recuperarOutdoorsDisp() {
        return $this->gestorService->recuperarOutdoorsDisp();
    }

    //Método para verificar o estado do gestor
    public function verificaEstadoGestor($id) {
        return $this->gestorService->verificaEstadoGestor($id);
    }
    
    //Método para trocar a palavra passe do gestor no primeiro login 
    public function trocarPass($password, $id) {
        $resultado = $this->gestorService->trocarPass($password, $id);
        if ($resultado) {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script>alertaGestor();</script>
            <?php
            $url = "homeGestor.php";
            $this->redirect($url);
        }
    }
    
    //Método para apagar o outdoor em função do id
    public function apagarOutdoor($id) {
        return $this->gestorService->apagarOutdoor($id);
    }
    
    //Método para editar os dados de registo do outdoor
    public function editarOutdoor(Outdoor $outdoor){
        $query = $this->gestorService->editarOutdoor($outdoor);

        if ($query == true) {
            $url = "editarOutdoor.php";
            $this->redirect($url);
        } else {
            
        }
    }
    
    //Método que retorna um outdoor em função do id
    public function recuperarOutdoorbyId($id) {
        return $this->gestorService->recuperarOutdoorbyId($id);
    }
    
    //Método que retorna o id do gestor com menor solicitação 
    public function recuperarGestorBySolic() {
        return $this->gestorService->recuperarGestorBySolic();
    }
    
    public function recuperarNumeroSolic($id) {
        return $this->gestorService->recuperarNumeroSolic($id);
    }
    
    
    public function incrementarNumeroSolic($fk_gestor) {
        return $this->gestorService->incrementarNumeroSolic($fk_gestor);
    }
    
    public function validarPagamento($id) {
        return $this->gestorService->validarPagamento($id);
    }
    
    public function negarPagamento($id) {
        return $this->gestorService->negarPagamento($id);
    }
    
    public function recuperarMeusPedidos($id) {
        return $this->gestorService->recuperarMeusPedidos($id);
    }
}
