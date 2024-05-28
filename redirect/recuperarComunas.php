<?php

require_once __DIR__.'/../dbconfig/Dbconfig.php';

if (isset($_GET['municipioNome'])) {
    $municipioNome = $_GET['municipioNome'];

    try {
        // Obtenha o ID da província com base no nome recebido
        $queryMunicipio = 'SELECT idMunicipio FROM municipios WHERE nomeMun = :municipioNome';
        $stmtMunicipio = Dbconfig::getInstance()->prepare($queryMunicipio);
        $stmtMunicipio->bindParam(':municipioNome', $municipioNome);
        $stmtMunicipio->execute();
        $municipioId = $stmtMunicipio->fetch(PDO::FETCH_ASSOC)['idMunicipio'];

        // Use o nome da província para buscar os municípios
        $queryComuna = 'SELECT * FROM comunas WHERE fk_municipio = :municipio';
        $stmtComuna = Dbconfig::getInstance()->prepare($queryComuna);
        $stmtComuna->bindParam(':municipio', $municipioId);
        $stmtComuna->execute();

        $comunas = $stmtComuna->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($comunas);
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode([]);
    }
}