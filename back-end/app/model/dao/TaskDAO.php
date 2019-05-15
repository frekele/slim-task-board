<?php
include_once './app/model/entity/Task.php';
include_once './app/model/core/PDOFactory.php';

class TaskDAO
{
    public function insert(Task $task)
    {
        $query = "INSERT INTO slim_task(column_id,name,weight,description,assigned_user_id) VALUES (:columnId,:name,:weight,:description,:assignedUserId)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":columnId", $task->columnId);
        $stmt->bindParam(":name", $task->name);
        $stmt->bindParam(":weight", $task->weight);
        $stmt->bindParam(":description", $task->description);
        $stmt->bindParam(":assignedUserId", $task->assignedUserId);
        $stmt->execute();
        $task->id = $pdo->lastInsertId();
        return $task;
    }

    public function delete($id)
    {
        $query = "DELETE from slim_task WHERE id=:id";
        $task = $this->findById($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $task;
    }

    public function update(Task $task)
    {
        $query = "UPDATE slim_task SET column_id=:columnId, name=:name, weight=:weight, description=:description, assigned_user_id=:assignedUserId WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $task->id);
        $stmt->bindParam(":columnId", $task->columnId);
        $stmt->bindParam(":name", $task->name);
        $stmt->bindParam(":weight", $task->weight);
        $stmt->bindParam(":description", $task->description);
        $stmt->bindParam(":assignedUserId", $task->assignedUserId);
        $stmt->execute();
        return $task;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM slim_task';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->columnId, $row->name, $row->weight, $row->description, $row->assignedUserId);
        }
        return $tasks;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM slim_task WHERE id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Task($result->id, $result->columnId, $result->name, $result->weight, $result->description, $result->assignedUserId);
    }

    public function findByColumnId($columnId)
    {
        $query = 'SELECT * FROM slim_task WHERE column_id=:columnId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('columnId', $columnId);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->columnId, $row->name, $row->weight, $row->description, $row->assignedUserId);
        }
        return $tasks;
    }

    public function findByAssignedUserId($assignedUserId)
    {
        $query = 'SELECT * FROM slim_task WHERE assigned_user_id=:assignedUserId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('assignedUserId', $assignedUserId);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->columnId, $row->name, $row->weight, $row->description, $row->assignedUserId);
        }
        return $tasks;
    }
}