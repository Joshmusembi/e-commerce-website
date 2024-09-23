<?php
session_start();  // Start session to manage user login state
include 'mypractice.php';  // Include file with database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and escape user inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_account = mysqli_real_escape_string($conn, $_POST['user_account']);

    // SQL query to select user from database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND user_account='$user_account'";
    $result = mysqli_query($conn, $sql);  // Execute query

    // Check if exactly one row is returned (valid credentials)
    if (mysqli_num_rows($result) == 1) {
        // Set session variables for user identification
        $_SESSION['user'] = $username;
        $_SESSION['user_account'] = $user_account;
        header("Location: home.php");  // Redirect to homepage on successful login
        exit();  // Exit to prevent further execution
    } else {
        $error = "Invalid username, password, or user account type";  // Error message for invalid credentials
    }

    mysqli_close($conn);  // Close database connection
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form action="home.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="user_account">User Account:</label>
        <select id="user_account" name="user_account" required>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit">Login</button>
        <button type="reset">Clear</button>
    </form>
</body>
</html>