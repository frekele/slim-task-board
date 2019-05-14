<?php
include_once '../entity/Board.php';
include_once '../core/PDOFactory.php';

class BoardDAO
{
    public function insert(User $board)
    {
        $query = "INSERT INTO board(name,login,password) VALUES (:name,:login,:password)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $board->name);
        $stmt->bindParam(":login", $board->login);
        $stmt->bindParam(":password", $board->password);
        $stmt->execute();
        $board->id = $pdo->lastInsertId();
        return $board;
    }

    public function delete($id)
    {
        $query = "DELETE from board WHERE id=:id";
        $board = $this->buscarPorId($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $board;
    }

    public function update(User $board)
    {
        $query = "UPDATE board SET name=:name, login=:login, password=:password WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $board->id);
        $stmt->bindParam(":name", $board->name);
        $stmt->bindParam(":login", $board->login);
        $stmt->bindParam(":password", $board->password);
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
            $boards[] = new Users($row->id, $row->name, $row->login, $row->password);
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
        return new User($result->id, $result->name, $result->login, $result->password);
    }

    public function findByLogin($login)
    {
        $query = 'SELECT * FROM board WHERE login=:login';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('login', $login);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new User($result->id, $result->name, $result->login, $result->password);
    }
}