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
    
    
    function dbConnect($user){
        
        $this->dbConnection = new PDO("mysql:host=$serverUrl;dbname=itv",  $user->username, $user->password);
        if(is_null($this->dbConnection)){
            return "Es konnte keine Verbindung hergestellt werden Grund: " . mysqli_connect_error();
        }
        return 0;
    }
    
    function execSQL($query)
    {
        try
        {
            dbConnect();
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $ex)
        {
            $error = $ex->getMessage();
            return $error;
        }
    }
    
    /*
     * Diese function wird auch als selct verwendet da sie ein array mit key value pairs ausliefert
     */
    
    function execSQLParameters($query, $entrys)
    {
        try
        {
            dbConnect();
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
        $names;
        $values;
        foreach($parameters as $key => $value)
        {
            $names + " " + $key + ",";
            $values = " '" + $value + "',";            
        }
        $names = substr($names, 0, (strlen($names)-1));
        $values = substr($values, 0, (strlen($values)-1));
        $query = "INSERT INTO " + $tablename + " (" + $names + ") VALUES (" + $values +")";
        execSQL($query);
    }
    
    /*
     * update funktion erwartet condition als optinalen parameter
     */
    
    function update($tablename, $parameters, $condition = null)
    {
        $updateValues;
        foreach($parameters as $key => $value)
        {
            $updateValues + $key + " = '" + $value + "',";
        }
        $updateValues = substr($updateValues, 0, (strlen($updateValues)-1));
        if($condition == null)
        {
            $query = "UPDATE " + $tablename + "SET " + $updateValues + "WHERE 1=1 ";
        }
        else
        {
            $query = "UPDATE " + $tablename + "SET " + $updateValues + "WHERE " + $condition;
        }
        execSQL($query);
    }
    function delete($tablename, $where)
    {
        $query = " DELETE FROM " + $tablename + "WHERE " + $where;
        execQuery($query);
    }
}