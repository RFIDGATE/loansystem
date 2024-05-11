<?php
include_once('config.php');

class LoanTransacModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Method to fetch all transactions with associated loan amount and payable months
    public function getAllTransactionsWithLoanAmountAndMonths() {
        try {
            // Prepare the SQL statement to fetch all loan transactions with loan amount and payable months
            $stmt = $this->db->prepare("SELECT lt.TransactionID, lt.LoanID, lt.UserID, lt.TransactionType, lt.TransactionDate, lt.Status, lt.Details, l.LoanAmount, l.PayableMonths 
                                        FROM loan_transactions lt
                                        INNER JOIN loans l ON lt.LoanID = l.LoanID");
            // Execute the query
            $stmt->execute();
            // Fetch all loan transactions with loan amount and payable months
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $transactions;
        } catch(PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Method to record a new transaction
    public function recordTransaction($loanId, $userId, $transactionType, $transactionDate, $status, $details) {
        try {
            // Prepare the SQL statement to insert a new transaction
            $stmt = $this->db->prepare("INSERT INTO loan_transactions (TransactionID, LoanID, UserID, TransactionType, TransactionDate, Status, Details) VALUES (NULL, :LoanID, :UserID, :TransactionType, :TransactionDate, :Status, :Details)");
            // Bind parameters
            $stmt->bindParam(':LoanID', $loanId);
            $stmt->bindParam(':UserID', $userId);
            $stmt->bindParam(':TransactionType', $transactionType);
            $stmt->bindParam(':TransactionDate', $transactionDate);
            $stmt->bindParam(':Status', $status);
            $stmt->bindParam(':Details', $details);
            // Execute the query
            $stmt->execute();
            // Return true if successful
            return true;
        } catch(PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
