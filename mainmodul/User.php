<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 25.07.2016
 * Time: 13:25
 */
class User
{
    public $username;
    public $password;

    public function User($username, $password){
        $this->username = $username;
        $this->password = $password;
    }
}