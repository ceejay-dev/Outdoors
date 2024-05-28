<?php

include_once (__DIR__ . '/../dbconfig/Dbconfig.php');
include_once (__DIR__ . './IUserRepository.php');

class UserRepository implements IUserRepository {

    private $db;

    public function __construct() {
        $this->db = Dbconfig::getInstance();
    }

    //redireccionador
    public function redirect($url) {
        echo (' <script> window.location.replace(" ' . $url . ' "); </script> ');
    }

    //Método para verificar se um usuário cumpre com os requisitos para fazer o login
    public function verificarLogin($username, $password) {
        try {
            $stmt1 = $this->db->prepare("SELECT tipo FROM usuarios WHERE username = :username and passe = :pass");
            $stmt1->bindParam(':username', $username);
            $stmt1->bindParam(':pass', $password);
            $stmt1->execute();

            $login = $stmt1->fetchColumn();
            return $login;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getGestorId() {
        $stmt = $this->db->prepare("SELECT idUsuario FROM usuarios WHERE tipo='gestor' ORDER BY idUsuario DESC LIMIT 1");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getClienteId() {
        $stmt = $this->db->prepare("SELECT idUsuario FROM usuarios WHERE tipo='cliente' ORDER BY idUsuario DESC LIMIT 1");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

}
