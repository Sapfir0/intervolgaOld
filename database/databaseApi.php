<?php
include_once "database/student.php";

class studentDB extends PDO {
    private $pdo;

    function __construct($dsn='mysql:dbname=studentdb;host=127.0.0.1') {
        parent::__construct($dsn);
        try {
            $this->pdo = new PDO($dsn, 'root', '123456');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        } finally {
            $this->createTableIfNotExists();
        }

    }

    private function createTableIfNotExists() {
        $this->pdo->query("CREATE TABLE IF NOT EXISTS student(name string, group string);");
    }

    function select() {
        $this->pdo->query("SELECT * FROM student;");
    }
    
    function insert(Student $studentInstance) {
        $name = $studentInstance->name;
        $group = $studentInstance->group;
        $this->pdo->query("INSERT INTO student (name, group) values ($name, $group);");
    }
}
