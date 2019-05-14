<?php
include_once '../entity/Task.php';
include_once '../core/PDOFactory.php';

class TaskDAO
{
    public function insert(Task $task)
    {
        $query = "INSERT INTO task(column_id,name,description,assigned_user_id) VALUES (:columnId,:name,:description,:assignedUserId)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":columnId", $task->columnId);
        $stmt->bindParam(":name", $task->name);
        $stmt->bindParam(":description", $task->description);
        $stmt->bindParam(":assignedUserId", $task->assignedUserId);
        $stmt->execute();
        $task->id = $pdo->lastInsertId();
        return $task;
    }

    public function delete($id)
    {
        $query = "DELETE from task WHERE id=:id";
        $task = $this->buscarPorId($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $task;
    }

    public function update(Task $task)
    {
        $query = "UPDATE task SET column_id=:columnId, name=:name, description=:description, assigned_user_id=:assignedUserId WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $task->id);
        $stmt->bindParam(":columnId", $task->columnId);
        $stmt->bindParam(":name", $task->name);
        $stmt->bindParam(":description", $task->description);
        $stmt->bindParam(":assignedUserId", $task->assignedUserId);
        $stmt->execute();
        return $task;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM task';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->columnId, $row->name, $row->description, $row->assignedUserId);
        }
        return $tasks;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM task WHERE id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Task($result->id, $result->columnId, $result->name, $result->description, $result->assignedUserId);
    }

    public function findByColumnId($columnId)
    {
        $query = 'SELECT * FROM task WHERE column_id=:columnId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('columnId', $columnId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Task($result->id, $result->columnId, $result->name, $result->description, $result->assignedUserId);
    }

    public function findByAssignedUserId($assignedUserId)
    {
        $query = 'SELECT * FROM task WHERE assigned_user_id=:assignedUserId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('assignedUserId', $assignedUserId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Task($result->id, $result->columnId, $result->name, $result->description, $result->assignedUserId);
    }
}