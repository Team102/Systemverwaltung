<?php

/* 
 * Author: Alexander Burcev
 * 25-Jul-2016
 */

class komponente
{
    public $k_id;
    public $k_bezeichnung;
    public $r_id;
    public $l_id;
    public $b_id;
    public $k_gewaehrleistungsdauer;
    public $k_notiz;
    public $k_hersteller;
    public $kar_id;

    /**
     * @return mixed
     */
    public function getKId()
    {
        return $this->k_id;
    }

    /**
     * @param mixed $k_id
     */
    public function setKId($k_id)
    {
        $this->k_id = $k_id;
    }

    /**
     * @return mixed
     */
    public function getRId()
    {
        return $this->r_id;
    }

    /**
     * @param mixed $r_id
     */
    public function setRId($r_id)
    {
        $this->r_id = $r_id;
    }

    /**
     * @return mixed
     */
    public function getLId()
    {
        return $this->l_id;
    }

    /**
     * @param mixed $l_id
     */
    public function setLId($l_id)
    {
        $this->l_id = $l_id;
    }

    /**
     * @return mixed
     */
    public function getBId()
    {
        return $this->b_id;
    }

    /**
     * @param mixed $b_id
     */
    public function setBId($b_id)
    {
        $this->b_id = $b_id;
    }

    /**
     * @return mixed
     */
    public function getKGewaehrleistungsdauer()
    {
        return $this->k_gewaehrleistungsdauer;
    }

    /**
     * @param mixed $k_gewaehrleistungsdauer
     */
    public function setKGewaehrleistungsdauer($k_gewaehrleistungsdauer)
    {
        $this->k_gewaehrleistungsdauer = $k_gewaehrleistungsdauer;
    }

    /**
     * @return mixed
     */
    public function getKNotiz()
    {
        return $this->k_notiz;
    }

    /**
     * @param mixed $k_notiz
     */
    public function setKNotiz($k_notiz)
    {
        $this->k_notiz = $k_notiz;
    }

    /**
     * @return mixed
     */
    public function getKHersteller()
    {
        return $this->k_hersteller;
    }

    /**
     * @param mixed $k_hersteller
     */
    public function setKHersteller($k_hersteller)
    {
        $this->k_hersteller = $k_hersteller;
    }

    /**
     * @return mixed
     */
    public function getKarId()
    {
        return $this->kar_id;
    }

    /**
     * @param mixed $kar_id
     */
    public function setKarId($kar_id)
    {
        $this->kar_id = $kar_id;
    }


    /**
     * @return mixed
     */
    public function getKBezeichnung()
    {
        return $this->k_bezeichnung;
    }

    /**
     * @param mixed $k_bezeichnung
     */
    public function setKBezeichnung($k_bezeichnung)
    {
        $this->k_bezeichnung = $k_bezeichnung;
    }

}