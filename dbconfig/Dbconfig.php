<?php

class Dbconfig {

    private static $Db_con = null;

    public static function getInstance() {
        if (!isset(self::$Db_con)) {
            try {
                self:: $Db_con = new PDO("mysql:host=localhost; dbname=dbOutdoor", 'root', '');
                self::$Db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$Db_con;
    }

}
