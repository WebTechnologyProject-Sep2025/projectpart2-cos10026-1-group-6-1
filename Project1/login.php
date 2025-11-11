<?php
    session_start():
if(isset($_SESSION['user_id'])){
    header('location:manage.php');
    exit()
}
$errormsg = $_GET['error'] ?? ''
?>
