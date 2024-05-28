<?php

class Provincias {
    //Atributos
    private $id;
    private $nomeProvincia;
    
    //Constructor
    public function __construct($id, $nomeProvincia) {
        $this->id = $id;
        $this->nomeProvincia = $nomeProvincia;
    }
    
    //Getters e setters
    public function getId() {
        return $this->id;
    }

    public function getNomeProvincia() {
        return $this->nomeProvincia;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNomeProvincia($nomeProvincia): void {
        $this->nomeProvincia = $nomeProvincia;
    }




}
