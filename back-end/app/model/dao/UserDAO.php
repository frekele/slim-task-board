<?php
include_once './app/model/entity/User.php';
include_once './app/model/core/PDOFactory.php';

class UserDAO
{
    public function insert(User $user)
    {
        $query = "INSERT INTO users(name,login,password) VALUES (:name,:login,:password)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":login", $user->login);
        $stmt->bindParam(":password", $user->password);
        $stmt->execute();
        $user->id = $pdo->lastInsertId();
        return $user;
    }

    public function delete($id)
    {
        $query = "DELETE from users WHERE id=:id";
        $user = $this->findById($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $user;
    }

    public function update(User $user)
    {
        $query = "UPDATE users SET name=:name, login=:login, password=:password WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $user->id);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":login", $user->login);
        $stmt->bindParam(":password", $user->password);
        $stmt->execute();
        return $user;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM users';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $users = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $users[] = new User($row->id, $row->name, $row->login, $row->password);
        }
        return $users;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM users WHERE id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new User($result->id, $result->name, $result->login, $result->password);
    }

    public function findByLogin($login)
    {
        $query = 'SELECT * FROM users WHERE login=:login';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('login', $login);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return new User($result->id, $result->name, $result->login, $result->password);
    }
}