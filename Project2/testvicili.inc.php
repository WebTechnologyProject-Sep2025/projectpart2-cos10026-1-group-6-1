    <?php if (isset($_SESSION['hr_user_id'])): ?>
      <h2 id="welcome_hr">Welcome, HR User <?php echo htmlspecialchars($_SESSION['hr_user_id']); ?></h2>
    <?php elseif (isset($_SESSION['user_id'])): ?>
      <h2 id="welcome_user">Welcome, User <?php echo htmlspecialchars($_SESSION['user_id']); ?></h2>
    <?php endif; ?>