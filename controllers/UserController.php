<?php

include_once (__DIR__ . '/../services/UserService.php');
include_once (__DIR__ . '/../controllers/GestorController.php');
include_once (__DIR__ . '/../controllers/AdminController.php');

class UserController {

    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    //redireccionador
    public function redirect($url) {
        echo (' <script> window.location.replace(" ' . $url . ' "); </script> ');
    }

    public function verificarLogin($username, $password) {
        $tipo = $this->userService->verificarLogin($username, $password);
        $admin = new AdminController();
        $cliente = $admin->recuperarIdClienteByUsername($username);
       
        if ($tipo === "cliente") {
             
            $id = $this->getClienteId();
            $estado = $admin->verificaEstadoCliente($id);
            
            if ($estado === "inativo"){
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>alertaContaInativa();</script>
                <?php
                $url = "../home.php";
                $this->redirect($url);
            } else {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['idCliente'] = $cliente;
            
            $url = "homeLogged.php";
            $this->redirect($url);
            }
        } elseif ($tipo === "gestor") {
            $gestor = new GestorController();
            $idG = $this->getGestorId();
            
            $estado = $gestor->verificaEstadoGestor($idG);

            if ($estado === "inativo") {
                //ssession_start();
                $_SESSION['user'] = $username;
                
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>alertaAlterar();</script>
                <?php
                $url = "trocarPassGestor.php";
                $this->redirect($url);
            } else {
                $gestor = new AdminController();
                $_SESSION['idGestor'] = $gestor->recuperarGestoresbyUsername($username);
                $url = "homeGestor.php";
                $this->redirect($url);
                
            }
        } elseif ($tipo === "admin") {
            session_start();
            $_SESSION['user'] = $username;
            $url = "homeAdmin.php";
            $this->redirect($url);
        } else {
            //BAD NEWS
            if ($tipo === "inativo") {
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>alertaContaInativa();</script>
                <?php
            } else {
                ?>
                <script src="../scripts/custom/meujs.js"></script>
                <script>
                    alertaCredencias();
                </script>
                <?php
            }
        }
        $url = "login.php";
        $this->redirect($url);
    }

    //método para recuperar o id do gestor
    public function getGestorId() {
        return $this->userService->getGestorId();
    }
    
    //método para recuperar o id do cliente
    public function getClienteId() {
        return $this->userService->getClienteId();
    }
}
