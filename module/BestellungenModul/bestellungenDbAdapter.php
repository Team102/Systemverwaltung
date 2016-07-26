<?php

/* 
 * Author: Alexander Burcev
 * 26-Jul-2016
 */

class bestellungDbAdapter extends baseDbAdapter
{
    function __construct($user) 
    {
        parent::__construct($user);
    }
    
    function getAllBestellungen()
    {
        $bestellungenList = [];
        $query = "SELECT * FROM bestellungen";
        $results = $this->execSQL($query);
        foreach ($results as $result)
        {
            $best = new bestellung(); 
            $best->setB_ID($result["b_id"]);
            $best->setB_Einkaufsdatum($result["b_einkaufsdatum"]);
            $best->setB_Kaufbeleg($result["b_kaufbeleg"]);
            
            $bestellungenList[] = $best;
        }
        return $bestellungenList;
    }
    
    function getBestellungById($bestellung)
    {
        $query = "SELECT * FROM bestellungen WHERE b_id = " . $bestellung->getB_ID();
        $results = $this->execSQL($query); 
        $result = $results[0];
        $best = new bestellung(); 
        $best->setB_ID($result["b_id"]);
        $best->setB_Einkaufsdatum($result["b_einkaufsdatum"]);
        $best->setB_Kaufbeleg($result["b_kaufbeleg"]);
            
        return $best;
    }
    
    function deleteBestellungById($bestellung)
    {
        $this->delete("bestellungen", "b_id = " . $bestellung->getB_ID());
    }
        
        
    function saveBEstellung($bestellung)
    {
        $ID = $bestellung->getB_ID();
        $select = "SELECT * FROM bestellungen WHERE b_id = " . $ID;
        $results = $this->execSQL($select);
        $parameters[] = $bestellung->getB_Einkaufsdatum_ID();
        $parameters[] = $bestellung->getB_Kaufbeleg();
        if(count($results) != 0)
        {           
            $this->update("bestellungen", $parameters, "kar_id = " . $ID);
        }
        else
        {
            $this->insert("bestellungen", $parameters);
        }
    }
}
