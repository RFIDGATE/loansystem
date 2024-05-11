<?php


class Database {
    private $connection;
    private static $instance;

    private function __construct() {

        $this->connection = new PDO('mysql:host=localhost;dbname=loansystem', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
