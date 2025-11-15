<?php
session_start();
require_once 'settings.php';

$max_attempts = 3;
$lock_duration = 1; // seconds

if (!isset($_POST['username'], $_POST['password'])) {
    header('Location: login.php?error=Missing fields');
    exit();
}

$username_attempt = trim($_POST['username']);
$password_attempt = $_POST['password'];

/**
 * Helper: Dynamic bind_param for any number of params
 */
function dynamic_bind($stmt, $params) {
    $types = '';
    foreach ($params as $p) {
        $types .= is_int($p) ? 'i' : 's';
    }
    $bind_names[] = $types;
    foreach ($params as $key => $value) {
        $bind_names[] = &$params[$key]; // pass by reference
    }
    call_user_func_array([$stmt, 'bind_param'], $bind_names);
}

/**
 * Function: Check account lock status
 */
function check_lock_status($user, $table, $conn) {
    $allowed_tables = ['hr_user', 'user'];
    if (!in_array($table, $allowed_tables)) {
        die("Invalid table name");
    }

    $current = time();
    if (!empty($user['locked_until'])) {
        $locked_until = strtotime($user['locked_until']);

        if ($current < $locked_until) {
            $remaining = ceil(($locked_until - $current) / 60);
            header("Location: login.php?error=" . urlencode("Account locked. Try again in $remaining min."));
            exit();
        } else {
            // Lock expired → reset failed attempts and clear lock
            $query = "UPDATE $table SET failed_attempts = 0, locked_until = NULL WHERE {$table}_id = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error . " | Query: " . $query);
            }

            $id_field = $table . '_id';
            dynamic_bind($stmt, [$user[$id_field]]);
            $stmt->execute();
            $stmt->close();
        }
    }
}

/* TRY HR TABLE */
$stmt = $conn->prepare("SELECT * FROM hr_user WHERE hrname = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
dynamic_bind($stmt, [$username_attempt]);
$stmt->execute();
$hr_result = $stmt->get_result();

if ($hr_result->num_rows === 1) {
    $user = $hr_result->fetch_assoc();

    if ($user['failed_attempts'] >= $max_attempts && !empty($user['locked_until'])) {
        check_lock_status($user, "hr_user", $conn);
    }

    if (password_verify($password_attempt, $user['hrpassword'])) {
        $update = $conn->prepare("UPDATE hr_user SET failed_attempts = 0, locked_until = NULL, last_login = NOW() WHERE hr_user_id = ?");
        if (!$update) {
            die("Prepare failed: " . $conn->error);
        }
        dynamic_bind($update, [$user['hr_user_id']]);
        $update->execute();
        $update->close();

        $_SESSION['hr_user_id'] = $user['hr_user_id'];
        $_SESSION['username'] = $user['hrname'];
        header("Location: manage.php");
        exit();
    } else {
        $new_attempts = $user['failed_attempts'] + 1;
        if ($new_attempts >= $max_attempts) {
            $locked_until = date("Y-m-d H:i:s", strtotime("+$lock_duration minutes"));
            $update = $conn->prepare("UPDATE hr_user SET failed_attempts = ?, locked_until = ? WHERE hr_user_id = ?");
            dynamic_bind($update, [$new_attempts, $locked_until, $user['hr_user_id']]);
        } else {
            $update = $conn->prepare("UPDATE hr_user SET failed_attempts = ? WHERE hr_user_id = ?");
            dynamic_bind($update, [$new_attempts, $user['hr_user_id']]);
        }
        if (!$update) {
            die("Prepare failed: " . $conn->error);
        }
        $update->execute();
        $update->close();

        $remaining = max(0, $max_attempts - $new_attempts);
        header("Location: login.php?error=" . urlencode("Invalid password. Attempts left: $remaining"));
        exit();
    }
}

/* TRY USER TABLE */
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
dynamic_bind($stmt, [$username_attempt]);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows === 1) {
    $user = $user_result->fetch_assoc();

    if ($user['failed_attempts'] >= $max_attempts && !empty($user['locked_until'])) {
        check_lock_status($user, "user", $conn);
    }

    if (password_verify($password_attempt, $user['userpassword'])) {
        $update = $conn->prepare("UPDATE user SET failed_attempts = 0, locked_until = NULL, last_login = NOW() WHERE user_id = ?");
        if (!$update) {
            die("Prepare failed: " . $conn->error);
        }
        dynamic_bind($update, [$user['user_id']]);
        $update->execute();
        $update->close();

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $new_attempts = $user['failed_attempts'] + 1;
        if ($new_attempts >= $max_attempts) {
            $locked_until = date("Y-m-d H:i:s", strtotime("+$lock_duration minutes"));
            $update = $conn->prepare("UPDATE user SET failed_attempts = ?, locked_until = ? WHERE user_id = ?");
            dynamic_bind($update, [$new_attempts, $locked_until, $user['user_id']]);
        } else {
            $update = $conn->prepare("UPDATE user SET failed_attempts = ? WHERE user_id = ?");
            dynamic_bind($update, [$new_attempts, $user['user_id']]);
        }
        if (!$update) {
            die("Prepare failed: " . $conn->error);
        }
        $update->execute();
        $update->close();

        $remaining = max(0, $max_attempts - $new_attempts);
        header("Location: login.php?error=" . urlencode("Invalid password. Attempts left: $remaining"));
        exit();
    }
}

/* USERNAME DOES NOT EXIST */
header("Location: login.php?error=Invalid username");
exit();
?>