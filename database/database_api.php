<?php
include_once "database/country.php";


class CountryDB  {
    private $pdo;
    public $tableFullName = "`countriesdb`.`countries`";

    function __construct(Config $config) {
        try {
            $dsn = "$config->dialect:dbname=$config->dbname;host=$config->host";
            $this->pdo = new PDO($dsn, $config->username, $config->password);
            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        } finally {
            $this->createTableIfNotExists();
        }

    }

    private function createTableIfNotExists() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->tableFullName (
            `id` INT AUTO_INCREMENT PRIMARY KEY, 
            `name` VARCHAR(50) NOT NULL, 
            `capitalName` VARCHAR(20) NOT NULL);
            ");
    }

    function select() {
        $sql = "SELECT `id`, `name`, `capitalName` FROM $this->tableFullName;";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, "Country");
    }
    
    function insert(Country $countryInstance) {
        $sql = "INSERT INTO $this->tableFullName (`name`, `capitalName`) values (:name, :capitalName);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $countryInstance->name);
        $stmt->bindParam(':capitalName', $countryInstance->capitalName);
        $stmt->execute();
    }

    function delete(int $id) {
        $sql = "DELETE FROM $this->tableFullName WHERE id=:countryId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':countryId', $id);
        $stmt->execute();
    }
}
