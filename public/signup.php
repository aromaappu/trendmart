<?php

include("connection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username']; // Username input first
    $phone = $_POST['phone']; // Phone input second
    $password = $_POST['password']; // Password input third

    // Validate username, phone, and password inputs
    $username = mysqli_real_escape_string($conn, $username);
    $phone = mysqli_real_escape_string($conn, $phone);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM signup WHERE phone = '$phone'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        echo '<script>alert("Phone number already exists")</script>';
    } else {
        $insert = "INSERT INTO signup (username, phone, password) VALUES ('$username', '$phone', '$password')"; // Inserting username, phone, password
        $insert_result = mysqli_query($conn, $insert);

        if ($insert_result) {
            header("Location: index.php");
            exit(); 
        } else {
            echo '<script>alert("Error in registration")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="password"] {
            border: 1px solid #007bff;
            background-color: #e9f5ff;
        }

        input[type="password"]:focus {
            border-color: #0056b3;
            background-color: #f0f8ff;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
    <script>
        function validateForm() {
            var username = document.forms["signupForm"]["username"].value;
            var phone = document.forms["signupForm"]["phone"].value;
            var password = document.forms["signupForm"]["password"].value;
            var phoneRegex = /^\d{10}$/;
            var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            var isValid = true;

            // Clear previous error messages
            document.getElementById("phoneError").innerText = "";
            document.getElementById("passwordError").innerText = "";

            // Validate phone number (must be 10 digits)
            if (!phoneRegex.test(phone)) {
                document.getElementById("phoneError").innerText = "Phone number must be 10 digits long.";
                isValid = false;
            }

            // Validate password (minimum 8 characters, 1 letter, 1 number)
            if (!passwordRegex.test(password)) {
                document.getElementById("passwordError").innerText = "Password must be at least 8 characters long, with at least one letter and one number.";
                isValid = false;
            }

            return isValid; // Return false if any validation fails, true otherwise
        }
    </script>
</head>
<body>
    <form name="signupForm" method="POST" action="" onsubmit="return validateForm()">
        <h1>Signup</h1>
        <input type="text" name="username" placeholder="Username" required> <!-- Username input first -->
        <input type="text" name="phone" placeholder="Phone" required> <!-- Phone input second -->
        <div id="phoneError" class="error"></div> <!-- Error message for phone -->
        
        <input type="password" name="password" placeholder="Password" required> <!-- Password input third -->
        <div id="passwordError" class="error"></div> <!-- Error message for password -->
        
        <button type="submit" name="submit">Signup</button>
        <div class="login-link">
        have an account? <a href="index.php">Login</a>
        </div>
    </form>
</body>
</html>
