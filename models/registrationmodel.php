<?php
// registrationmodel.php

// Include the database connection file
include_once('config.php');

class RegistrationModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function registerUser($formData) {
        // Extract form data
        extract($formData);
    
        if ($account_type === 'Premium' && $this->countPremiumMembers() >= 50) {
            echo "Sorry, the maximum number of members for Premium accounts has been reached.";
            return;
        }

        if ($this->userExists($username, $email)) {
            echo "Username or email already exists.";
            return;
        }

    
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Handle file uploads
        $proofOfBillingPath = $this->uploadFile($_FILES['proof_of_billing'], 'pof');
        $validIdPrimaryPath = $this->uploadFile($_FILES['valid_id_primary'], 'vid');
        $coePath = $this->uploadFile($_FILES['coe'], 'coe');
    
        // Prepare SQL query
        $query = "INSERT INTO users (account_type, name, address, gender, birthday, age, email, contact_number, bank_name, bank_account_number, card_holder_name, tin_number, company_name, company_address, company_phone_number, position, monthly_earnings, proof_of_billing, valid_id_primary, coe, username, password) 
        VALUES (:account_type, :name, :address, :gender, :birthday, :age, :email, :contact_number, :bank_name, :bank_account_number, :card_holder_name, :tin_number, :company_name, :company_address, :company_phone_number, :position, :monthly_earnings, :proof_of_billing, :valid_id_primary, :coe, :username, :password)";
    
        // Prepare and execute the statement
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute([
            'account_type' => $account_type,
            'name' => $name,
            'address' => $address,
            'gender' => $gender,
            'birthday' => $birthday,
            'age' => $age,
            'email' => $email,
            'contact_number' => $contact_number,
            'bank_name' => $bank_name,
            'bank_account_number' => $bank_account_number,
            'card_holder_name' => $card_holder_name,
            'tin_number' => $tin_number,
            'company_name' => $company_name,
            'company_address' => $company_address,
            'company_phone_number' => $company_phone_number,
            'position' => $position,
            'monthly_earnings' => $monthly_earnings,
            'proof_of_billing' => $proofOfBillingPath,
            'valid_id_primary' => $validIdPrimaryPath,
            'coe' => $coePath,
            'username' => $username,
            'password' => $hashedPassword 
        ]);

    }

    // Function to handle file uploads
    private function uploadFile($file, $folder) {
        $targetDir = "../view/$folder/";
        $fileName = basename($file["name"]);
        $targetFile = $targetDir . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
            // File already exists
            $uploadOk = 0;
            $errorMessage = "File '$fileName' already exists.";
        }

        // Check file size, file type, etc.
        // Implement these checks based on your requirements

        // If everything is ok, try to upload file
        if ($uploadOk == 1 && move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            // File upload failed or file already exists
            if (isset($errorMessage)) {
                // Notify the user about the existing file
                echo $errorMessage;
            } else {
                // Notify the user about the file upload failure
                echo "Sorry, there was an error uploading your file.";
            }
            return null;
        }
    }

    private function userExists($username, $email) {
        $query = "SELECT COUNT(*) AS count FROM users WHERE username = :username OR email = :email";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute(['username' => $username, 'email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

    private function countPremiumMembers() {
        $query = "SELECT COUNT(*) AS count FROM users WHERE account_type = 'Premium'";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
?>
