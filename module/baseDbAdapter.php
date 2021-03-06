<?php

/** 
 * Author: Alexander Burcev
 * 25-Jul-2016
 * Dieses Modul ist die Basis fuer das fuellen von Entity objekten aus der Datenbank.
 * Wird an ubergoerdnete DB-Adapter vererbt
 */

require_once (__DIR__ . "/../database_entities/User.php");
//require_once ("database_entities/User.php");
class baseDbAdapter
{

    /**
     * @var PDO
     */
    private $dbConnection;
    private $serverUrl = "rdbms.strato.de";
//    private $serverUrl = "localhost";
    private $error;
    private $user;

    function __construct($user) {
        $this->user = $user;
        if(is_null($user)){
            $this->user = new User("U2648321", "schule12345");
        }
    }
    
    
    
    /**
     * Initialisierung und Verbindungsaufbau mit PDO
     * @return int Bei -1 Exception bei 0 Success
     * 
     */
    function dbConnect(){
        
        $this->dbConnection = new PDO("mysql:host=$this->serverUrl;dbname=DB2648321",  $this->user->username, $this->user->password);
//        $this->dbConnection = new PDO("mysql:host=$this->serverUrl;dbname=itv",  $this->user->username, $this->user->password);
        if(is_null($this->dbConnection)){
            /**return "Es konnte keine Verbindung hergestellt werden";*/
            return -1;
        }
        return 0;
    }
    
    /**
     * Diese Funktion sended die uebregebene Query an die Datenbank
     * @param string $query Die auszufuehrende Query als String
     * @return mixed Der Returnwert wird direkt von den Datebnak weitergeleitet, Select Queries
     * geben die Daten in einem Zweidimensionalem Array zurueck
     * Bei einem Fehler wird die Error Message in der $error Variable gespeichert und eine -1 int zurueckgegeben.
     */
    
    function execSQL($query)
    {
        try
        {
            $this->dbConnect();
            $statement = $this->dbConnection->prepare($query);
            echo $query;
            $statement->execute();
            $result = $statement->fetchAll();

            return $result;
        }
        catch (PDOException $ex)
        {
            $this->error = $ex->getMessage();
            echo $this->error;
            return -1;
        }
    }
    
/**
 * 
 * @param string $query Die Auszufuerende Query als String
 * @param mixed $entrys Uberegebene PArameter fuer die Query in einem Zweidmensionalem Array
 * geignet fuer die nutzung mit anonymen und fest vergebnene placeholdern
 * @return mixed Der Returnwert wird direkt von den Datebnak weitergeleitet, Select Queries
 * geben die Daten in einem Zweidimensionalem Array zurueck
 * Bei einem Fehler wird die Error Message in der $error Variable gespeichert und eine -1 int zurueckgegeben.
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
            $this->error = $ex->getMessage();
            return -1;
        }
    }
    
    /**
     * Diese Funktion initialisert eine Transaktion und gibt das ausfuehrende object zurueck.
     * Zur verwendung mit execTransactSQL
     * @return PDO PDO Verbindung
     */
    
    public function getTransact()
    {
        $this->dbConnect();
        $this->dbConnection->beginTransaction();
        return $this->dbConnection;
    }
    
    
    /**
     * Diese Funktion sended die uebergebenen Queries gegen das uebergebne PDO Object
     * zur verwendung mit getTransact()
     * @param PDO $PDO PDO Objekt
     * @param string $query Auszufuehrende Query als String
     * @param mixed $entrys Parameter fuer die Query, Optional!
     */
    
    public function execTransactSQL($PDO, $query, $entrys = null)
    {
            $statement = $PDO->prepare($query);
            if($entrys == null)
            {
                $statement->execute($entrys);
            }
            else
            {
                $statement->execute($entrys);
            }               
    }
    
    /**
     * Diese Funktion generiert eine Insert Query aus den uebergebenen Parametern 
     * fuer die im Tabellenamen uebergebenen Tabelle und fuehr diese aus.
     * Die Parameter werden gegen injection escaped
     * @param string $tablename Name der Tabelle
     * @param mixed $parameters Die zu verwendeten Parameter in Form von entities, der "key" wird als spaltenname
     * und die value als value genutzt.
     */
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
        return $this->dbConnection->lastInsertId();
    }
    
/**
 * Diese Funktion generiert eine escapede UPDATE Query aus den uebergenene Paremetern
 * @param string$tablename Name der Tabelle
 * @param mixed $parameters Die zu verwendeten Parameter in Form von entities, der "key" wird als spaltenname
 * und die value als value genutzt.
 * @param string $condition optionale WHERE condition
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
            $query = "UPDATE " . $tablename . " SET " . $updateValues . " WHERE 1=1 ";
        }
        else
        {
            $query = "UPDATE " . $tablename . " SET " . $updateValues . " WHERE " . $condition;
        }
        $this->execSQL($query);
    }
    
    /**
     * Diese Funktion generiert eine Delete query aus den uebrgebenen PArametern
     * @param string $tablename Name der Tabelle
     * @param string $where WHERE bedingung wie: 1=1
     */
    function delete($tablename, $where)
    {
        $query = "DELETE FROM " . $tablename . " WHERE " . $where;
        $this->execSQL($query);
    }

    /**
     * Gibt den letzten abgefangegen Fehler zurueck
     * @return string Exception
     */
    function getError(){
        return $this->error;
    }
}
