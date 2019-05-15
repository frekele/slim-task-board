<?php
include_once './app/model/entity/Column.php';
include_once './app/model/core/PDOFactory.php';

class ColumnDAO
{
    public function insert(Column $column)
    {
        $query = "INSERT INTO column(board_id,name,weight) VALUES (:boardId,:name,:weight)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":boardId", $column->boardId);
        $stmt->bindParam(":name", $column->name);
        $stmt->bindParam(":weight", $column->weight);
        $stmt->execute();
        $column->id = $pdo->lastInsertId();
        return $column;
    }

    public function delete($id)
    {
        $query = "DELETE from column WHERE id=:id";
        $column = $this->buscarPorId($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $column;
    }

    public function update(Column $column)
    {
        $query = "UPDATE column SET board_id=:boardId, name=:name, weight=:weight WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $column->id);
        $stmt->bindParam(":boardId", $column->boardId);
        $stmt->bindParam(":name", $column->name);
        $stmt->bindParam(":weight", $column->weight);
        $stmt->execute();
        return $column;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM column';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $columns = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $columns[] = new Column($row->id, $row->boardId, $row->name, $row->weight);
        }
        return $columns;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM column WHERE id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Column($result->id, $result->boardId, $result->name, $result->weight);
    }

    public function findByBoardId($boardId)
    {
        $query = 'SELECT * FROM column WHERE board_id=:boardId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('boardId', $boardId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Column($result->id, $result->boardId, $result->name, $result->weight);
    }
}