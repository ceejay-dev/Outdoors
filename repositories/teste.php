<?php

include_once '../repositories/AdminRepository.php';
include_once '../repositories/GestorRepository.php';

$admin = new AdminRepository();
$admin->submeterComprovativo(2);


$gestor = new GestorRepository();
$gestor->recuperarMeusPedidos(3);

var_dump($gestor->recuperarMeusPedidos(3)); 