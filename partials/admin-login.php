<?php
 #admin login partial
    echo("Admin Login");
?>

  <form action="admin_login" method="post">
        <div class="container mt-4">
            <h2>Admin Login</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            
            <input type="hidden" name="action" value="admin_login">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
  </form>