<?php


class Task
{
    public $id;
    public $columnId;
    public $name;
    public $weight;
    public $description;
    public $assignedUserId;

    //Only if Eager.
    public $column;
    public $assignedUser;

    function __construct($id, $columnId, $name, $weight, $description = null, $assignedUserId = null, $column = null, $assignedUser = null)
    {
        $this->id = $id;
        $this->columnId = $columnId;
        $this->name = $name;
        $this->weight = $weight;
        $this->description = $description;
        $this->assignedUserId = $assignedUserId;
        $this->column = $column;
        $this->assignedUser = $assignedUser;

    }
}