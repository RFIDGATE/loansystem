<?php
session_start(); // Start the session

include_once('../models/accounttypemodel.php');

// Initialize AccountTypeModel
$accountTypeModel = new AccountTypeModel();

// Fetch account type based on user ID from session
if(isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $accountType = $accountTypeModel->getAccountType($userId);

    // Determine which links to display based on account type
    if ($accountType == "Basic") {
        $links = [
            "<a href='loan.php'>Loans</a>",
            "<a href='billing.php'>Billing</a>",
            "<a href='account_details.php'>Account Details</a>"
        ];
    } elseif ($accountType == "Premium") {
        $links = [
            "<a href='loan.php'>Loans</a>",
            "<a href='savings.php'>Savings</a>",
            "<a href='money_back_earned.php'>Money Back Earned</a>",
            "<a href='billing.php'>Billing</a>",
            "<a href='account_details.php'>Account Details</a>"
        ];
    } else {
        // Default links if account type is not recognized
        $links = [];
    }

} else {
    // Redirect to login if user ID is not set
    header("Location: login.php");
    exit;
}
?>
