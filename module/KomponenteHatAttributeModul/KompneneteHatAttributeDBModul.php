<?php

/* 
 * Author: Alexander Burcev
 * 27-Jul-2016
 */

class KomponenteHatAttributeDbAdapter extends baseDbAdapter
{
    function __construct($user) 
    {
        parent::__construct($user);
    }
    
    function getAllKHA()
    {
        $KHAList = [];
        $query = "SELECT * FROM komponente_hat_attribute";
        $results = $this->execSQL($query);
        foreach ($results as $result)
        {
            $best = new KomponenteHatAttribute(); 
            $best->k_id = ($result["b_id"]);
            $best->kat_id = ($result["b_einkaufsdatum"]);
            $best->kha_wert = ($result["b_kaufbeleg"]);
            
            $KHAList[] = $best;
        }
        return $KHAList;
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
    
    function deleteKHAById($KAH)
    {
        $this->delete("komponente_hat_attribute", "k_id = " . $KAH->k_id);
    }
        
        
    function saveKAH($KAH)
    {
        $ID = $KAH->k_id;
        $select = "SELECT * FROM komponente_hat_attribute WHERE k_id = " . $ID;
        $results = $this->execSQL($select);
        $parameters[] = $KAH->kat_id;
        $parameters[] = $KAH->kha_wert;
        if(count($results) != 0)
        {           
            $this->update("komponente_hat_attribute", $parameters, "k_id = " . $ID);
        }
        else
        {
            $parameters[] = $KAH->k_id;
            $this->insert("komponente_hat_attribute", $parameters);
        }
    }
}

