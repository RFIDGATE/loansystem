<?php
session_start();
include_once('../models/loanmodel.php');
include_once('../models/loantransacmodel.php');
include_once('../models/paymentmodel.php'); // Include the Payment Model

class LoanController {
    private $loanModel;
    private $loanTransacModel;
    private $paymentModel; // Instance of Payment Model

    public function __construct() {
        $this->loanModel = new LoanModel();
        $this->loanTransacModel = new LoanTransacModel();
       
    }

    public function applyLoan($amount, $duration) {
        // Validate loan amount
        if ($amount < 5000 || $amount > 10000) {
            return "Loan amount must be between 5000 and 10000";
        } elseif ($amount % 1000 !== 0) {
            return "Loan amount must be in increments of 1000";
        } else {
            // Calculate interest and deduct 3%
            $interest = $amount * 0.03;
            $amount -= $interest;

            // Apply for loan
            $loanId = $this->loanModel->applyLoan($_SESSION['id'], $amount, $duration); // Get the Loan ID

            if ($loanId) {
                // Record a transaction for the loan application
                $this->loanTransacModel->recordTransaction($loanId, $_SESSION['id'], 'LoanApplication', date('Y-m-d H:i:s'), 'Pending', 'Loan application submitted');
                return true;
            } else {
                return false;
            }

        }
    }
    
    public function getLoansByUserId($userId) {
        return $this->loanModel->getLoansByUserId($userId);
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize LoanController
    $loanController = new LoanController();

    // Validate form inputs
    $amount = $_POST["amount"];
    $duration = $_POST["duration"];

    // Apply for loan
    $result = $loanController->applyLoan($amount, $duration);
    if ($result === true) {
        echo "Loan application submitted successfully";
        header("Location: ../view/loan.php");
        exit();
    } else {
        echo "Failed to submit loan application. Error: " . $result;
    }
    
}
?>
