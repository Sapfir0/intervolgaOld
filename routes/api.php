<?php
include_once "./database/database_api.php";
include_once "./database/country.php";

/**
 * Class Router
 * Обслуживает роуты, понятно же.
 * Куча методов с неявной передачей аргументов в них. Неприемлимо.
 */
class Router {
    private $db;

    function __construct(CountryDB $db) {
        $this->db = $db;
    }

    function getBodyParams() {
        $inputJSON = file_get_contents('php://input');
        return json_decode($inputJSON, TRUE);
    }

    /**
     * Добавляет запись в БД.
     * @param string $name of country 
     * @param string $name of country's capital
     * @return None
     */
    function addCountry() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $name = $body['name'];
            $capitalName = $body['capitalName'];

            $fixedCapitalName = htmlspecialchars($capitalName);
            $fixedName = htmlspecialchars($name);

            $country = new Country();
            $country->capitalName = $fixedCapitalName;
            $country->name = $fixedName;

            $this->db->insert($country);
        }
    }

    /**
     * Удаляет страну по id из БД.
     * @param int $id of country
     * @return None
     */
    function deleteCountry() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $id = $body['id'];
            $this->db->delete($id);
        }
    }


    /**
     * Запрашивает список всех полей из БД
     * @echo список классов Country в json формате
     */
    function getAllCountries() {
        $allCountries = $this->db->select();
        echo json_encode($allCountries);
    }
}


