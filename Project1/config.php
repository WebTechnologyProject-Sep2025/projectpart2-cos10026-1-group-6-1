<?php
    $servername = 'localhost';
    $username_db = 'root';
    $password_db = '';
    $dbname = 'hr_database';
    $conn = new mysqli ($servername , $username_db , $password_db , $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>