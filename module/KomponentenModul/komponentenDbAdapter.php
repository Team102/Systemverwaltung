<?php

/* 
 * Author: Alexander Burcev
 * 25-Jul-2016
 */

class kompnenentenDbAdapter extends baseDbAdapter
{
    function __construct($user) 
    {
        parent::__construct($user);
    }
    
    function getAllKomponenten()
    {
        $kompnenetenList = [];
        $query = "SELECT * FROM komponenten";
        $results = $this->execSQL($query);
        foreach ($results as $result)
        {
            $komp = new komponente(); 
            $komp->setB_ID($result["b_id"]);
            $komp->setL_ID($result["l_id"]);
            $komp->setR_ID($result["r_id"]);
            $komp->setK_Notitz($result["k_notitz"]);
            $komp->setK_Geweahrleistungen($result["k_gewaehrleistungen"]);
            $komp->setK_Hersteller($result["k_hersteller"]);
            $komp->setKAR_ID($result["kar_id"]);
            
            $kompnenetenList[] = $komp;
        }
        return $kompnenetenList;
    }
    
    function getKompneneteById($komponente)
    {
        $query = "SELECT * FROM komponenten WHERE k_id = " . $komponente->getK_ID();
        $results = $this->execSQL($query); 
        $result = $results[0];
        $komp = new komponente();
        $komp->setB_ID($result["b_id"]);
        $komp->setL_ID($result["l_id"]);
        $komp->setR_ID($result["r_id"]);
        $komp->setK_Notitz($result["k_notitz"]);
        $komp->setK_Geweahrleistungen($result["k_gewaehrleistungen"]);
        $komp->setK_Hersteller($result["k_hersteller"]);
        $komp->getKAR_ID($result["kar_id"]);
        return $komp;
    }
    
    function deleteKomponenteById($komponente)
    {
        $this->delete("kompnonenten", "k_id = " . $komponente->getK_ID());
    }
        
        
    function saveKomponente($kompnenete)
    {
        $ID = $kompnenete->getK_ID();
        $select = "SELECT * FROM komponenten WHERE k_id = " . $ID;
        $results = $this->execSQL($select);
        $parameters[] = $kompnenete->getR_ID();
        $parameters[] = $kompnenete->getL_ID;
        $parameters[] = $kompnenete->getB_ID();
        $parameters[] = $kompnenete->getK_Geweahrleistungen();
        $parameters[] = $kompnenete->getK_Hersteller();
        $parameters[] = $kompnenete->getKAR_ID();
        if(count($results) != 0)
        {           
            $this->update("komponenten", $parameters, "kar_id = " . $ID);
        }
        else
        {
            $this->insert("komponenten", $parameters);
        }
    }
}