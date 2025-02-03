<?php
namespace App\Config;

class DbConnection{

    private static $pdo = null;

    public static function connect() {
        if(self::$pdo == null){
          
            try {
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
                $pdo = new \PDO($dsn, $user, $password);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$pdo = $pdo;
            } catch (\PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$pdo;
    }
}

?>