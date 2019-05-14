<?php


class Task
{
    public $id;
    public $columnId;
    public $name;
    public $description;
    public $assignedUserId;

    function __construct($id, $columnId, $name, $description, $assignedUserId)
    {
        $this->id = $id;
        $this->columnId = $columnId;
        $this->name = $name;
        $this->description = $description;
        $this->assignedUserId = $assignedUserId;

    }
}