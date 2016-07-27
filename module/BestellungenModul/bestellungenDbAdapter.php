<?php

/* CRUD Modul fuer Bestellungen
 * Author: Alexander Burcev
 * 26-Jul-2016
 */

require_once("module/baseDbAdapter.php");

class bestellungDbAdapter extends baseDbAdapter
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
     * Hohlt eine Liste Aller in der Tabelle bestellungen gespeicherten rows
     * @return \bestellung Rows Bestellungen
     */
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
    
    /**
     * Gibt alle Kompneneten als Liste zurueck die mit der Bestellung in Verbindung stehen
     * @param type $bestellung
     * @return \komponente
     */  
    function GetKomponentenFromBestellung($bestellung)
    {
        $query = "SELECT * FROM komponenten WHERE b_id = " . $bestellung->getB_ID();
        $results = $this->execSQL($query); 
        $result = $results[0];
        $KompnenentenList = [];
        foreach ($results as $result)
        {
            $komp = new komponente();
            $komp->setK_ID($result["k_id"]);
            $komp->setB_ID($result["b_id"]);
            $komp->setL_ID($result["l_id"]);
            $komp->setR_ID($result["r_id"]);
            $komp->setK_Notitz($result["k_notitz"]);
            $komp->setK_Geweahrleistungen($result["k_gewaehrleistungen"]);
            $komp->setK_Hersteller($result["k_hersteller"]);
            $komp->getKAR_ID($result["kar_id"]);
            $KompnenentenList[] =  $komp;
        }
        return $KompnenentenList;
    }   
    
    /**
     * Loescht uebergebene Bestellung aus der Datenbank
     * @param type $bestellung
     */
    function deleteBestellungById($bestellung)
    {
        $this->delete("bestellungen", "b_id = " . $bestellung->getB_ID());
    }
        
    /**
     * Speichert die uebergebne Bestellung, entscheided automatisch ueber Updae oder neuem Insert
     * @param type $bestellung
     */
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
