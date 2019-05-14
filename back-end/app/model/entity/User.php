<?php

class User
{
    public $id;
    public $fullName;
    public $username;
    public $password;

    function __construct($id, $fullName, $username, $password)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->username = $username;
        $this->password = $password;
    }
}