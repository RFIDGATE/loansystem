<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
            display: inline-block;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #age {
            width: calc(25% - 5px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #age-label {
            display: inline-block;
            width: calc(25% - 5px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }


        .back-btn {
            text-align: center;
            margin-top: 10px;
        }

        .back-btn button {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn button:hover {
            background-color:  #45a049;
        }
    </style>
</head>
<body>
    <h1>User Registration</h1>
    <form action="../control/registrationcontrol.php" method="post" enctype="multipart/form-data">
    <label for="account_type">Account Type:</label>
        <select id="account_type" name="account_type" required>
            <option value="Basic">Basic</option>
            <option value="Premium">Premium</option>
        </select><br><br>


        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required onchange="calculateAge(this.value)"><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" readonly><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="contact_number">Contact Number:</label>
        <input type="tel" id="contact_number" name="contact_number" required><br><br>

        <label for="bank_name">Bank Name:</label>
        <input type="text" id="bank_name" name="bank_name" required><br><br>

        <label for="bank_account_number">Bank Account Number:</label>
        <input type="text" id="bank_account_number" name="bank_account_number" required><br><br>

        <label for="card_holder_name">Card Holder's Name:</label>
        <input type="text" id="card_holder_name" name="card_holder_name" required><br><br>

        <label for="tin_number">TIN Number:</label>
        <input type="text" id="tin_number" name="tin_number" required><br><br>

        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" required><br><br>

        <label for="company_address">Company Address:</label>
        <input type="text" id="company_address" name="company_address" required><br><br>

        <label for="company_phone_number">Company Phone Number:</label>
        <input type="tel" id="company_phone_number" name="company_phone_number" required><br><br>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br><br>

        <label for="monthly_earnings">Monthly Earnings:</label>
        <input type="number" id="monthly_earnings" name="monthly_earnings" step="0.01" min="0" required><br><br>

        <label for="proof_of_billing">Proof of Billing:</label>
        <input type="file" id="proof_of_billing" name="proof_of_billing" required><br><br>

        <label for="valid_id_primary">Valid ID (Primary):</label>
        <input type="file" id="valid_id_primary" name="valid_id_primary" required><br><br>

        <label for="coe">Certificate of Employment (COE):</label>
        <input type="file" id="coe" name="coe" required><br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" minlength="6" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" minlength="8" required><br><br>

        <input type="submit" value="Register">
        
        <div class="back-btn">
            <button onclick="goBack()">Back to Login</button>
        </div>
    </form>


    <script>
        
        function goBack() {
        window.location.href = "login.php";
        }

        function calculateAge(birthdate) {
            var today = new Date();
            var dob = new Date(birthdate);
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        }
    </script>
</body>
</html>
