<?php

class PDOFactory
{
    private static $pdo;

    public static function getConnection()
    {
        if (!isset($pdo)) {
            $host = "192.168.9.11";
            $dbName = "demo-slim";
            $dbUser = "demo-slim-user";
            $dbPass = "demo123456";
            $connection = "pgsql:dbname=$dbName;host=$host";
            $pdo = new PDO($connection, $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $pdo;
    }

}