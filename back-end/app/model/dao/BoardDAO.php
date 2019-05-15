<?php
include_once './app/model/entity/Board.php';
include_once './app/model/core/PDOFactory.php';

class BoardDAO
{
    public function insert(Board $board)
    {
        $query = "INSERT INTO board(name,description) VALUES (:name,:description)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $board->name);
        $stmt->bindParam(":description", $board->description);
        $stmt->execute();
        $board->id = $pdo->lastInsertId();
        return $board;
    }

    public function delete($id)
    {
        $query = "DELETE from board WHERE id=:id";
        $board = $this->findById($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $board;
    }

    public function update(Board $board)
    {
        $query = "UPDATE board SET name=:name, description=:description WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $board->id);
        $stmt->bindParam(":name", $board->name);
        $stmt->bindParam(":description", $board->description);
        $stmt->execute();
        return $board;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM board';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $boards = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $boards[] = new Board($row->id, $row->name, $row->description);
        }
        return $boards;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM board WHERE id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new Board($result->id, $result->name, $result->description);
    }
}