<?php

include_once (__DIR__ . '/../dbConfig/DbConfig.php');
include_once (__DIR__ . '/../model/Provincias.php');

class ProvinciaRepository {

    private $db;

    public function __construct() {
        $this->db = Dbconfig::getInstance();
    }

    public function recuperarProvincias() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM provincias");
            $stmt->execute();
            
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $result['nomeProv'] . "'>" . $result['nomeProv'] . "</option>";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
