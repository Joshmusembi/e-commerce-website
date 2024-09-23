<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch user data
$user_data = $conn->query("SELECT account_type FROM login_g WHERE username='$username'")->fetch_assoc();
$account_type = $user_data['account_type'];

// Fetch user counts
$admin_count = $conn->query("SELECT COUNT(*) AS count FROM login_g WHERE account_type = 'admin'")->fetch_assoc()['count'];
$student_count = $conn->query("SELECT COUNT(*) AS count FROM login_g WHERE account_type = 'user'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="restrict.css">
</head>
<body>

    <header class="header">
        <div class="logo">Dashboard</div>
        <a href="grocery.php">HOME</a>
        <nav class="navbar">
            <ul>
                <?php if ($account_type == 'admin'): ?>
                    <li><a href="admins.php">Admins</a></li>
                    <li><a href="students.php">Users</a></li>
                <?php elseif ($account_type == 'user'): ?>
                    <li><a href="students.php">Students</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <a href="login.php" class="logout-button">Logout</a>
    </header>

    <main class="main-content">
        <section class="welcome-section">
            <h1>Hello, <?php echo htmlspecialchars($username); ?>!</h1>
            <p>Welcome back! We hope you have a productive day.</p>
        </section>

        <section class="image-section">
            <img src="img/welcome.png" alt="Welcome Image">
        </section>

        <section class="user-counts">
            <h2>Users</h2>
            <div class="counts">
                <?php if ($account_type == 'admin'): ?>
                    <div class="count-item">
                        <h3>Admins</h3>
                        <p><?php echo $admin_count; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ($account_type == 'admin' || $account_type == 'lecturer'): ?>
                    <div class="count-item">
            
                    </div>
                <?php endif; ?>
                <?php if ($account_type == 'admin' || $account_type == 'lecturer' || $account_type == 'student'): ?>
                
                        <h3>user</h3>
                        <p><?php echo $student_count; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        alert("Welcome, <?php echo htmlspecialchars($username); ?>!");
    </script>
</body>
</html>
