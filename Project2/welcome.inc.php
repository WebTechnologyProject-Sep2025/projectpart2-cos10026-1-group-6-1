    <?php if (isset($_SESSION['hr_user_id'])): ?>
      <h2 id="welcome_hr" style="text-align: center; color: #b71c1c;">Welcome, HR User <?php echo htmlspecialchars($_SESSION['hrname']); ?></h2>
    <?php elseif (isset($_SESSION['user_id'])): ?>
      <h2 id="welcome_user" style="text-align: center; color: #b71c1c;">Welcome, User <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <?php endif; ?>