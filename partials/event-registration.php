<?php
    #event registration partial
?>

<form action="event_register" method="post">
    <div class="container mt-4">
        <h2>Event Registration</h2>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        
        <input type="hidden" name="action" value="registered">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>