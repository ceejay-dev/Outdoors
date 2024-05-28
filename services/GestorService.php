<?php

include_once (__DIR__ . './IGestorService.php');
include_once (__DIR__ . '/../repositories/GestorRepository.php');

class GestorService implements IGestorService {

    private $gestorRepository;

    function __construct() {
        $this->gestorRepository = new GestorRepository();
    }

    public function registroOutdoor(Outdoor $outdoor) {
        try {
            $this->gestorRepository->registroOutdoor($outdoor);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarOutdoors() {
        try {
            return $this->gestorRepository->recuperarOutdoors();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarOutdoorsDisp() {
        try {
            return $this->gestorRepository->recuperarOutdoorsDisp();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function verificaEstadoGestor($id) {
        try {
            return $this->gestorRepository->verificaEstadoGestor($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function trocarPass($password, $id) {
        try {
            return $this->gestorRepository->trocarPass($password, $id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function apagarOutdoor($id) {
        try {
            return $this->gestorRepository->apagarOutdoor($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editarOutdoor(Outdoor $outdoor) {
        try {
            $this->gestorRepository->editarOutdoor($outdoor);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarOutdoorbyId($id) {
        try {
            return $this->gestorRepository->recuperarOutdoorbyId($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarGestorBySolic() {
        try {
            return $this->gestorRepository->recuperarGestorBySolic();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarNumeroSolic($id) {
        try {
            return $this->gestorRepository->recuperarNumeroSolic($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function incrementarNumeroSolic($fk_gestor) {
        try {
            return $this->gestorRepository->incrementarNumeroSolic($fk_gestor);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function validarPagamento($id) {
        try {
            return $this->gestorRepository->validarPagamento($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function negarPagamento($id) {
        try {
            return $this->gestorRepository->negarPagamento($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarMeusPedidos($id) {
        try {
            return $this->gestorRepository->recuperarMeusPedidos($id);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
