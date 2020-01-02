<?php
include_once "./routes/student.php";
include_once "database/config.php";
include_once "./database/database_api.php";


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$config = new Config();
$db = new StudentDB($config);


switch ($requestUri) {
    case '/':
        require __DIR__ . '/views/index.html';
        break;
    case '/getAllStudents':
        $allStudents = $db->select();
        echo json_encode($allStudents);
        break;
    case '/addStudent':
        if ($requestMethod == "POST") {
            $body = getBodyParams();
            $name = $body['name'];
            $group = $body['group'];
            addStudent($db, $name, $group);
        }
        break;
    case '/deleteStudent':
        if ($requestMethod == "POST") {
            $body = getBodyParams();
            $id = $body['id'];
            deleteStudent($db, $id);
        }
        break;
    default:
        require __DIR__ . '/views/404.html';
        break;
}


function getBodyParams() {
    $inputJSON = file_get_contents('php://input');
    return json_decode($inputJSON, TRUE);
}