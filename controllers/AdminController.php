<?php

include_once (__DIR__ . '/../model/Client.php');
include_once (__DIR__ . '/../services/AdminService.php');

class AdminController {

    private $adminService;

    public function __construct() {
        $this->adminService = new AdminService();
    }

    //redireccionador
    public function redirect($url) {
        echo (' <script> window.location.replace(" ' . $url . ' "); </script> ');
    }

    //Método para o registro de clientes
    public function registroCliente(Client $cliente) {
        if (!$this->verificarCliente($cliente->getEmail(), $cliente->getUsername())) {
            $query = $this->adminService->registroCliente($cliente);
            if ($query) {
                //GOOD NEWS
                $this->sendEmail($cliente->getNome(), $cliente->getUsername(), $cliente->getEmail(), $this->recuperarEmailAdm());
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>
                    alertaContaCriada();
                </script>
                <?php

                //redireccionar para a pagina login
                $url = "login.php";
                $this->redirect($url);
            } else {
                //BAD NEWS
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>
                    alertaContaFail();
                </script>
                <?php

            }
        } else {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script>
                    alertaDados();
            </script>
            <?php

        }
    }

    //verifica a existência de dados semelhantes 
    public function verificarGestor($email) {
        return $this->adminService->verificarGestor($email);
    }

    //lidar com parâmetros na url
    public function requestsHandler() {

        $filterOp = filter_input(INPUT_GET, 'op');
        $op = isset($filterOp) ? $filterOp : NULL;

        $filtroAt = filter_input(INPUT_GET, 'user');
        $atv = isset($filtroAt) ? $filtroAt : NULL;

        $filtroId = filter_input(INPUT_GET, 'id');
        $id = isset($filtroId) ? $filtroId : NULL;

        try {
            //terminando a sessão sessao
            if ($op == 'end') {
                session_destroy();
                $url = '../home.php';
                //redirecciona para o home
                $this->redirect($url);
            } else if ($atv != NULL) {
                $this->ativaDesativaConta($atv);
                $url = "ativarContas.php";
                $this->redirect($url);
            } else if ($id != NULL) {
                $this->apagarGestor($id);
                $url = "apagarGestores.php";
                $this->redirect($url);
            }
        } catch (Exception $ex) {
            
        }
    }

    //Método para verificar se o email e username já existem 
    public function verificarCliente($email, $username) {
        $resultado = $this->adminService->verificarCliente($email, $username);

        return $resultado;
    }

    //Método para retornar os países num select do formuulário do cliente
    public function recuperarPaises() {
        return $this->adminService->recuperarPaises();
    }

    //registro de um gestor
    public function registroGestor(Gestor $gestor) {
        if (!$this->verificarGestor($gestor->getEmail())) {
            $query = $this->adminService->registroGestor($gestor);
            if ($query) {
                //GOOD NEWS
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>
                    alertaContaCriada();
                </script>
                <?php

            } else {
                //BAD NEWS
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>
                    alertaContaFail();
                </script>
                <?php

            }
        } else {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script>
                    alertaDados();
            </script>
            <?php

        }
    }

    //Método para apagar gestores
    public function apagarGestor($id) {
        $query = $this->adminService->apagarGestor($id);

        if ($query) {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script>
                    alertaSucesso();
            </script>
            <?php

        } else {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script>
                    alertaFalha();
            </script>
            <?php

        }
    }

    //Ativar e desativar conta
    public function ativaDesativaConta($username) {
        return $this->adminService->ativaDesativaConta($username);
    }

    //Método para recuperar todos os clientes
    public function recuperarClientes() {
        return $this->adminService->recuperarClientes();
    }

    //Método para verificar o estado do cliente
    public function verificaEstadoCliente($id) {
        return $this->adminService->verificaEstadoCliente($id);
    }

    //Método para retorna as informações de registo do cliente a partir do username(UNIQUE)
    public function recuperarClientebyUsername($username) {
        return $this->adminService->recuperarClientebyUsername($username);
    }

    //Método para recuperar todos os gestores criados
    public function recuperarGestores() {
        return $this->adminService->recuperarGestores();
    }

    //Método para trocar o email do administrador
    public function trocarEmailAdmin(User $user) {
        $query = $this->adminService->trocarEmailAdm($user);
        if ($query) {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaSucesso();</script>
            <?php

            $url = "homeAdmin.php";
            $this->redirect($url);
        } else {
            ?>
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaFalha();</script>
            <?php

            $url = "trocarEmailAdmin.php";
            $this->redirect($url);
        }
    }

    //Método responsável por enviar email
    public function sendEmail($nome, $username, $orgm, $dest) {
        $message = "Notificamos que houve registo de um novo usuário no Outdoors Gest que carece da ativação de conta para que possa fazer solicitações.<br> - Conselho Administrativo Outdoors Gest";
        $assunto = "Activação de conta do novo utilizador com os seguintes dados : "
                . "Nome: " . $nome .
                " Email: " . $orgm .
                " Username: " . $username;
        $nomeDestinatario = "Administrador";
        $emailDestinatario = $dest; //Sempre que uma conta for criada irá enviar-te um email
        require_once '../mailer/Email.php';
    }

    //Método que retorna o email do administrador
    public function recuperarEmailAdm() {
        return $this->adminService->recuperarEmailAdm();
    }

    //Método para editar os clientes 
    public function editarCliente(Client $cliente) {
        $query = $this->adminService->editarCliente($cliente);

        if ($query) {
            ?> 
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaSucesso();</script>
            <?php

            $url = "homeLogged.php";
            $this->redirect($url);
        } else {
            ?> 
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaFalha();</script>
            <?php

        }
    }

    //Método para solicitar 
    public function solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente, $numeroPedido, $fk_gestor) {
        $query = $this->adminService->solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente, $numeroPedido, $fk_gestor);

        if ($query) {
            ?> 
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaAluguer();</script>
            <?php

            $url = "minhasSolicitacoesC.php";
            $this->redirect($url);
        } else {
            ?> 
            <script src="../scripts/custom/meujs.js"></script>
            <script> alertaAluguerFail();</script>
            <?php
        }
    }

    public function recuperarIdUsuariobyUsername($username) {
        return $this->adminService->recuperarIdUsuariobyUsername($username);
    }

    public function recuperarIdClienteByUsername($username) {
        return $this->adminService->recuperarIdClienteByUsername($username);
    }

    public function recuperarSolicitacoesCliente($id) {
        return $this->adminService->recuperarSolicitacoesCliente($id);
    }

    public function controleNumeroPedidos($id) {
        return $this->adminService->controleNumeroPedidos($id);
    }

    public function verificaPrimeiroPedido($id) {
        return $this->adminService->verificaPrimeiroPedido($id);
    }
    
    public function submeterComprovativo($id) {
        $query = $this->adminService->submeterComprovativo($id);
        
        if($query){
            ?> 
            <script> alert("Operação realizada com sucesso! O gestor receberá a sua solicitação.");</script>
            <?php
            $url = "minhasSolicitacoesC.php";
            $this->redirect($url);
        }else {
            ?> 
            <script> alert("Falha na operação! tente novamente");</script>
            <?php
            $url = "homeLogged.php";
            $this->redirect($url);
        }
    }
    
    public function recuperarEstadoOutdoor($id) {
        return $this->adminService->recuperarEstadoOutdoor($id);
    }
    
    public function recuperarMeusOutdoors($id) {
        return $this->adminService->recuperarMeusOutdoors($id);
    }
    
    public function recuperarGestoresbyUsername($username){
        return $this->adminService->recuperarGestoresbyUsername($username);
    }

}
