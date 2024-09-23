<?php
// Database connection details
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "grocery"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email is set and handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $conn->real_escape_string($_POST['email']);

    // Insert email into the database
    $sql = "INSERT INTO sub (email) VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the form with a success message
        echo "<script>
    // JavaScript to handle the alert message
    document.getElementById('subscriptionForm').onsubmit = function() {
        alert('Thank you for subscribing!');
    };
</script>";   
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Subscription</title>
    <style>
        /* Add some basic styling */
        .email, .btn {
            margin: 5px;
            padding: 10px;
        }
    </style>
</head>
<body>

<h3>Newsletters</h3>
<p>Subscribe for more updates</p>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green;">Thank you for subscribing!</p>
<?php endif; ?>

<!-- Subscription Form -->
<form id="subscriptionForm" method="POST" action="">
    <input type="email" name="email" placeholder="your email" class="email" required>
    <input type="submit" value="Subscribe" class="btn">
    <img src="download (2).png" class="payment-img" alt="">
</form>


</body>
</html>