<?php
include_once (__DIR__. '/../model/User.php');
include_once (__DIR__. '/../model/Client.php');

interface IAdminRepository{
    public function registroCliente(Client $cliente);
    public function verificarCliente($email, $username);
    public function recuperarPaises();
    public function registroGestor(Gestor $gestor);
    public function apagarGestor($id);
    public function verificarGestor($email);
    public function ativaDesativaConta($username);
    public function recuperarClientes();
    public function verificaEstadoCliente($id);
    public function recuperarClientebyUsername($username);
    public function recuperarIdUsuariobyUsername($username);
    public function trocarEmailAdm(User $user);
    public function recuperarEmailAdm();
    public function editarCliente(Client $client);
    public function solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente);
    public function recuperarIdClienteByUsername($username);
    public function recuperarSolicitacoesCliente($id);
    public function controleNumeroPedidos($id);
    public function verificaPrimeiroPedido($id);
    public function submeterComprovativo($id);
    public function recuperarEstadoOutdoor($id);
    public function recuperarMeusOutdoors($id);
    public function recuperarGestoresbyUsername($username);
}
