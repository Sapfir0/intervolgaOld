<?php
include_once "./database/databaseApi.php";
include_once "./database/student.php";

function addStudent($name, $group) {
    echo("$group $name");
    $student = new Student($name, $group);
    $db = new studentDB(); // TODO некорректно
    $db->insert($student);

}


function deleteStudent($id) {

}