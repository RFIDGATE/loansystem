<?php
include_once('../models/registrationmodel.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance of the RegistrationModel
    $registrationModel = new RegistrationModel();

    // Call the registerUser method with the form data
    $registrationModel->registerUser($_POST);
    
    // Redirect to the login page after registration
    header("Location: ../view/login.php");
    exit(); 
}
?>
