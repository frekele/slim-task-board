<?php
include_once '../entity/Column.php';
include_once '../core/PDOFactory.php';

class ColumnDAO
{
    public function insert(Column $column)
    {
        $query = "INSERT INTO column(board_id,name) VALUES (:boardId,:name)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":boardId", $column->boardId);
        $stmt->bindParam(":name", $column->name);
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
        $query = "UPDATE column SET board_id=:boardId, name=:name WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $column->id);
        $stmt->bindParam(":boardId", $column->boardId);
        $stmt->bindParam(":name", $column->name);
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
            $columns[] = new Column($row->id, $row->boardId, $row->name);
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
        return new Column($result->id, $result->boardId, $result->name);
    }

    public function findByBoardId($boardId)
    {
        $query = 'SELECT * FROM column WHERE board_id=:boardId';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('boardId', $boardId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Column($result->id, $result->boardId, $result->name);
    }
}