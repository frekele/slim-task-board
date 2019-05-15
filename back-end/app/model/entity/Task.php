<?php


class Task
{
    public $id;
    public $columnId;
    public $name;
    public $weight;
    public $description;
    public $assignedUserId;
    public $assignedUserName;


    function __construct($id, $columnId, $name, $weight, $description = null, $assignedUserId = null, $assignedUserName = null)
    {
        $this->id = $id;
        $this->columnId = $columnId;
        $this->name = $name;
        $this->weight = $weight;
        $this->description = $description;
        $this->assignedUserId = $assignedUserId;
        $this->assignedUserName = $assignedUserName;
    }
}