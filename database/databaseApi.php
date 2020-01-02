<?php
include_once "database/student.php";


class StudentDB  {
    private $pdo;
    public $tableFullName = "`studentdb`.`student`";

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
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->tableFullName (
            `id` INT AUTO_INCREMENT PRIMARY KEY, 
            `name` VARCHAR(50) NOT NULL, 
            `group` VARCHAR(20) NOT NULL);
            ");
    }

    function select() {
        $sql = "SELECT `id`, `name`, `group` FROM $this->tableFullName;";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, "Student");
    }
    
    function insert(Student $studentInstance) {
        $sql = "INSERT INTO $this->tableFullName (`name`, `group`) values (:name, :group);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $studentInstance->name);
        $stmt->bindParam(':group', $studentInstance->group);
        $stmt->execute();
    }

    function delete(int $id) {
        $sql = "DELETE FROM $this->tableFullName WHERE id=:studentId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':studentId', $id);
        $stmt->execute();
    }
}
