<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch teacher data
$lecturers = $conn->query("SELECT id, username, email FROM users WHERE account_type = 'lecturer'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lecturers</title>
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
        <a href="lecturers.php">Lecturers</a>
        <a href="students.php">Students</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Lecturers</h2>
        <table class="sortable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($lecturer = $lecturers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($lecturer['username']); ?></td>
                        <td><?php echo htmlspecialchars($lecturer['email']); ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $lecturer['id']; ?>">Update</a> |
                            <a href="delete.php?id=<?php echo $lecturer['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="printPage()">Print</button>
    </div>
</body>
</html>