<?php
session_start();
require_once 'settings.php';

$error_message = '';
$success_message = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Basic validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match, please re-enter.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if username already exists
        $stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
        if (!$stmt) {
            $error_message = "Database error: " . $conn->error;
        } else {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error_message = "Username already taken.";
            } else {
                // Insert new user into database
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO user (username, userpassword) VALUES (?, ?)");
                
                if (!$stmt) {
                    $error_message = "Database error: " . $conn->error;
                } else {
                    $stmt->bind_param("ss", $username, $hashedPassword);

                    if ($stmt->execute()) {
                        // Redirect to login.php
                        header("Location: login.php");
                        exit();
                    } else {
                        $error_message = "Error: Could not register user. " . $stmt->error;
                    }
                    $stmt->close();
                }
            }
            if (isset($stmt) && $stmt !== false) {
                $stmt->close();
            }
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Nguyen Lam Khai">
  <meta name="description" content="Register page">
  <meta name="country" content="Vietnam">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="icon" href="images/logo_dataflow.png">
  <title>The DataFlow Team</title>
</head>
<body>
  <?php $pageTitle = "Register" ?>
  <?php include 'nav.inc'; include 'header.inc.php'; ?>
  <main class="main_container">
    <div class="form_container">
        <form class="register_form" method="post" action="register.php">
        <fieldset class="form_wrapper">
            <h2 class="form-title">Register</h2>
            
            <?php if (!empty($error_message)): ?>
                <div class="error_message" style="color: red; margin-bottom: 15px; padding: 10px; background-color: #ffe6e6; border: 1px solid red; border-radius: 5px;">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="success_message" style="color: green; margin-bottom: 15px; padding: 10px; background-color: #e6ffe6; border: 1px solid green; border-radius: 5px;">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <label for="username">Username:</label>
            <input id="username" type="text" name="username" required="required" maxlength="50" pattern="[A-Za-z0-9]{1,50}" placeholder="Username" title="enter alphanumeric characters only" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            <br>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" required="required" minlength="8" maxlength="20" placeholder="Password" title="Password must be between 8 and 20 characters">
            <br>
            <label for="confirm_password">Confirm Password:</label>
            <input id="confirm_password" type="password" name="confirm_password" required="required" minlength="8" maxlength="20" placeholder="Confirm Password" title="Please re-enter your password">
            <br>
            <input type="submit" value="Register" id="register_button">
        </fieldset>
        </form>
    </div>
  </main>
  <?php include 'footer.inc'; ?>
</body>
</html>