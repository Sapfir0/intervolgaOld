<?php
include_once './routes/student.php';
include_once "database/config.php";
include_once "./database/databaseApi.php";


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$config = new Config();
$db = new StudentDB($config->username, $config->password, $config->dbname);



switch ($requestUri) {
    case '/':
        require __DIR__ . '/views/index.html';
        break;
    case '/addStudent':
        if ($requestMethod == "POST") {
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
            $name = $input['name'];
            $group = $input['group'];
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