<?php
include_once('config.php');

class LoginModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function authenticateUser($username, $password) {
        // Check if the user exists in the users table
        $userData = $this->getUserData($username, $password, 'users');
        if ($userData) {
            return $userData; // User found, return user data
        }

        // Check if the user exists in the admin table
        $adminData = $this->getUserData($username, $password, 'admin');
        if ($adminData) {
            return $adminData; // Admin found, return admin data
        }

        // Neither user nor admin found
        return false;
    }

    private function getUserData($username, $password, $table) {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password is correct
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data
        } else {
            return false; // User not found or password incorrect
        }
    }
}
?>
