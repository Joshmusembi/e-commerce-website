<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received</title>
</head>
<body>
    <h1>Application Received</h1>
    <h2>Submitted Details:</h2>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $gender = htmlspecialchars($_POST['gender']);
        $position = htmlspecialchars($_POST['position']);
        $salary = htmlspecialchars($_POST['salary']);
        
        echo "<p><strong>Applicant Name:</strong> $name</p>";
        echo "<p><strong>Gender:</strong> $gender</p>";
        echo "<p><strong>Position Applied:</strong> $position</p>";
        echo "<p><strong>Salary Expectation:</strong> $salary</p>";
    } else {
        echo "<p>No data received.</p>";
    }
    ?>
</body>
</html>