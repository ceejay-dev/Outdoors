<?php
include_once (__DIR__. './User.php');
class Client extends User{
    //Atributos
    private $idCliente;
    private $nome;
    private $tipo;
    private $atividade;
    private $provincia;
    private $municipio;
    private $comuna;
    private $nacionalidade;
    private $morada;
    private $telefone;
    private $estadoC;




    //Construtor padrão
    public function __construct() {
    }
    
    //Getters e setters 
    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getAtividade() {
        return $this->atividade;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getMunicipio() {
        return $this->municipio;
    }

    public function getComuna() {
        return $this->comuna;
    }

    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function getMorada() {
        return $this->morada;
    }

    public function getTelefone() {
        return $this->telefone;
    }
    
    public function getEstadoC() {
        return $this->estadoC;
    }

    public function setIdCliente($idCliente): void {
        $this->idCliente = $idCliente;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    public function setAtividade($atividade): void {
        $this->atividade = $atividade;
    }

    public function setProvincia($provincia): void {
        $this->provincia = $provincia;
    }

    public function setMunicipio($municipio): void {
        $this->municipio = $municipio;
    }

    public function setComuna($comuna): void {
        $this->comuna = $comuna;
    }

    public function setNacionalidade($nacionalidade): void {
        $this->nacionalidade = $nacionalidade;
    }

    public function setMorada($morada): void {
        $this->morada = $morada;
    }

    public function setTelefone($telefone): void {
        $this->telefone = $telefone;
    }
    
    public function setEstadoC($estadoC): void {
        $this->estadoC = $estadoC;
    }
}

