<?php
    if (isset($_SESSION['hr_user_id']) || isset($_SESSION['user_id'])){
        header('location:index.php');
        exit();
    }
    session_start();
$errormsg = $_GET['error'] ?? ''
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="icon" href="images/logo_dataflow.png">
</head>
<body>
    <?php $pageTitle = "Login" ?>
    <?php include 'nav.inc'; include 'header.inc.php'; ?>
    <?php include 'testvicili.inc.php'; ?>
    <h1 class="login_page_title">LOG IN</h1>
    <?php if ($errormsg): ?>
        <p><?php echo ($errormsg) ?></p>
    <?php endif ?>
    <form action="login_process.php" method="post" class="login_form">
        <label for="username">Username</label>
        <input type="text" name="username" required> <br>
        <label for="password">Password</label>
        <input type="password" name="password" required> <br>
        <button type="submit">Login</button>
    </form>
    <p class="noaccount">Don't have an account? <a href="register.php">Register here</a></p>
    <?php include 'footer.inc'; ?>
</body>
</html>
