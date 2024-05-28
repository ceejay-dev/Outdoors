<?php


interface IUserRepository {
    public function verificarLogin($username, $password);
    public function getGestorId();
    public function getClienteId();
}
