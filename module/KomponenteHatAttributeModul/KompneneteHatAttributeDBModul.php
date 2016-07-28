<?php

/* 
 * Author: Alexander Burcev
 * 27-Jul-2016
 */
require_once(__DIR__ . "/../baseDbAdapter.php");

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
            $best->k_id = ($result["k_id"]);
            $best->kat_id = ($result["kat_id"]);
            $best->kha_wert = ($result["kha_wert"]);
            
            $KHAList[] = $best;
        }
        return $KHAList;
    }
    
    function getKATListByKHA($KHA)
    {
        $query = "SELECT * FROM komponentenattribute WHERE kat_id = " . $KHA->kat_id;
        $results = $this->execSQL($query); 
        $KATList = [];
        foreach ($results as $result)
        {
            $KAT = new KomponentenAttribute();
            $KAT->kat_id = $result["kat_id"];
            $KAT->kat_bezeichnung = $result["kat_bezeichnung"];
            
            $KATList[] = $KAT;
        }
        return $KATList;
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

