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
        $query = 'SELECT t.*, u.name as assigned_user_name FROM slim_task t LEFT JOIN slim_user AS u ON t.assigned_user_id = u.id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->column_id, $row->name, $row->weight,
                $row->description, $row->assigned_user_id, $row->assigned_user_name);
        }
        return $tasks;
    }

    public function findById($id)
    {
        $query = 'SELECT t.*, u.name as assigned_user_name FROM slim_task t LEFT JOIN slim_user AS u ON t.assigned_user_id = u.id WHERE t.id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return ((!$result) ? null : new Task($result->id, $result->column_id, $result->name, $result->weight,
            $result->description, $result->assigned_user_id, $result->assigned_user_name));
    }

    public function findByColumnId($columnId)
    {
        $query = 'SELECT t.*, u.name as assigned_user_name FROM slim_task t LEFT JOIN slim_user AS u ON t.assigned_user_id = u.id WHERE t.column_id=:columnId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('columnId', $columnId);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->column_id, $row->name, $row->weight,
                $row->description, $row->assigned_user_id, $row->assigned_user_name);
        }
        return $tasks;
    }

    public function findByAssignedUserId($assignedUserId)
    {
        $query = 'SELECT t.*, u.name as assigned_user_name FROM slim_task t LEFT JOIN slim_user AS u ON t.assigned_user_id = u.id WHERE t.assigned_user_id=:assignedUserId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('assignedUserId', $assignedUserId);
        $stmt->execute();
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tasks[] = new Task($row->id, $row->column_id, $row->name, $row->weight,
                $row->description, $row->assigned_user_id, $row->assigned_user_name);
        }
        return $tasks;
    }
}