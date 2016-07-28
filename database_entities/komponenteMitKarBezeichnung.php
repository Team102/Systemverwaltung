<?php

/**
 * Erweitert die komponente um ein weiteres Feld unzwar die KOMPONENTENART Bezeichnung
 *
 * @author = Kevin Kekule
 */
require_once __DIR__ ."/komponente.php";
class komponenteMitKarBezeichnung extends komponente
{

    private $kar_bezeichnung;

    /**
     * kopiert die komponente.
     * @param $komponente komponente
     */
    function __construct($komponente)
    {
        $this->setKId($komponente->getKId());
        $this->setKBezeichnung($komponente->getKBezeichnung());
        $this->setLId($komponente->getLId());
        $this->setBId($komponente->getBId());
        $this->setRId($komponente->getRId());
        $this->setKarId($komponente->getKarId());
        $this->setKHersteller($komponente->getKHersteller());
        $this->setKGewaehrleistungsdauer($komponente->getKGewaehrleistungsdauer());
        $this->setKNotiz($komponente->getKNotiz());
    }


    /**
     * @return mixed
     */
    public function getKarBezeichnung()
    {
        return $this->kar_bezeichnung;
    }

    /**
     * @param mixed $kar_bezeichnung
     */
    public function setKarBezeichnung($kar_bezeichnung)
    {
        $this->kar_bezeichnung = $kar_bezeichnung;
    }


}