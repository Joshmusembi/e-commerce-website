<?php
session_start(); // Start the session

// Database configuration
$servername = "localhost"; // Database server name
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "grocery";        // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    echo "<h2>Your cart is empty.</h2>";
    exit();
}

// Handle removing an item from the cart
if (isset($_GET['remove'])) {
    $itemToRemove = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['item'] === $itemToRemove) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    // Destroy the session
    session_destroy();
    
    // Redirect to the main page (grocery.php)
    header("Location: grocery.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="cart.css"> <!-- Link to the new cart CSS file -->
</head>
<body>

<h2>Your Cart</h2>
<table class="table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalPrice = 0; // Initialize total price
        foreach ($_SESSION['cart'] as $cartItem): 
            $itemTotal = isset($cartItem['totalprice']) ? $cartItem['totalprice'] : 0; // Use total price from the session
            $totalPrice += $itemTotal; // Add to overall total
        ?>
            <tr>
                <td>
                    <img src="<?php echo htmlspecialchars($cartItem['image']); ?>" alt="<?php echo htmlspecialchars($cartItem['item']); ?>" width="50" style="margin-right: 10px;">
                    <?php echo htmlspecialchars($cartItem['item']); ?>
                </td>
                <td><?php echo htmlspecialchars(number_format($cartItem['price'], 0)); ?></td> <!-- Ensure price is displayed as integer -->
                <td><?php echo htmlspecialchars($cartItem['quantity']); ?></td>
                <td><?php echo htmlspecialchars(number_format($itemTotal, 0)); ?></td> <!-- Ensure total price is displayed as integer -->
                <td>
                    <a href="?remove=<?php echo urlencode($cartItem['item']); ?>" class="btn">Remove</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="text-align: right;"><strong>Total Price:</strong></td>
            <td><?php echo htmlspecialchars(number_format($totalPrice, 0)); ?></td> <!-- Ensure total price is displayed as integer -->
            <td></td>
        </tr>
    </tbody>
</table>

<!-- Logout and Checkout buttons -->
<a href="?logout=true" class="logout-btn btn">Logout</a>
<a href="checkout.php" class="checkout-btn btn">Checkout</a>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>