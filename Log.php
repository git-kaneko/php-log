<?php

namespace myLog;

require './vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use myLog\Settings;

// デフォルトがUTCなので日本時間へ
date_default_timezone_set("Asia/Tokyo");

/**
 * ログクラス
 * 
 * Monolog使用
 */
class Log {

    const DEBUG = Logger::DEBUG;
    const INFO = Logger::INFO;
    const NOTICE = Logger::NOTICE;
    const WARNING = Logger::WARNING;
    const ERROR = Logger::ERROR;
    const CRITICAL = Logger::CRITICAL;
    const ALERT = Logger::ALERT;
    const EMERGENCY = Logger::EMERGENCY;

    private $logger;

    private function getLogger(): Logger {
        return $this->createLogger();
    }

    /**
     * loggerインスタンス作成関数
     */
    private function createLogger(): Logger {

        if(isset($this->logger)) {
            $this->logger;
        }

        $this->logger = new Logger(Settings::NAME);
        $this->logger->pushHandler($this->getHandler());

        return $this->logger;
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

    public function debug(string $text, array $context = []) {
        $this->getLogger()->debug($text, $context);
    }

    public function info(string $text, array $context = []) {
        $this->getLogger()->info($text, $context);
    }

    public function notice(string $text, array $context = []) {
        $this->getLogger()->notice($text, $context);
    }

    public function warning(string $text, array $context = []) {
        $this->getLogger()->warning($text, $context);
    }

    public function error(string $text, array $context = []) {
        $this->getLogger()->error($text, $context);
    }

    public function critical(string $text, array $context = []) {
        $this->getLogger()->critical($text, $context);
    }

    public function alert(string $text, array $context = []) {
        $this->getLogger()->alert($text, $context);
    }

    public function emergency(string $text, array $context = []) {
        $this->getLogger()->emergency($text, $context);
    }
}

?>