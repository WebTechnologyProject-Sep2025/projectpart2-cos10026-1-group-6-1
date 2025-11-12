<?php
    session_start();
    if (isset($_SESSION['user_id'])){
    header('location:manage.php');
    exit();
}
$errormsg = $_GET['error'] ?? ''
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR LOGIN</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1 class="login_page_title">EOI DATABASE ACCESS</h1>
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
    
</body>
</html>
