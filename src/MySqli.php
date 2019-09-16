<?php


namespace yashveer;


final class MySqli
{
    private $connection = null;

    function checkDriver()
    {
        if (function_exists('mysqli_connect')) {
            return true;
        }
        return false;
    }

    function connect($host, $username, $password, $database)
    {
        $this->connection = mysqli_connect($host, $username, $password, $database);
        if (!$this->connection) {
            return "connection error (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
        }
        return null;
    }

    function query($sql)
    {
        $result = mysqli_query($this->connection,$sql);
        if($result === false){
            return ['error'=>mysqli_error($this->connection)];
        }
        if($result === true){
            return ['success' => 'query execution successful'];
        }
        $ret = [];
        while ($row = $result->fetch_assoc()){
            $ret[] = $row;
        }
        $result->close();
        return $ret;
    }

}