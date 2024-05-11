<?php
require_once '../models/savingsmodel.php';
require_once '../models/SavingsTransactionModel.php';

class SavingsController {
    private $savingsModel;
    private $transactionModel;
    private $userId;

    public function __construct($userId) {
        $this->userId = $userId;
        $this->savingsModel = new SavingsModel();
        $this->transactionModel = new SavingsTransactionModel();
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getSavingsId() {
        return $this->savingsModel->getSavingsId($this->userId);
    }

    public function getAvailableBalance() {
        return $this->savingsModel->getAvailableBalance($this->userId);
    }

    public function deposit($savingsId, $amount) {
        return $this->savingsModel->deposit($savingsId, $amount);
    }

    public function withdraw($amount) {
        $savingsId = $this->getSavingsId();
        return $this->savingsModel->withdraw($this->userId, $amount);
    }

    public function getTransactions($category = null, $search = null) {
        return $this->transactionModel->getTransactions($this->getSavingsId(), $category, $search);
    }

    public function addPremiumIncomeToSavings($totalIncome, $totalPremiumUsers) {
        $incomePerUser = ($totalIncome * 0.02) / $totalPremiumUsers;
        return $this->savingsModel->addPremiumIncomeToSavings($incomePerUser);
    }

    public function checkSavingsStatus() {
        return $this->savingsModel->checkSavingsStatus($this->userId);
    }
}
?>
