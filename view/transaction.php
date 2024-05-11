<?php
include_once('../control/loantransaccontroller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Transactions</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Loan Transactions</h1>
    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Loan ID</th>
                <th>Loan Amount</th>
                <th>Payable Months</th>
                <th>Transaction Date</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each transaction and display it in a table row
            foreach ($transactions as $transaction) {
                echo "<tr>";
                echo "<td>" . $transaction['TransactionID'] . "</td>";
                echo "<td>" . $transaction['LoanID'] . "</td>";
                echo "<td>" . $transaction['LoanAmount'] . "</td>"; // Display loan amount
                echo "<td>" . $transaction['PayableMonths'] . "</td>"; // Display payable months
                echo "<td>" . $transaction['TransactionDate'] . "</td>";
                echo "<td>" . $transaction['Status'] . "</td>";
                echo "<td>" . $transaction['Details'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="loan.php" class="back-btn">Back to Loan Page</a>
</body>
</html>
