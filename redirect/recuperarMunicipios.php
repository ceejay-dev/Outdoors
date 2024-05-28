<?php

include_once ( __DIR__.'/../dbconfig/Dbconfig.php');


if (isset($_GET['provinciaNome'])) {
    $provinciaNome = $_GET['provinciaNome'];

    try {
        // Obtenha o ID da província com base no nome recebido
        $queryProvincia = 'SELECT idProvincia FROM provincias WHERE nomeProv = :provinciaNome';
        $stmtProvincia = Dbconfig::getInstance()->prepare($queryProvincia);
        $stmtProvincia->bindParam(':provinciaNome', $provinciaNome);
        $stmtProvincia->execute();
        $provinciaId = $stmtProvincia->fetch(PDO::FETCH_ASSOC)['idProvincia'];

        // Use o nome da província para buscar os municípios
        $queryMunicipio = 'SELECT * FROM municipios WHERE fk_provincia = :provincia';
        $stmtMunicipio = Dbconfig::getInstance()->prepare($queryMunicipio);
        $stmtMunicipio->bindParam(':provincia', $provinciaId);
        $stmtMunicipio->execute();

        $municipios = $stmtMunicipio->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($municipios);
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode([]);
    }
}   