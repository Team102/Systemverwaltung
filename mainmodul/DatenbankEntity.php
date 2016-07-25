<?php

/**
 * superclass von allen Datentypen.
 * User: Kevin
 * Date: 25.07.2016
 * Time: 12:53
 */
abstract class DatenbankEntity
{

    private $serverUrl = "http://serverUrl.com";
    private $error;
    public $dbConnection;
    /**
     * Verbindet sich mit der Datenbank
     * @param $user User Objekt
     * @return mixed int bei Erfolg String bei Misserfolg
     */
    function dbConnect($user){
        $this->dbConnection = mysqli_connect($this->serverUrl, $user->username, $user->password);
        if(is_null($this->dbConnection)){
            return "Es konnte keine Verbindung hergestellt werden Grund: " . mysqli_connect_error();
        }
        return 0;
    }

    /**
     * Fügt dieses Objekt in die Datenbank
     * @return mixed
     */
    abstract function db_insert();

    /**
     * Aendert dieses Objekt innerhalb der Datenbank
     * @return mixed
     */
    abstract function db_aendern();


    /**
     * Entfernt dieses Objekt aus der Datenbank
     * @return mixed
     */
    abstract function db_delete();

    /**
     * returnt das query
     * @param $query string der Query oder null für alles
     * @return mixed das ergebnis
     */
    abstract function db_select($query);

    /**
     * Schließt die Datenbank, falls eine geöffnete Verbindung vorhanden ist.
     */
    function dbClose(){
        if(!is_null($this->dbConnection)){
            mysqli_close($this->dbConnection);
        }
    }

    /**
     * @return bool if connected  or not
     */
    function isConnected(){
        return !is_null($this->dbConnection);
    }


    /**
     * setzt den error
     * @param $error mixed to set
     */
    function setError($error){
        $this->error = $error;
    }

    /**
     * @return mixed return von dem error
     */
    function getError(){
        return $this->error;
    }
}