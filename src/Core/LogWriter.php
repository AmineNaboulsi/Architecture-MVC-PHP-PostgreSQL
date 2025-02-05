<?php
namespace App\Core;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class LogWriter {
    public static $log;
    public static function startLog() {
        $log = new Logger('app');
        $log->pushHandler(new StreamHandler(($_SERVER["DOCUMENT_ROOT"] . '/logs/app.log'), Level::Warning));
        self::$log = $log;
    }
    public static function info(string $message) {
        if(self::$log==null) self::startLog();
        self::$log->info($message);
    }
    public static function warning(string $message) {
        if(self::$log==null) self::startLog();
        self::$log->info($message);
    }
    public static function error(string $message) {
        if(self::$log==null) self::startLog();
        self::$log->error($message);
    }
}


?>