<?php


class Aluguer {
    //Atributos
    private $dataI;
    private $dataF;
    private $pagamento;
    private $nome_gestor;
    private $tipoDeOutdoor;
    private $provincia;
    private $municipio;
    private $comuna;
    
    //Construtor padrão
    public function __construct() {
        
    }
    
    //Getters e setters
    public function getDataI() {
        return $this->dataI;
    }

    public function getDataF() {
        return $this->dataF;
    }

    public function getPagamento() {
        return $this->pagamento;
    }

    public function getNome_gestor() {
        return $this->nome_gestor;
    }

    public function getTipoDeOutdoor() {
        return $this->tipoDeOutdoor;
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

    public function setDataI($dataI): void {
        $this->dataI = $dataI;
    }

    public function setDataF($dataF): void {
        $this->dataF = $dataF;
    }

    public function setPagamento($pagamento): void {
        $this->pagamento = $pagamento;
    }

    public function setNome_gestor($nome_gestor): void {
        $this->nome_gestor = $nome_gestor;
    }

    public function setTipoDeOutdoor($tipoDeOutdoor): void {
        $this->tipoDeOutdoor = $tipoDeOutdoor;
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



}
