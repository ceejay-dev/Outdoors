<?php

include_once (__DIR__ . '/../model/Gestor.php');

interface IGestorRepository {
    public function registroOutdoor(Outdoor $outdoor);
    public function recuperarOutdoors();
    public function recuperarOutdoorsDisp();
    public function verificaEstadoGestor($id);
    public function trocarPass($password, $id);
    public function apagarOutdoor($id);
    public function editarOutdoor(Outdoor $outdoor);
    public function recuperarOutdoorbyId($id);
    public function recuperarGestorBySolic();
    public function recuperarNumeroSolic($id);
    public function incrementarNumeroSolic($fk_gestor);
    public function validarPagamento($id);
    public function negarPagamento($id);
    public function recuperarMeusPedidos($id);
}
