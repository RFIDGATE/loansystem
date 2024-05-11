<?php 
require_once '../control/savingscontroller.php';
// Assuming $_SESSION['user_id'] contains the user ID
$userId = $_SESSION['id'];

$controller = new SavingsController($userId);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'withdraw') {
    $withdrawAmount = $_POST['withdraw_amount'];
    if ($controller->withdraw($withdrawAmount)) {
        echo "Your withdrawal request has been submitted for processing.";
    } else {
        echo "Failed to submit withdrawal request.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            margin: 20px auto;
            width: 50%;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Savings</h1>
    <p>User ID: <?php echo $controller->getUserId(); ?></p>
    <p>Savings ID: <?php echo $controller->getSavingsId(); ?></p>
    <p>Current Savings Amount: <?php echo $controller->getAvailableBalance(); ?></p>
    <form action="../control/savingscontroller.php" method="post">
        <label for="deposit_amount">Deposit Amount:</label>
        <input type="number" id="deposit_amount" name="deposit_amount" min="100" max="1000" required><br><br>
        <button type="submit" name="action" value="deposit">Deposit</button>
    </form>
    <br>
    <form action="../control/savingscontroller.php" method="post">
        <label for="withdraw_amount">Withdraw Amount:</label>
        <input type="number" id="withdraw_amount" name="withdraw_amount" min="500" max="5000" required><br><br>
        <button type="submit" name="action" value="withdraw">Withdraw</button>
    </form>
    <br>
    <h2>Savings Transactions</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Current Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $transactions = $controller->getTransactions();
    $rowCount = 1; 
    foreach ($transactions as $transaction) {
        echo "<tr>";
        echo "<td>{$rowCount}</td>";
        echo "<td>{$transaction['date_time']}</td>"; 
        echo "<td>{$transaction['transaction_id']}</td>"; 
        echo "<td>{$transaction['transaction_type']}</td>"; 
        echo "<td>{$transaction['amount']}</td>"; 
        echo "<td>{$transaction['last_amount']}</td>"; 
        echo "<td>{$transaction['status']}</td>";
        echo "</tr>";
        $rowCount++; 
    }
            ?>
        </tbody>
    </table>
</body>
</html>
