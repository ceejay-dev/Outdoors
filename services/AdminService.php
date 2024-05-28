<?php

include_once (__DIR__ . './IAdminService.php');
include_once (__DIR__ . '/../repositories/AdminRepository.php');

class AdminService implements IAdminService {

    private $adminRepository;

    function __construct() {
        $this->adminRepository = new AdminRepository();
    }

    public function registroCliente(Client $cliente) {
        try {
            return $this->adminRepository->registroCliente($cliente);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function verificarCliente($email, $username) {
        try {
            return $this->adminRepository->verificarCliente($email, $username);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarPaises() {
        try {
            return $this->adminRepository->recuperarPaises();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function registroGestor(Gestor $gestor) {
        try {
            return $this->adminRepository->registroGestor($gestor);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function apagarGestor($id) {
        try {
            return $this->adminRepository->apagarGestor($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function verificarGestor($email) {
        try {
            return $this->adminRepository->verificarGestor($email);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function ativaDesativaConta($username) {
        try {
            $this->adminRepository->ativaDesativaConta($username);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function recuperarClientes() {
        try {
            return $this->adminRepository->recuperarClientes();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function verificaEstadoCliente($id) {
        try {
            return $this->adminRepository->verificaEstadoCliente($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarClientebyUsername($username) {
        try {
            return $this->adminRepository->recuperarClientebyUsername($username);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarIdUsuariobyUsername($username) {
        try {
            return $this->adminRepository->recuperarIdUsuariobyUsername($username);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarGestores() {
        try {
            return $this->adminRepository->recuperarGestores();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function trocarEmailAdm(User $user) {
        try {
            return $this->adminRepository->trocarEmailAdm($user);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarEmailAdm() {
        try {
            return $this->adminRepository->recuperarEmailAdm();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarCliente(Client $client) {
        try {
            return $this->adminRepository->editarCliente($client);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente, $numeroPedido, $fk_gestor) {
        try {
            return $this->adminRepository->solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente, $numeroPedido, $fk_gestor);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarIdClienteByUsername($username) {
        try {
            return $this->adminRepository->recuperarIdClienteByUsername($username);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarSolicitacoesCliente($id) {
        try {
            return $this->adminRepository->recuperarSolicitacoesCliente($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function controleNumeroPedidos($id) {
        try {
            return $this->adminRepository->controleNumeroPedidos($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function verificaPrimeiroPedido($id) {
        try {
            return $this->adminRepository->verificaPrimeiroPedido($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function submeterComprovativo($id) {
        try {
            return $this->adminRepository->submeterComprovativo($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarEstadoOutdoor($id) {
        try {
            return $this->adminRepository->recuperarEstadoOutdoor($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarMeusOutdoors($id) {
        try {
            return $this->adminRepository->recuperarMeusOutdoors($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarGestoresbyUsername($username) {
        try {
            return $this->adminRepository->recuperarGestorbyUsername($username);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}
