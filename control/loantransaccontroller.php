<?php
include_once('../models/loantransacmodel.php');

// Initialize LoanTransacModel
$loanTransacModel = new LoanTransacModel();

// Fetch all loan transactions
$transactions = $loanTransacModel->getAllTransactionsWithLoanAmountAndMonths();
?>
