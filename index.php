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
            $name = "ahahah";
            $group = "lol";
            try {
                echo("$name $group");
                $pdo = new PDO('mysql:dbname=studentdb;host=localhost', 'studentCrud', '123456');
                $stmt = $pdo->prepare("INSERT INTO `studentdb`.`student` (`name`, `group`) values (:name, :group);");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':group', $group);
                $stmt->execute();


            } catch (PDOException $e) {
                die($e->getMessage());

            }

            //addStudent($name, $group);
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