<?php
include_once "./database/database_api.php";
include_once "./database/country.php";

/**
 * Class Router
 * Обслуживает роутеры, понятно же.
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
     * @param $name of country
     * @param $capital of country
     * @return None
     */
    function addCountry() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $body = $this->getBodyParams();
            $name = $body['name'];
            $capital = $body['capital'];

            $fixedCapital = htmlspecialchars($capital);
            $fixedName = htmlspecialchars($name);

            $country = new Country();
            $country->capital = $fixedCapital;
            $country->name = $fixedName;

            $this->db->insert($country);
        }
    }

    /**
     * Удаляет страну по id из БД.
     * @param $id of country
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


