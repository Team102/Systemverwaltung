<?php

/* 
 * Author: Alexander Burcev
 * 25-Jul-2016
 */

class komponente
{
    private $r_id;
    private $l_id;
    private $b_id;
    private $k_gewaehrleistungsdauer;
    private $k_notitz;
    private $k_hersteller;
    private $kar_id;
    
    public function getR_ID()
    {
        return $this->r_id;
    }
    public function setR_ID($r_id)
    {
        $this->r_id = $r_id;
    }
    
    public function getL_ID()
    {
        return $this->l_id;
    }
    public function setL_ID($l_id)
    {
        $this->l_id = $l_id;
    }
    
    public function getB_ID()
    {
        return $this->b_id;
    }
    public function setB_ID($b_id)
    {
        $this->b_id = $b_id;
    }
    
    public function getK_Geweahrleistungen()
    {
        return $this->k_gewaehrleistungsdauer;
    }
    public function setK_Geweahrleistungen($k_gewaehrleistungsdauer)
    {
        $this->k_gewaehrleistungsdauer = $k_gewaehrleistungsdauer;
    }
    
    public function getK_Notitz()
    {
        return $this->k_notitz;
    }
    public function setK_Notitz($k_notitz)
    {
        $this->k_notitz = $k_notitz;
    }
    
    public function getK_Hersteller()
    {
        return $this->k_hersteller;
    }
    public function setK_Hersteller($k_hersteller)
    {
        $this->k_hersteller = $k_hersteller;
    }
    public function getKAR_ID()
    {
        return $this->kar_id;
    }
    public function setKAR_ID($kar_id)
    {
        $this->kar_id = $kar_id;
    }
}