<?php


class Task
{
    public $id;
    public $columnId;
    public $name;
    public $weight;
    public $description;
    public $assignedUserId;

    function __construct($id, $columnId, $name, $weight, $description, $assignedUserId)
    {
        $this->id = $id;
        $this->columnId = $columnId;
        $this->name = $name;
        $this->weight = $weight;
        $this->description = $description;
        $this->assignedUserId = $assignedUserId;

    }
}