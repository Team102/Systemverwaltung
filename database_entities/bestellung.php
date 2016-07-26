<?php


/* 
 * Author: Alexander Burcev
 * 26-Jul-2016
 */


class bestellung
{

private $b_id;
private $b_einkaufsdatum;
private $b_kaufbeleg;

public function getB_ID()
{
    return $this->b_id;
}

public function setB_ID($b_id)
{
    $this->b_id = $b_id;
}

public function getB_Einkaufsdatum()
{
    return $this->b_einkaufsdatum;
}

public function setB_Einkaufsdatum($b_einkaufsdatum)
{
    $this->b_einkaufsdatum = $b_einkaufsdatum;
}

public function getB_Kaufbeleg()
{
    return $this->b_kaufbeleg;
}
  
public function setB_Kaufbeleg($b_kaufbeleg)
{
    $this->b_kaufbeleg = $b_kaufbeleg;
}

}