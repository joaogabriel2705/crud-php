<?php 

namespace APP\Model;

use PDO;
use PDOException;

    class Connection {
        private static PDO $connection;

        public static function getConnection() {
            if (empty(self::$connection)) {
                try {
                    self::$connection = new PDO("mysql:host=localhost:3306; dbname=crud", "root", "");
                } catch (PDOException $e) {
                   throw new PDOException("Erro ao estabelecer uma conexão com banco de dados {$e->getMessage()}");
                }
            }

            return self::$connection;
        }
    }
?>