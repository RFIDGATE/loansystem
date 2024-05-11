<?php
include_once('config.php');

class LoanModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function getLoansByUserId($userId) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM loans WHERE UserID = :UserID");
            $stmt->bindParam(':UserID', $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function applyLoan($userId, $amount, $duration) {
        try {
            // Calculate the remaining payment based on the loan amount
            $remainingPayment = $amount;
    
            // Prepare the SQL statement to insert loan application
            $stmt = $this->db->prepare("INSERT INTO loans (LoanID, UserID, LoanAmount, RemainingPayment, LoanStatus, PayableMonths, Duration) VALUES (NULL, :UserID, :LoanAmount, :RemainingPayment, 'Pending', :PayableMonths, :Duration)");
            // Bind parameters
            $stmt->bindParam(':UserID', $userId);
            $stmt->bindParam(':LoanAmount', $amount);
            $stmt->bindParam(':RemainingPayment', $remainingPayment); // Set the initial remaining payment same as the loan amount
            $stmt->bindParam(':PayableMonths', $duration);
            $stmt->bindValue(':Duration', $duration * ($amount / 5000)); // Calculate duration based on payable months and loan amount
            // Execute the query
            $stmt->execute();
            // Return the inserted loan ID
            return $this->db->lastInsertId();
        } catch(PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getLoanDetailsByUserId($userId) {
        try {
            // Prepare the SQL statement to fetch loan details by user ID
            $stmt = $this->db->prepare("SELECT * FROM loans WHERE UserID = :UserID");
            // Bind parameters
            $stmt->bindParam(':UserID', $userId);
            // Execute the query
            $stmt->execute();
            // Fetch loan details
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getLoanById($loanId) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM loans WHERE LoanID = :LoanID");
            $stmt->bindParam(':LoanID', $loanId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function updateRemainingPayment($loanId, $remainingPayment) {
        try {
            $stmt = $this->db->prepare("UPDATE loans SET RemainingPayment = :RemainingPayment WHERE LoanID = :LoanID");
            $stmt->bindParam(':RemainingPayment', $remainingPayment);
            $stmt->bindParam(':LoanID', $loanId);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}
?>
