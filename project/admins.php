<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch admin data
$admins = $conn->query("SELECT id,username, email FROM login_g WHERE account_type = 'admin'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admins</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/1.13.0/sortable.min.js"></script>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="top-nav">
        <a href="index.php">Home</a>
        <a href="admins.php">Admins</a>
        <a href="teachers.php">Teachers</a>
        <a href="students.php">Students</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Admins</h2>
        <table class="sortable">
            <thead>
                <tr>
                    
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($admin = $admins->fetch_assoc()): ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($admin['username']); ?></td>
                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                        <td>
                    | 
                            <a href="update.php?id=<?php echo $admin['id']; ?>">Update</a> | 
                            <a href="delete.php?id=<?php echo $admin['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="printPage()">Print</button>
    </div>
</body>
</html>
