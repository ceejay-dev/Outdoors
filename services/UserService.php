<?php

include_once (__DIR__. '/../services/IUserService.php');
include_once (__DIR__. '/../repositories/UserRepository.php');

class UserService implements IUserService{
    private $userRepository;
    
    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    
    public function verificarLogin($username, $password) {
       $result = $this->userRepository->verificarLogin($username, $password);
       
       return $result;
   }
   
   public function getGestorId(){
       return $this->userRepository->getGestorId();
   }
   
   public function getClienteId(){
       return $this->userRepository->getClienteId();
   }

}
