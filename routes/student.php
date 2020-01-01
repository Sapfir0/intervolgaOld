<?php
include_once "./database/databaseApi.php";
include_once "./database/student.php";

function addStudent($name, $group) {
    echo("$group $name");
    $student = new Student($name, $group);
    //$db = new studentDB();
    $pdo = new PDO('mysql:dbname=studentdb;host=localhost', 'studentCrud', '123456');

    $pdo->query("INSERT INTO `studentdb`.`student` (`name`, `group`) values ($name, $group);");
    //$db->insert($student);
}


function deleteStudent($id) {

}