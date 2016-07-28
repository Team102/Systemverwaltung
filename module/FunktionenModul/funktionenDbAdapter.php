<?php

/* 
 * Author: Alexander Burcev
 * 26-Jul-2016
 */

require_once(__DIR__ . "/../baseDbAdapter.php");
/**
 * CRUD Modul fuer Funktionen
 */
class funktionenDbAdapter extends baseDbAdapter
{
     /**
     * Constructer
     * @param User $user der DB User fuer die Anmeldung an der Datenbank
     */
    function __construct($user) 
        {
            parent::__construct($user);
        }

        /**
         * Gibt alle Funktionsarten als Enttiy List zureck die sich in der Datenbank befinden
         * @return array|funktionen
         */
        function getAllFunctionSets()
        {
            $functionSetList = [];
            $query = "SELECT * FROM functionen";
            $results = $this->execSQL($query);
            foreach ($results as $result)
            {
                $func = new funktionen(); 
                $func->setF_ID($result["f_id"]);
                $func->setF_Bezeichnung($result["f_bezeichnung"]);
                $func->setF_Lesen($result["f_lesen"]);
                $func->setF_Neu($result["f_neu"]);
                $func->setF_Aendern($result["f_aendern"]);
                $func->setF_Loeschen($result["f_loeschen"]);
                $func->setF_Ausfuheren($result["F_ausfuehren"]);

                $functionSetList[] = $func;
            }
            return $functionSetList;
        }
        
        /**
         * Loscht die uebergebne Funktion aus der Datenbank
         * @param funktionen $funktionen
         */
        function deleteFunctionSetById($funktionen)
        {
            $this->delete("functionen", "f_id = " . $funktionen->getF_ID());
        }


        /**
        * Speichert die uebergebne Funktion, entscheided automatisch ueber Updae oder neuem Insert
        * @param funktionen $funktionen
        */
        function saveFunctionenSet($funktionen)
        {
            $ID = $funktionen->getF_ID();
            $select = "SELECT * FROM functionen WHERE f_id = " . $ID;
            $results = $this->execSQL($select);
            $parameters[] = $funktionen->getF_Bezeichnung();
            $parameters[] = $funktionen->getF_Lesen;
            $parameters[] = $funktionen->getF_Neu();
            $parameters[] = $funktionen->getF_Aendern();
            $parameters[] = $funktionen->getF_Loeschen();
            $parameters[] = $funktionen->getF_Ausfuehren();
            if(count($results) != 0)
            {           
                $this->update("functionen", $parameters, "f_id = " . $ID);
            }
            else
            {
                $this->insert("functionen", $parameters);
            }
        }
}