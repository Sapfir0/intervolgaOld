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
            $name = $_REQUEST['name'];
            $group = $_REQUEST['group'];
            
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
        http_response_code(404);
        require __DIR__ . '/views/404.html';
        break;
} 