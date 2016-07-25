<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 25.07.2016
 * Time: 13:30
 */
class Lieferant extends DatenbankEntity
{

    /**
     * Fügt dieses Objekt in die Datenbank
     * @return mixed
     */
    function db_insert()
    {
        if(is_null($this->dbConnection)){
            return "Die connection ist nicht aufgebaut!";
        }
    }

    /**
     * Aendert dieses Objekt innerhalb der Datenbank
     * @return mixed
     */
    function db_aendern()
    {
        // TODO: Implement db_aendern() method.
    }

    /**
     * Entfernt dieses Objekt aus der Datenbank
     * @return mixed
     */
    function db_delete()
    {
        // TODO: Implement db_delete() method.
    }
}