<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/views/index.html';
        break;
    case '/addStudent':
        break;
    case '/deleteStudent':
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
} 