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
    
    function getAllKompnonenten()
    {
        $kompnenetenList = [[]];
        $query = "SELECT * FROM komponenten";
        $results = $this->execSQL($query);
        foreach ($results as $result)
        {
            $komp = new komponente(); 
            $komp->setB_ID($result["b_id"]);
            $komp->setL_ID($result["l_id"]);
            $komp->setR_ID($result["r_id"]);

        }
    }
}