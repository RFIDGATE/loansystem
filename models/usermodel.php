<?php
include_once('config.php');

class UserModel {
    private $db;

    public function __construct() {
        // Get the existing database connection
        $this->db = Database::getInstance()->getConnection();
    }

    // Method to fetch user data by user ID
    public function getUserData($userId) {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            // Bind the parameter
            $stmt->bindParam(':id', $userId);
            // Execute the query
            $stmt->execute();
            // Fetch the user data as an associative array
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $userData;
        } catch(PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
