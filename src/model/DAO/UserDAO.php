<?php

namespace APP\Model\DAO;

use APP\Model\Connection;
use APP\Model\User;
use PDO;
use PDOException;

class UserDAO
{
    private static PDO $connection;

    public static function save(User $user) : void
    {
        self::$connection = Connection::getConnection();
        $sql = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";

        try {
            $statement = self::$connection->prepare($sql);
            $statement->bindParam(1, $user->getName(), PDO::PARAM_STR);
            $statement->bindParam(2, $user->getEmail(), PDO::PARAM_STR);
            $statement->bindParam(3, $user->getPassword(), PDO::PARAM_STR);

            $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao cadastrar o usuário: " . $e->getMessage());
        }
    }

    public static function update(User $user) : bool
    {
        self::$connection = Connection::getConnection();
        $sql = "UPDATE user SET name = ?, email = ?, password = ? WHERE id_user = ?";

        try {
            $statement = self::$connection->prepare($sql);
            $statement->bindParam(1, $user->getName(), PDO::PARAM_STR);
            $statement->bindParam(2, $user->getEmail(), PDO::PARAM_STR);
            $statement->bindParam(3, $user->getPassword(), PDO::PARAM_STR);
            $statement->bindParam(4, $user->getId(), PDO::PARAM_INT);

            return $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao atualizar o usuário: " . $e->getMessage());
        }
    }

    public static function delete(int $id) : void
    {
        self::$connection = Connection::getConnection();
        $sql = "DELETE FROM user WHERE id_user = ?";

        try {
            $statement = self::$connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao deletar o usuário: " . $e->getMessage());
        }
    }

    public static function getUserById(int $id_user)
    {
        self::$connection = Connection::getConnection();
        $sql = "SELECT * FROM user WHERE id_user = ?";

        try {
            $statement = self::$connection->prepare($sql);
            $statement->bindParam(1, $id_user, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erro ao tentar encontrar o usuário: " . $e->getMessage());
        }

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() : array
    {
        self::$connection = Connection::getConnection();
        $sql = "SELECT * FROM user";

        try {
            $statement = self::$connection->query($sql);
        } catch (PDOException $e) {
            throw new PDOException("Erro ao tentar encontrar todos os usuários: " . $e->getMessage());
        }

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findUserByEmail(string $email)
    {
        self::$connection = Connection::getConnection();

        $sql = "SELECT * FROM user WHERE email = '$email'";

        try {
            $statement = self::$connection->query($sql);
        } catch (PDOException $e) {
            throw new PDOException("Erro ao tentar encontrar o usuário: " . $e->getMessage());
        }
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>