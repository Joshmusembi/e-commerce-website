<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $account_type = $_POST['account_type'];

    // Check for duplicate username or email
    $sql = "SELECT * FROM login_g WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Error: Username or Email already exists.";
    } else {
        // Proceed with the insertion
        $sql = "INSERT INTO login_g (username, email, password, account_type) VALUES ('$username', '$email', '$password', '$account_type')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <style>

        body {
            background-color: orange;
        }
        .left-side{
            background-color: orange;
        }
        .container {
            background-color: orange;
        }
        </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <form method="POST" action="signup.php">
                <h2>Sign Up</h2>
                <label>Account Type</label>
                <select name="account_type" required>
                    <option value="admin">Admin</option>
                    <option value="student">user</option>

                </select>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
                <button type="reset">Clear</button>
                <p>Already hava an account? <a href="login.php">login</a>
            </form>
        </div>
        <div class="right-side"></div>
    </div>
</body>
</html>
