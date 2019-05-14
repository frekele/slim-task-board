<?php


class Column
{
    public $id;
    public $boardId;
    public $name;

    function __construct($id, $boardId, $name)
    {
        $this->id = $id;
        $this->boardId = $boardId;
        $this->name = $name;
    }
}