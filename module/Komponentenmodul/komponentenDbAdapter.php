<?php

/* 
 * Author: Alexander Burcev
 * 25-Jul-2016
 */

require_once(__DIR__ . "/../baseDbAdapter.php");
require_once(__DIR__ . "/../Komponentenarten/KomponentenartenDBAdapter.php");
require_once(__DIR__ . "/../../database_entities/KomponentenArten.php");
require_once(__DIR__ . "/../../database_entities/komponenteMitKarBezeichnung.php");

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
            $komp->setKId($result["k_id"]);
            $komp->setKBezeichnung($result["k_bezeichnung"]);
            $komp->setBId($result["b_id"]);
            $komp->setLId($result["l_id"]);
            $komp->setRId($result["r_id"]);
            $komp->setKNotiz($result["k_notitz"]);
            $komp->setKGewaehrleistungsdauer($result["k_gewaehrleistungen"]);
            $komp->setKHersteller($result["k_hersteller"]);
            $komp->setKarId($result["kar_id"]);
            
            $kompnenetenList[] = $komp;
        }
        return $kompnenetenList;
    }

    /**
     * @param $komponente komponente
     * @return komponente komponente
     */
    function getKompneneteById($komponente)
    {
        $query = "SELECT * FROM komponenten WHERE k_id = " . $komponente->getKId();
        $results = $this->execSQL($query); 
        $result = $results[0];
        $komp = new komponente();
        $komp->setKBezeichnung($result["k_bezeichnung"]);
        $komp->setBId($result["b_id"]);
        $komp->setLId($result["l_id"]);
        $komp->setRId($result["r_id"]);
        $komp->setKNotiz($result["k_notitz"]);
        $komp->setKGewaehrleistungsdauer($result["k_gewaehrleistungen"]);
        $komp->setKHersteller($result["k_hersteller"]);
        $komp->setKarId($result["kar_id"]);
        return $komp;
    }

    /**
     * @param $komponente komponente
     */
    function deleteKomponenteById($komponente)
    {
        $id = $komponente->getKId();
        $this->delete("komponenten", "k_id = " . $id);
        echo "NICE!";
    }


    /**
     * @param $kompnenete komponente
     */
    function saveKomponente($kompnenete)
    {
        $ID = $kompnenete->getKId();
        $select = "SELECT * FROM komponenten WHERE k_id = " . $ID;
        $results = $this->execSQL($select);
        $parameters[] = $kompnenete->getKId();
        $parameters[] = $kompnenete->getLId();
        $parameters[] = $kompnenete->getBId();
        $parameters[] = $kompnenete->getKGewaehrleistungsdauer();
        $parameters[] = $kompnenete->getKHersteller();
        $parameters[] = $kompnenete->getKarId();
        if(count($results) != 0)
        {           
            $this->update("komponenten", $parameters, "kar_id = " . $ID);
        }
        else
        {
            $this->insert("komponenten", $parameters);
        }
    }

    /**
     * Selektiert alle Komponente anhand einer Raum id
     * @param $raumId int der Raum in dem die Komponente sind
     * @return array|komponente aus dem raum mit der $raumId;
     */
    public function getKomponentenByRaum($raumId){
        $kompnenetenList = [];
        $query = "SELECT * FROM komponenten WHERE r_id = $raumId";
        $results = $this->execSQL($query);
        foreach ($results as $result)
        {
            $komp = new komponente();
            $komp->setKId($result["k_id"]);
            $komp->setKBezeichnung($result["k_bezeichnung"]);
            $komp->setBId($result["b_id"]);
            $komp->setLId($result["l_id"]);
            $komp->setRId($result["r_id"]);
            $komp->setKNotiz($result["k_notitz"]);
            $komp->setKGewaehrleistungsdauer($result["k_gewaehrleistungen"]);
            $komp->setKHersteller($result["k_hersteller"]);
            $komp->setKarId($result["kar_id"]);

            $kompnenetenList[] = $komp;
        }
        return $kompnenetenList;
    }

    /**
     * Fügt in jede Komponente die bezeichnung aus der komponentenartentabelle hinzu
     * @param $alleKomponenten array|komponente
     * @return array|komponenteMitKarBezeichnung
     */
    public function insertKompoKarBezeichnung($alleKomponenten)
    {
        $alleKompMitKompArtBezeichnung = array();
        $kompartCrud = new KomponentenartenDBAdapter(null);
        foreach($alleKomponenten as $komponente){
            //selektiere als erstes die komponentenArt
            $komponentenArt = $kompartCrud->selectKomponentenartById($komponente->getKarId());
            //erstelle eine komponente die die komponente erweitert um das Feld Komponentenart Bezeichnung
            $komponentenMitKompArtBezeichnung = new komponenteMitKarBezeichnung($komponente);
            //setze die Komponentenart Bezeichnung mithilfe des Selects, dass wir vorher ausgeführt haben
            $komponentenMitKompArtBezeichnung->setKarBezeichnung($komponentenArt->kar_bezeichnung);
            //adde dieses zum array
            $alleKompMitKompArtBezeichnung[] = $komponentenMitKompArtBezeichnung;
        }
        return $alleKompMitKompArtBezeichnung;
    }
}