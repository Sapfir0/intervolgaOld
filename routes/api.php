<?php
include_once "./database/database_api.php";
include_once "./database/student.php";

class Router {
    private $db;

    function __construct(StudentDB $db) {
        $this->db = $db;
    }

    function getBodyParams() {
        $inputJSON = file_get_contents('php://input');
        return json_decode($inputJSON, TRUE);
    }

    function addStudent() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $name = $body['name'];
            $group = $body['group'];

            $fixedGroup = htmlspecialchars($group);
            $fixedName = htmlspecialchars($name);

            $student = new Student();
            $student->group = $fixedGroup;
            $student->name = $fixedName;

            $this->db->insert($student);
        }
    }

    function deleteStudent() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $id = $body['id'];
            $this->db->delete($id);

        }
    }

    function getAllStudents() {
        $allStudents = $this->db->select();
        echo json_encode($allStudents);
    }
}


