<?php

class Paises {
    //atributos
    private $idPaises;
    private $nomePaises;
    
    //Construtor
    public function __construct($idPaises, $nomePaises) {
        $this->idPaises = $idPaises;
        $this->nomePaises = $nomePaises;
    }
    
    //Getters e setters
    public function getIdPaises() {
        return $this->idPaises;
    }

    public function getNomePaises() {
        return $this->nomePaises;
    }

    public function setIdPaises($idPaises): void {
        $this->idPaises = $idPaises;
    }

    public function setNomePaises($nomePaises): void {
        $this->nomePaises = $nomePaises;
    }


}
