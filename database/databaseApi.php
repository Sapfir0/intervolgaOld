<?php
include_once "database/student.php";

class StudentDB  {
    private $pdo;

    function __construct($username, $password, $dbname, $host="localhost", $dialect="mysql") {
        try {
            $dsn = "$dialect:dbname=$dbname;host=$host";
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        } finally {
            $this->createTableIfNotExists();
        }

    }

    private function createTableIfNotExists() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `studentdb`.`student` (
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
