<?php
include_once './app/model/entity/User.php';
include_once './app/model/core/PDOFactory.php';

class UserDAO
{
    public function insert(User $user)
    {
        $query = "INSERT INTO slim_user(name,email,password) VALUES (:name,:email,:password)";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->execute();
        $user->id = $pdo->lastInsertId();
        return $user;
    }

    public function delete($id)
    {
        $query = "DELETE from slim_user WHERE id=:id";
        $user = $this->findById($id);
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $user;
    }

    public function update(User $user)
    {
        $query = "UPDATE slim_user SET name=:name, email=:email, password=:password WHERE id=:id";
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $user->id);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->execute();
        return $user;
    }

    public function findAll()
    {
        $query = 'SELECT * FROM slim_user';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $users = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $users[] = new User($row->id, $row->name, $row->email, $row->password);
        }
        return $users;
    }

    public function findById($id)
    {
        $query = 'SELECT * FROM slim_user WHERE id=:id';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return ((!$result) ? null : new User($result->id, $result->name, $result->email, $result->password));
    }

    public function findByEmail($email)
    {
        $query = 'SELECT * FROM slim_user WHERE email=:email';
        $pdo = PDOFactory::getConnection();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return ((!$result) ? null : new User($result->id, $result->name, $result->email, $result->password));
    }
}