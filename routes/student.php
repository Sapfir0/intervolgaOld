<?php
include_once "./database/database_api.php";
include_once "./database/student.php";

function addStudent(StudentDB $db, string $name, string $group) {
    $fixedGroup = htmlspecialchars($group);
    $fixedName = htmlspecialchars($name);

    $student = new Student();
    $student->group = $fixedGroup;
    $student->name = $fixedName;

    $db->insert($student);

}


function deleteStudent(StudentDB $db, $id) {
    $db->delete($id);
}