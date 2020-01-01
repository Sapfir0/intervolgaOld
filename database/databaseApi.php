<?php
include_once "database/student.php";


class StudentDB  {
    private $pdo;

    function __construct(Config $config) {
        try {
            $dsn = "$config->dialect:dbname=$config->dbname;host=$config->host";
            $this->pdo = new PDO($dsn, $config->username, $config->password);
            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

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
        $sth = $this->pdo->prepare("SELECT `id`, `name`, `group` FROM `studentdb`.`student`;");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, "Student");
    }
    
    function insert(Student $studentInstance) {
        $stmt = $this->pdo->prepare("INSERT INTO `studentdb`.`student` (`name`, `group`) values (:name, :group);");
        $stmt->bindParam(':name', $studentInstance->name);
        $stmt->bindParam(':group', $studentInstance->group);
        $stmt->execute();
    }
}
