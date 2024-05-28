<?php

include_once (__DIR__ . './User.php');

class Gestor extends User {
    //Atributos
    private $nome;
    private $provincia;
    private $municipio;
    private $comuna;
    private $morada;
    private $telefone;
    private $estado;

    //Construtor
    public function __construct() {
    }

    //Getters e setters
    public function getNome() {
        return $this->nome;
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

    public function getMorada() {
        return $this->morada;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
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

    public function setMorada($morada): void {
        $this->morada = $morada;
    }

    public function setTelefone($telefone): void {
        $this->telefone = $telefone;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }
}
