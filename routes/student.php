<?php
include_once "./database/databaseApi.php";
include_once "./database/student.php";

function addStudent($name, $group) {
    $student = new Student($name, $group);

    $db->insert($student);

}


function deleteStudent($id) {

}