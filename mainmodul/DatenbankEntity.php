<?php

/**
 * superclass von allen Datentypen.
 * User: Kevin
 * Date: 25.07.2016
 * Time: 12:53
 */
abstract class DatenbankEntity
{
    private $error;

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