<?php


namespace yashveer;


class Database
{
    const AUTO = 1;
    const MYSQLI = 2;
    const MYSQL = 3;

    private $db_name = null;
    private $db_username = null;
    private $db_password = null;
    private $db_host = null;
    private $type = null;
    private static $instance = null;
    private $connection = null;
    private $connection_error = null;

    private function __construct($db_name, $db_username, $db_password, $db_host, $type)
    {
        $this->db_name = $db_name;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
        $this->db_host = $db_host;
        $this->type = $type;
    }

    private static function showError($msg)
    {
        trigger_error($msg, E_USER_ERROR);
    }

    static function init($db_name, $db_username, $db_password, $db_host, $type = self::AUTO)
    {
        if (!in_array($type, [self::AUTO, self::MYSQL, self::MYSQLI])) {
            self::showError("select proper type (usage 'DATABASE::MYSQLI','DATABASE::MYSQL').");
        }
        self::$instance = new self($db_name, $db_username, $db_password, $db_host, $type);
        switch ($type) {
            case self::AUTO:
            case self::MYSQLI:
                self::$instance->connection = new MySqli();
                $check_driver = self::$instance->connection->checkDriver();
                if ($check_driver) {
                    break;
                }
            case self::MYSQL:
                self::$instance->connection = new MySql();
                $check_driver = self::$instance->connection->checkDriver();
                if ($check_driver) {
                    break;
                }
            default:
                self::showError("can't find any driver for database connection");
        }
        $check_driver = self::$instance->connection->checkDriver();
        if (!$check_driver) {
            self::showError("no driver found.");
        }
        $get_coonection = self::$instance->connection->connect($db_host, $db_username, $db_password, $db_name);
        if (!is_null($get_coonection)) {
            self::$instance->connection_error = $get_coonection;
            self::$instance->connection = null;
            //self::showError($get_coonection);
        }
    }

    static function get()
    {
        if (is_null(self::$instance)) {
            self::showError("first use Database:init() to initiate.");
        }
        return self::$instance;
    }

    function getError()
    {
        return $this->connection_error;
    }

    function rawQuery($sql)
    {
        $this->connection_error = null;
        $ret = $this->connection->query($sql);
        if (isset($ret['error'])) {
            $this->connection_error = $ret['error'];
            return null;
        }
        if (isset($ret['success'])) {
            return $ret['success'];
        }
        return $ret;
    }

}