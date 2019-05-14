<?php

class User
{
    public $id;
    public $name;
    public $login;
    public $password;

    function __construct($id, $name, $login, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
    }
}