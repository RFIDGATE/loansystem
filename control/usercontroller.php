<?php
require_once '../models/usermodel.php';
if(isset($_SESSION['id'])) {
    // User is logged in
    $userId = $_SESSION['id'];
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit;
}

?>
