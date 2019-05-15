<?php


class Column
{
    public $id;
    public $boardId;
    public $name;
    public $weight;

    //Only if Eager.
    public $board;
    public $tasks;

    function __construct($id, $boardId, $name, $weight, $board = null, $tasks = null)
    {
        $this->id = $id;
        $this->boardId = $boardId;
        $this->name = $name;
        $this->weight = $weight;
        $this->board = $board;
        $this->tasks = $tasks;
    }
}