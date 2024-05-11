<?php
include_once('config.php');

class AccountTypeModel {
    private $db;

    public function __construct() {
        // Get the existing database connection
        $this->db = Database::getInstance()->getConnection();
    }

    // Method to fetch the account type by user ID
    public function getAccountType($userId) {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("SELECT account_type FROM users WHERE id = :id");
            // Bind the parameter
            $stmt->bindParam(':id', $userId);
            // Execute the query
            $stmt->execute();
            // Fetch the account type
            $accountType = $stmt->fetchColumn();
            return $accountType;
        } catch(PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
