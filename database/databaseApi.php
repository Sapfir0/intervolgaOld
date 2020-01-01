<?php
include_once "database/student.php";

class studentDB extends PDO {
//    private $pdo;
//
//    function __construct($dsn='mysql:dbname=studentdb;host=127.0.0.1') {
//        parent::__construct($dsn);
//        try {
//            $this->pdo = new PDO($dsn, 'root', '123456');
//        } catch (PDOException $e) {
//            print "Error!: " . $e->getMessage();
//            die();
//        } finally {
//            $this->createTableIfNotExists();
//        }
//
//    }

    private function createTableIfNotExists() {
        $pdo = new PDO('mysql:dbname=studentdb;host=127.0.0.1', 'root', '123456');
        $pdo->query("CREATE TABLE IF NOT EXISTS `studentdb`.`student` (
            `id` INT AUTO_INCREMENT PRIMARY KEY, 
            `name` VARCHAR(255) NOT NULL, 
            `group` VARCHAR(20) NOT NULL);
            ");
    }

    function select() {
        $pdo = new PDO('mysql:dbname=studentdb;host=127.0.0.1', 'root', '123456');
        $pdo->query("SELECT * FROM `studentdb`.`student`;");
    }
    
    function insert(Student $studentInstance) {
        $name = $studentInstance->name;
        $group = $studentInstance->group;
        $pdo = new PDO('mysql:dbname=studentdb;host=127.0.0.1', 'root', '123456');

        $pdo->query("INSERT INTO student (name, group) values ($name, $group);");
    }
}
