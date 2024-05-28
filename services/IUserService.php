<?php


interface IUserService {
    public function verificarLogin($username, $password);
    public function getGestorId();
    public function getClienteId();
}
