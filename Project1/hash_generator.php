<?php
$plain_password = "quan2007"; 
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
echo "Plain Password: " . $plain_password . "<br>";
echo "Generated Hash: <strong>" . $hashed_password . "</strong><br>";
?>