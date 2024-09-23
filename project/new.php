<!DOCTYPE html>
<html>
<head>
    <title>Even Numbers</title>
</head>
<body>
    <h2>Even Numbers Between 0 and 100</h2>
    <?php
        echo "The even numbers between 0 and 100 are: <br>";
        for ($i = 0; $i <= 100; $i++) {
            if ($i % 2 == 0) {
                echo $i . " ";
            }
        }
    ?>
</body>
</html>
