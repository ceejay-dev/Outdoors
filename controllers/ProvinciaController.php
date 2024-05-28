<?php
include_once (__DIR__. '/../services/ProvinciaService.php');
class ProvinciaController {
    private $provinciaService;
    
    public function __construct() {
        $this->provinciaService = new ProvinciaService();
    }
    
    public function recuperarProvincias() {
        $result = $this->provinciaService->recuperarProvincias();
        
        return $result;
    }
    
}
