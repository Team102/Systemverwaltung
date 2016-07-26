<?php

/* 
 * Author: Alexander Burcev
 * 26-Jul-2016
 */

require("module/baseDbAdapter.php");
class funktionenDbAdapter extends baseDbAdapter
{
    function __construct($user) 
        {
            parent::__construct($user);
        }

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

        function getFunktionenById($funktionen)
        {
            $query = "SELECT * FROM functionen WHERE f_id = " . $funktionen->getK_ID();
            $results = $this->execSQL($query); 
            $result = $results[0];
            $func = new funktionen(); 
            $func->setF_ID($result["f_id"]);
            $func->setF_Bezeichnung($result["f_bezeichnung"]);
            $func->setF_Lesen($result["f_lesen"]);
            $func->setF_Neu($result["f_neu"]);
            $func->setF_Aendern($result["f_aendern"]);
            $func->setF_Loeschen($result["f_loeschen"]);
            $func->setF_Ausfuheren($result["F_ausfuehren"]);

            return $func;
        }

        function deleteFunctionSetById($funktionen)
        {
            $this->delete("functionen", "f_id = " . $funktionen->getF_ID());
        }


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