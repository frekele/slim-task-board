<?php

class Board
{
    public $id;
    public $name;
    public $description;

    //Only if Eager.
    public $columns;

    function __construct($id, $name, $description = null, $columns = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->columns = $columns;
    }
}