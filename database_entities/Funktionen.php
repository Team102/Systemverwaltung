<?php

/* 
 * Author: Alexander Burcev
 * 26-Jul-2016
 */

class Funktionen
{
    public $f_id;
    public $f_bezeichnung;
    public $f_lesen;
    public $f_neu;
    public $f_aendern;
    public $f_loeschen;
    public $f_ausfuehren;
    
    
    public function getF_ID()
    {
        return $this->f_id;
    }
    
    public function setF_ID($f_id)
    {
        $this->f_id = $f_id;
    }
     
    public function getF_Bezeihnung()
    {
        return $this->f_bezeichnung;
    }
    
    public function setF_Bezeichnung($f_bezeichnung)
    {
        $this->f_bezeichnung = $f_bezeichnung;
    }
    
    public function getF_Lesen()
    {
        return $this->f_lesen;
    }
    
    public function setF_Lesen($f_lesen)
    {
        $this->f_lesen = $f_lesen;
    }

    public function getF_Neu()
    {
        return $this->f_neu;
    }
    
    public function setF_Neu($f_neu)
    {
        $this->f_neu = $f_neu;
    }
    
    public function getF_Aendern()
    {
        return $this->f_aendern;
    }
    
    public function setF_Aendern($f_aendern)
    {
        $this->f_aendern = $f_aendern;
    }
       
    public function getF_Loeschen()
    {
        return $this->f_loeschen;
    }
    
    public function setF_Loeschen($f_loeschen)
    {
        $this->f_loeschen = $f_loeschen;
    }
    
    public function getF_Ausfuehren()
    {
        return $this->f_ausfuehren;
    }
    
    public function setF_Ausfuheren($f_ausfuehren)
    {
        $this->f_ausfuehren = $f_ausfuehren;
    }
}