<?php
    session_start():
if(isset($_SESSION['user_id'])){
    header('location:manage.php');
    exit()
}
$errormsg = $_GET['error'] ?? ''
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR LOGIN</title>
</head>
<body>
    <h1>EOI DATABASE ACCESS</h1>
    <?php if ($errormsg): ?>
        <p><?php echo htmlspecialchar($errormsg) ?></p>
    <?php endif ?>
    <form action="login_process.php" method="post" class="login_proc">
        <label for="">Username</label>
        <input type="text" name="username" required> <br>
        <label for="">Password</label>
        <input type="password" name="password" required> <br>
        <button type="submit">Login</button>
    </form>
    
</body>
</html>
