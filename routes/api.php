<?php
include_once "./database/database_api.php";
include_once "./database/country.php";

class Router {
    private $db;

    function __construct(CountryDB $db) {
        $this->db = $db;
    }

    function getBodyParams() {
        $inputJSON = file_get_contents('php://input');
        return json_decode($inputJSON, TRUE);
    }

    function addCountry() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $name = $body['name'];
            $group = $body['group'];

            $fixedGroup = htmlspecialchars($group);
            $fixedName = htmlspecialchars($name);

            $country = new Country();
            $country->group = $fixedGroup;
            $country->name = $fixedName;

            $this->db->insert($country);
        }
    }

    function deleteCountry() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $id = $body['id'];
            $this->db->delete($id);

        }
    }

    function getAllCountries() {
        $allCountries = $this->db->select();
        echo json_encode($allCountries);
    }
}


