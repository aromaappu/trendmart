<?php
include("connection.php");

$phoneError = $passwordError = "";

if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $valid = true; // Flag to track validation state

    // Check if fields are empty
    if (empty($phone)) {
        $phoneError = "Phone number is required";
        $valid = false;
    }

    if (empty($password)) {
        $passwordError = "Password is required";
        $valid = false;
    }

    if ($valid) {
        // Check if phone number exists with password
        $sql = "SELECT * FROM signup WHERE phone = '$phone'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_fetch_assoc($result);

        if ($num) {
            // Phone exists, now check if password is correct
            if ($num['password'] === $password) {
                header('location:in.html'); // Login successful
            } else {
                $passwordError = "Incorrect password"; // Password mismatch
            }
        } else {
            $phoneError = "Phone number does not exist. Please signup first.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
</head>
<body>
    <form action="" method="POST">
        <h1>Login</h1>
        <input type="text" name="phone" placeholder="Enter the number" required value="<?php echo isset($phone) ? $phone : ''; ?>"><br>
        <div class="error"><?php echo $phoneError; ?></div>

        <input type="password" name="password" placeholder="Enter the password" required><br>
        <div class="error"><?php echo $passwordError; ?></div>

        <button type="submit" name="submit">Login</button><br>
        <div class="login-link">
            Don't have an account? <a href="signup.php">Signup</a>
        </div>
    </form>
</body>
</html>
