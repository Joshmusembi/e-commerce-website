<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "grocery";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $cardNumber = htmlspecialchars($_POST['cardNumber']);

    // Prepare the SQL query
    $sql = "INSERT INTO checkout (name, email, address, city, cardNumber)
            VALUES ('$name', '$email', '$address', '$city', '$cardNumber')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Display success message using JavaScript
        echo "<script>
                alert('Purchase Successful!');
                 window.location.href = 'grocery.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Form</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <form id="checkoutForm" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            
            <div class="form-group">
                <label for="cardNumber">Credit Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" >
</div>
            <button type="submit" class="btn">Complete Purchase</button><br><br>

            
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>