<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post" action ="home.php"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    User Account:
    <select name="user_account">
        <option value="student">Student</option>
        <option value="lecturer">Lecturer</option>
        <option value="admin">Admin</option>
    </select><br>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Submit">
</form>
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mylogin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_account = $_POST["user_account"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (user_account, username, password)
            VALUES ('$user_account', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
    ?>

</body>
</html>