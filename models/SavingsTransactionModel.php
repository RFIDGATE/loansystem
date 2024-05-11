<?php
require_once 'config.php';

class SavingsTransactionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // public function logTransaction($savingsId, $type, $amount, $transactionId, $status, $dateTime) {
    //     $stmt = $this->db->prepare("INSERT INTO savingstransaction (transaction_id, savings_id, transaction_type, amount, status, date_time) VALUES (?, ?, ?, ?, ?, ?)");
    //     return $stmt->execute([$transactionId, $savingsId, $type, $amount, $status, $dateTime]);
    // }
    public function logTransaction($savingsId, $type, $amount, $transactionId, $status, $dateTime) {
        // Get the current total savings amount before the transaction
        $stmt = $this->db->prepare("SELECT savings_amount FROM savingdatabase WHERE savings_id = ?");
        $stmt->execute([$savingsId]);
        $currentSavingsAmount = $stmt->fetchColumn();
    
        // Calculate the total savings amount after the transaction
        $totalSavingsAmount = ($type === 'Deposit') ? $currentSavingsAmount : $currentSavingsAmount;
    
        // Insert the transaction into the savingstransaction table
        $stmt = $this->db->prepare("INSERT INTO savingstransaction (transaction_id, savings_id, transaction_type, amount, last_amount, status, date_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$transactionId, $savingsId, $type, $amount, $totalSavingsAmount, $status, $dateTime]);
    }
    
    

    public function getTransactions($savingsId, $category = null, $search = null) {
        $query = "SELECT t.*, s.savings_id, s.savings_amount 
                  FROM savingstransaction t 
                  JOIN savingdatabase s ON t.savings_id = s.savings_id
                  WHERE s.savings_id = ?";
        $params = [$savingsId];
        
        if ($category !== null) {
            $query .= " AND t.transaction_type = ?";
            $params[] = $category;
        }
        if ($search !== null) {
            $query .= " AND t.transaction_id = ?";
            $params[] = $search;
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
