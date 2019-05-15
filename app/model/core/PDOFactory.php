<?php

class PDOFactory
{
    private static $pdo;

    private static function getHerokuDsn()
    {
        $herokuDbStr = getenv('DATABASE_URL');
        $herokuDbStr = substr("$herokuDbStr", 11);
        $herokuDbStrUser = explode(":", $herokuDbStr);
        $herokuDbStrPort = explode("/", $herokuDbStrUser[2]);
        $herokuDbStrHost = explode("@", $herokuDbStrUser[1]);
        $dbPass = $herokuDbStrHost[0];
        $dbHost = $herokuDbStrHost[1];
        $dbPort = $herokuDbStrPort[0];
        $dbUser = $herokuDbStrUser[0];
        $dbName = $herokuDbStrPort[1];
        unset($herokuDbStrPort);
        unset($herokuDbStrUser);
        unset($herokuDbStrHost);
        unset($herokuDbStr);
        $dsn = "pgsql:host=" . $dbHost . ";dbname=" . $dbName . ";user=" . $dbUser . ";port=" . $dbPort . ";sslmode=require;password=" . $dbPass . ";";
        return $dsn;
    }

    private static function getLocalDevelopmentDsn()
    {
        $dbHost = "192.168.9.11";
        $dbName = "slim_task_board";
        $dbUser = "slim-user";
        $dbPass = "slim12345";
        $dbPort = "5432";
        $dsn = "pgsql:host=" . $dbHost . ";dbname=" . $dbName . ";user=" . $dbUser . ";port=" . $dbPort . ";password=" . $dbPass . ";";
        return $dsn;
    }

    public static function getConnection()
    {
        if (!isset($pdo)) {
            if (!getenv('DATABASE_URL')) {
                $dsn = PDOFactory::getLocalDevelopmentDsn();
            } else {
                $dsn = PDOFactory::getHerokuDsn();
            }

            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $pdo;
    }

}