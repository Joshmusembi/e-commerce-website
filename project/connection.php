<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "connected success";
}

function unique_id (){
    $chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen ($chars);
    $randomString = '';
    for ($i=0; $i<20; $i++)
    {
        $randomString=$chars[mt_rand(0,$charLength -1)];

    }
    return $randomString;
}


?>