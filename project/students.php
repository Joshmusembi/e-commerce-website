<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch student data
$students = $conn->query("SELECT id,username, email FROM login_g WHERE account_type = 'student'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/1.13.0/sortable.min.js"></script>
    <script>
        function printPage() {
            window.print();
        }

        body {
            background-color: var (--orange);
        }
    </script>
</head>
<body>
    <div class="top-nav">
        <a href="index.php">Home</a>
        <a href="students.php">USERS</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Students</h2>
        <table class="sortable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = $students->fetch_assoc()): ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($student['username']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td>
                           
                            <a href="update.php?id=<?php echo $student['id']; ?>">Update</a> | 
                            <a href="delete.php?id=<?php echo $student['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="printPage()">Print</button>
    </div>
</body>
</html>
