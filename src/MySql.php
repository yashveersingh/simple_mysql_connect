<?php

namespace yashveer;

final class MySql
{
    private $connection = null;

    function checkDriver()
    {
        if (function_exists('mysql_connect')) {
            return true;
        }
        return false;
    }

    function connect($host, $username, $password, $database)
    {
        $this->connection = mysql_connect($host, $username, $password);
        if (!$this->connection) {
            return "connection error (" . mysql_errno() . ") " . mysql_error();
        }
        $db_selected = mysql_select_db($database, $this->connection);
        if (!$db_selected) {
            return "cannot select database $database (" . mysql_errno() . ") " . mysql_error();
        }
        return null;
    }

    function query($sql)
    {
        $result = mysql_query($sql);
        if($result === false){
            return ['error'=>mysql_error()];
        }
        if($result === true){
            return ['success' => 'query execution successful'];
        }
        $ret = [];
        while ($row = mysql_fetch_assoc($result)){
            $ret[] = $row;
        }
        mysql_free_result($result);
        return $ret;
    }

}