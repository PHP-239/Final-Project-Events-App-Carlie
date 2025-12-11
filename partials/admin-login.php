<?php
 #admin login partial
?>

  <form action="index.php" method="post">
        <div class="container mt-4">
            <h2>Admin Login</h2>
            <?php if (!empty($login_error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($login_error) ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            
            <input type="hidden" name="action" value="login">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
  </form>