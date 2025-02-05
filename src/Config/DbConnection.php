<?php
namespace App\Config;
use Dotenv\Dotenv;
class DbConnection{

    private static $pdo = null;

    public static function connect() {
        if(self::$pdo == null){
            $dotenv = Dotenv::createImmutable(realpath($_SERVER['DOCUMENT_ROOT'] . '/../'));
            $dotenv->load();
            $host = $_ENV['HOST'];
            $port = $_ENV['PORT'];
            $dbname = $_ENV['DB'];
            $user = $_ENV['USER'];
            $password = $_ENV['PASSWORD'];
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