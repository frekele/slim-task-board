<?php


class Column
{
    public $id;
    public $boardId;
    public $name;
    public $weight;

    function __construct($id, $boardId, $name, $weight)
    {
        $this->id = $id;
        $this->boardId = $boardId;
        $this->name = $name;
        $this->weight = $weight;
    }
}