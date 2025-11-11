<?php
 session_start();
 require_once 'config.php';
 $max_attempts = 3;
 if (!isset($_POST['username'], $_POST['password'])) {
    header('Location: login.php');
    exit();
}

$username_attempt = $_POST['username'];
$password_attempt = $_POST['password'];

$stmt = $conn->prepare("SELECT user_id, password, failed_attempt FROM hr_users WHERE username = ?");
$stmt->bind_param("s", $username_attempt);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if ($user['failed_attempt'] >= $max_attempts) {
        $error = "Account is locked.";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }

    if (password_verify($password_attempt, $user['password'])) {
        
        $update_stmt = $conn->prepare("UPDATE hr_users SET failed_attempt = 0 WHERE user_id = ?");
        $update_stmt->bind_param("i", $user['user_id']);
        $update_stmt->execute();
        $update_stmt->close();

        $_SESSION['user_id'] = $user['user_id'];
        header('Location: manage.php');
        exit();

    } else {
        
        $new_attempts = $user['failed_attempt'] + 1;
        $update_stmt = $conn->prepare("UPDATE hr_users SET failed_attempt = ? WHERE user_id = ?");
        $update_stmt->bind_param("ii", $new_attempts, $user['user_id']);
        $update_stmt->execute();
        $update_stmt->close();
        
        $remaining = $max_attempts - $new_attempts;
        $error = "Invalid credentials. Attempts remaining: " . max(0, $remaining);
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }

} else {
    $error = "Invalid credentials.";
    header("Location: login.php?error=" . urlencode($error));
    exit();
}

$conn->close();

