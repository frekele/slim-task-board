<?php


class Column
{
    public $id;
    public $boardId;
    public $name;
    public $weight;

    //Only if Eager.
    public $tasks;

    function __construct($id, $boardId, $name, $weight, $tasks = null)
    {
        $this->id = $id;
        $this->boardId = $boardId;
        $this->name = $name;
        $this->weight = $weight;
        $this->tasks = $tasks;
    }
}