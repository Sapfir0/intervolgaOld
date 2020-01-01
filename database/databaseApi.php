<?php
include_once "database/student.php";

class studentDB  {
    private $pdo;

    function __construct($dsn='mysql:dbname=studentdb;host=127.0.0.1') {
        try {
            $this->pdo = new PDO($dsn, 'studentCrud', '123456');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        } finally {
            $this->createTableIfNotExists();
        }

    }

    private function createTableIfNotExists() {
        $this->pdo->query("CREATE TABLE IF NOT EXISTS `studentdb`.`student` (
            `id` INT AUTO_INCREMENT PRIMARY KEY, 
            `name` VARCHAR(255) NOT NULL, 
            `group` VARCHAR(20) NOT NULL);
            ");
    }

    function select() {
        $this->pdo->query("SELECT * FROM `studentdb`.`student`;");
    }
    
    function insert(Student $studentInstance) {
        $stmt = $this->pdo->prepare("INSERT INTO `studentdb`.`student` (`name`, `group`) values (:name, :group);");
        $stmt->bindParam(':name', $studentInstance->name);
        $stmt->bindParam(':group', $studentInstance->group);
        $stmt->execute();
    }
}
