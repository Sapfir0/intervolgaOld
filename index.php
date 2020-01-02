<?php
include_once "./routes/api.php";
include_once "database/config.php";
include_once "./database/database_api.php";
include_once "./routes/pages.php";


$config = new Config();
$db = new StudentDB($config);
$router = new Router($db);

$requestUri = $_SERVER['REQUEST_URI'];

$requestApiRoutes= [
    '/getAllStudents' => "getAllStudents",
    '/addStudent' => "addStudent",
    '/deleteStudent' => "deleteStudent"
];

$requestPageRoutes = [
    '/' => getPage('/index.html'),
];

if (array_key_exists($requestUri, $requestApiRoutes) ) {
    call_user_func(array(&$router, $requestApiRoutes[$requestUri]));
}
else {
    getPage('/404.html');
}

