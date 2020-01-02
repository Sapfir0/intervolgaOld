<?php


function getPage($pageName) {
    $base = $_SERVER['DOCUMENT_ROOT'] . '/views';
    require $base . $pageName;
}