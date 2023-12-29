<?php
    class Connexion{
        /**
         * @var PDO
         */
        public $pdo;

        public function __construct(){
            global $database;
            global $username;
            global $password;
            try {
                $dsn = "mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=$database";
                $this->pdo = new PDO($dsn, $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e);
            }
        }

    }

