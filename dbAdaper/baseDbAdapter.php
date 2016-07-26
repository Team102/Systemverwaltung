<?php

/* 
 * Author: Alexander Burcev
 * 25-Jul-2016
 */



class baseDbAdapter
{
    
    private $dbConnection;
    private $serverUrl = "http://serverUrl.com";
    private $error;
    private $user;

    function __construct($user) {
        $this->user = $user;
    }
    
    function dbConnect(){
        
        $this->dbConnection = new PDO("mysql:host=$this->serverUrl;dbname=itv",  $this->user->username, $this->user->password);
        if(is_null($this->dbConnection)){
            return "Es konnte keine Verbindung hergestellt werden Grund: " . mysqli_connect_error();
        }
        return 0;
    }
    
    function execSQL($query)
    {
        try
        {
            $this->dbConnect();
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $ex)
        {
            $this->$error = $ex->getMessage();
            return -1;
        }
    }
    
    /*
     * Diese function wird auch als selct verwendet da sie ein array mit key value pairs ausliefert
     */
    
    function execSQLParameters($query, $entrys)
    {
        try
        {
            $this->dbConnect(); 
            $statement = $this->dbConnection->prepare($query);
            $statement->execute($entrys);
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $ex)
        {
            $error = $ex->getMessage();
            return $error;
        }
    }
    
    
    
    function insert($tablename, $parameters)
    {
        $names = "";
        $values = "";
        foreach($parameters as $key => $value)
        {
            $names = $names . " " . $key . ",";
            $values = $values . " '" . $value . "',";
        }
        $names = substr($names, 0, (strlen($names)-1));
        $values = substr($values, 0, (strlen($values)-1));
        $query = "INSERT INTO " . $tablename . " (" . $names . ") VALUES (" . $values .")";
        $this->execSQL($query);
    }
    
    /*
     * update funktion erwartet condition als optinalen parameter
     */
    
    function update($tablename, $parameters, $condition = null)
    {
        $updateValues = "";
        foreach($parameters as $key => $value)
        {
            $updateValues = $updateValues. $key . " = '" . $value . "',";
        }
        $updateValues = substr($updateValues, 0, (strlen($updateValues)-1));
        if($condition == null)
        {
            $query = "UPDATE " . $tablename . "SET " . $updateValues . "WHERE 1=1 ";
        }
        else
        {
            $query = "UPDATE " . $tablename . "SET " . $updateValues . "WHERE " . $condition;
        }
        $this->execSQL($query);
    }
    function delete($tablename, $where)
    {
        $query = " DELETE FROM " . $tablename . "WHERE " . $where;
        $this->execSQL($query);
    }

    function getError(){
        return $this->error;
    }
}