<?php

namespace myLog;

require './vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use myLog\Settings;

/**
 * ログクラス
 * 
 * Monolog使用
 */
class Log {

    use Singleton; // trait

    const DEBUG = Logger::DEBUG;
    const INFO = Logger::INFO;
    const NOTICE = Logger::NOTICE;
    const WARNING = Logger::WARNING;
    const ERROR = Logger::ERROR;
    const CRITICAL = Logger::CRITICAL;
    const ALERT = Logger::ALERT;
    const EMERGENCY = Logger::EMERGENCY;

    private $logger;

    public static function getLogger(): Logger {
        return static::getInstance()->delayGetLogger();
    }

    /**
     * 遅延束縛関数
     */
    private function delayGetLogger(): Logger {
        if(!$this->logger) {
            $this->logger = $this->createLogger();
        }

        return $this->logger;
    }

    /**
     * loggerインスタンス作成関数
     */
    private function createLogger(): Logger {
        $logger = new Logger(Settings::NAME);
        $logger->pushHandler($this->getHandler());

        return $logger;
    }

    private function getHandler() {
        $handler = new StreamHandler(Settings::PATH.Settings::FILENAME, Settings::LEVEL);
        $handler->setFormatter($this->getFormatter());

        return $handler;
    }

    private function getFormatter() {
        $dateFormat = 'Y-n-d H:i:s';
        $format = "[%datetime%] %level_name%: %message% %context%\n";

        $formatter = new LineFormatter($format, $dateFormat);
        // スタックトレースを綺麗に表示するためのもの
        $formatter->includeStacktraces(true);

        return $formatter;
    }

    public static function debug(string $text, array $context = []) {
        static::getLogger()->debug($text, $context);
    }

    public static function info(string $text, array $context = []) {
        static::getLogger()->info($text, $context);
    }

    public static function nottice(string $text, array $context = []) {
        static::getLogger()->nottice($text, $context);
    }

    public static function warning(string $text, array $context = []) {
        static::getLogger()->warning($text, $context);
    }

    public static function error(string $text, array $context = []) {
        static::getLogger()->error($text, $context);
    }

    public static function critical(string $text, array $context = []) {
        static::getLogger()->critical($text, $context);
    }

    public static function alert(string $text, array $context = []) {
        static::getLogger()->alert($text, $context);
    }

    public static function emergency(string $text, array $context = []) {
        static::getLogger()->emergency($text, $context);
    }
}

?>