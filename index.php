<?php
include_once './routes/student.php';


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestUri) {
    case '/':
        require __DIR__ . '/views/index.html';
        break;
    case '/addStudent':
        if ($requestMethod == "POST") {
            $name = "s2";
            $group = "s";
            $l = $_REQUEST;
            addStudent($name, $group);

        }
        break;
    case '/deleteStudent':
        if ($requestMethod == "POST") {
            $id = $_REQUEST['id'];
            deleteStudent($id);
        }
        break;
    default:
        require __DIR__ . '/views/index.html';
        break;
} 