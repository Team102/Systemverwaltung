<?php

/* 
 * Author: Alexander Burcev
 * 26-Jul-2016
 */

require("module/baseDbAdapter.php");

/**
 * CRUD Modul fuer Funktionen
 */
class funktionenDbAdapter extends baseDbAdapter
{
     /**
     * Constructer
     * @param type $user der DB User fuer die Anmeldung an der Datenbank
     */
    function __construct($user) 
        {
            parent::__construct($user);
        }

        /**
         * Gibt alle Funktionsarten als Enttiy List zureck die sich in der Datenbank befinden
         * @return \Funktionen
         */
        function getAllFunctionSets()
        {
            $functionSetList = [];
            $query = "SELECT * FROM functionen";
            $results = $this->execSQL($query);
            foreach ($results as $result)
            {
                $func = new Funktionen(); 
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
         * @param type $Funktionen
         */
        function deleteFunctionSetById($Funktionen)
        {
            $this->delete("functionen", "f_id = " . $Funktionen->getF_ID());
        }


        /**
        * Speichert die uebergebne Funktion, entscheided automatisch ueber Updae oder neuem Insert
        * @param type $funktionen
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
        
        function GetFunctionListByUser($User)
        {
            $query = "SELECT * FROM functionen WHERE f_id = " . $User->be_rechte;
            $results = $this->execSQL($query);
            $result = $results[0];
            $func = new Funktionen();
            $func->f_aendern = $result["f_aendern"];
            $func->f_ausfuehren = $result['f_ausfuehren'];
            $func->f_bezeichnung = $result["f_bezeichnung"];
            $func->f_id = $result["f_id"];
            $func->f_lesen = $result["f_lesen"];
            $func->f_loeschen = $result["f_loeschen"];
            $func->f_neu = $result["f_neu"];
            
            return $func;
           
        }
        
}