<?php
/**
 * Created by PhpStorm.
 * User: JRW2252
 * Date: 11/8/16
 * Time: 6:33 PM
 */

namespace JRW\MySQL;


interface Loggable
{
    /**
     * @param $loggerName string
     * @return mixed
     */
    public function initLogger(string $loggerName);

    /**
     * @param $method __METHOD__
     * @param $data array || string
     * @return mixed
     */
    public function logData($method, $data);

    /**
     * @param $method __METHOD__
     * @param $error array || string
     * @return mixed
     */
    public function logError($method, $error);

    /**
     * @param $method __METHOD__
     * @param $data array || string
     * @return mixed
     */
    public function logConsole($method, $data);
}