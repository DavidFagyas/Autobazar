<?php
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "autobazar";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kapcsolat sikertelen: " . $conn->connect_error);
}
?>
