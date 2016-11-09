<?php
/**
 * Created by PhpStorm.
 * User: JRW2252
 * Date: 11/8/16
 * Time: 6:36 PM
 */
declare(strict_types=1);

namespace JRW\MySQL;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\ChromePHPHandler;

class SystemLogger implements Loggable
{
    private $loggers = [];
    private $dataLogger;
    private $errorLogger;
    private $consoleLogger;
    private $message;

    /**
     * @param $loggerName
     * @return array [Logger]
     * @throws \Exception
     */

    public function initLogger(string $loggerName)
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $infoStream = new StreamHandler($path . $loggerName . '_data.log', Logger::INFO);
        $errorStream = new StreamHandler($path . $loggerName . '_error.log', Logger::ERROR);
        $consoleStream = new ChromePHPHandler();

        $dLogger = new Logger('data_' . $loggerName);
        $dLogger->pushHandler($infoStream);
        $dLogger = $dLogger->withName('data_'. $loggerName);

        $eLogger = new Logger('error_' . $loggerName);
        $eLogger->pushHandler($errorStream);
        $dLogger = $dLogger->withName('error_'. $loggerName);

        $cLogger = new Logger('console_'.$loggerName);
        $cLogger->pushHandler($consoleStream);
        $dLogger = $dLogger->withName('console_'. $loggerName);

        $this->dataLogger = $dLogger;
        $this->errorLogger = $eLogger;
        $this->consoleLogger = $cLogger;

        $this->loggers = [$cLogger, $eLogger, $cLogger];
        return $this->loggers;
    }

    /**
     * @param $method
     * @param $data
     */
    public function logData($method, $data)
    {
        $logger = $this->getDataLogger();
        $this->message = 'caller: ' . $method;
        if (is_array($data)) {
        } else {
            $data = [$data];
        }
        $logger->addInfo($this->message, $data);
    }

    /**
     * @param $method
     * @param $error
     */
    public function logError($method, $error)
    {
        $logger = $this->getErrorLogger();
        $this->message = 'caller: ' . $method;
        if (is_array($error)) {
        } else {
            $error = [$error];
        }
        $logger->addError($this->message, $error);
    }

    /**
     * @param $method
     * @param $data
     */
    public function logConsole($method, $data)
    {
        $logger = $this->getConsoleLogger();
        $this->message = 'caller: ' . $method;
        if (is_array($data)) {
        } else {
            $data = [$data];
        }
        $logger->addInfo($this->message, $data);
    }

    /**
     * @return mixed
     */
    public function getDataLogger()
    {
        return $this->dataLogger;
    }

    /**
     * @return mixed
     */
    public function getErrorLogger()
    {
        return $this->errorLogger;
    }

    /**
     * @return mixed
     */
    public function getConsoleLogger()
    {
        return $this->consoleLogger;
    }

    /**
     * @return array
     */
    public function getAllLoggers()
    {
        return $this->loggers;
    }
}