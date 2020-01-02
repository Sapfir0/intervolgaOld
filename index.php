<?php
include_once "./routes/api.php";
include_once "database/config.php";
include_once "./database/database_api.php";
include_once "./routes/pages.php";


$config = new Config();
$db = new CountryDB($config);
$router = new Router($db);

$requestUri = $_SERVER['REQUEST_URI'];

$requestApiRoutes= [
    '/getAllCountries' => "getAllCountries",
    '/addCountry' => "addCountry",
    '/deleteCountry' => "deleteCountry"
];

$requestPageRoutes = [
    '/' => "/index.html",
];

if (array_key_exists($requestUri, $requestApiRoutes)) {
    call_user_func(array(&$router, $requestApiRoutes[$requestUri]));
}
else if (array_key_exists($requestUri, $requestPageRoutes)) {
    getPage($requestPageRoutes[$requestUri]);
}
else {
    getPage('/404.html');
}

