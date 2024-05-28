<?php
include_once (__DIR__. '/../repositories/ProvinciaRepository.php');
class ProvinciaService {
    private $provinciarepository;
    
    public function __construct() {
        $this->provinciarepository = new ProvinciaRepository();
    }
    
    public function recuperarProvincias() {
        $result = $this->provinciarepository->recuperarProvincias();
        
        return $result;
    }
}
