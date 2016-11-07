<?php

namespace includes\libraries;

class Database
{

    private static $db;

    public static function getInstance()
    {
        if (null === self::$db) {
            try {
                self::$db = new \PDO("pgsql:dbname=" . DBNAME . ";host=". HOST . ";user=" . USER . ";password=" . PASSWORD . "");
                self::$db->exec("SET NAMES utf8");
            } catch (\PDOException $e) {
                var_dump($e);
                die();
            }
        }
        return self::$db;
    }
}