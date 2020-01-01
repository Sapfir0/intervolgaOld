<?php
include_once "./database/databaseApi.php";
include_once "./database/student.php";

function addStudent(StudentDB $db, string $name, string $group) {
    $student = new Student();
    $student->group = $group;
    $student->name = $name;

    $db->insert($student);

}


function deleteStudent($id) {

}