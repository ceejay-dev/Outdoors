<?php


class Outdoor {
    //atributos
    private $idOutdoor;
    private $tipoOutdoor;
    private $preco;
    private $estado;
    private $provincia;
    private $municipio;
    private $comuna;
    
    //Construtor
    public function __construct() {
    }

    
    //Getters e setters
    public function getIdOutdoor() {
        return $this->idOutdoor;
    }

    public function getTipoOutdoor() {
        return $this->tipoOutdoor;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getEstado() {
        return $this->estado;
    }
    
    public function getProvinciaO() {
        return $this->provincia;
    }

    public function getMunicipioO() {
        return $this->municipio;
    }

    public function getComunaO() {
        return $this->comuna;
    }

    public function setIdOutdoor($idOutdoor): void {
        $this->idOutdoor = $idOutdoor;
    }

    public function setTipoOutdoor($tipoOutdoor): void {
        $this->tipoOutdoor = $tipoOutdoor;
    }

    public function setPreco($preco): void {
        $this->preco = $preco;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setProvinciaO($provincia): void {
        $this->provincia = $provincia;
    }

    public function setMunicipioO($municipio): void {
        $this->municipio = $municipio;
    }

    public function setComunaO($comuna): void {
        $this->comuna = $comuna;
    }

}
