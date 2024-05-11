<?php
include_once('../models/LoginModel.php');

// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginModel = new LoginModel();
    $userData = $loginModel->authenticateUser($username, $password);

    if ($userData) {
        if ($userData['status'] === 'pending') {
            echo "Your account is pending verification by the admin. Please wait for approval.";
        } else {
            $_SESSION['id'] = $userData['id'];
            if ($userData['role'] === 'admin') {
                header("Location: ../view/admindashboard.php");
                exit();
            } else {
                header("Location: ../view/userdashboard.php");
                exit();
            }
        }
    } else {
        echo "Invalid username or password.";
    }

}
?>
