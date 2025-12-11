<?php
    #event registration partial
    require_once __DIR__ . '/../data/functions.php';
    //get list of events from database
    $events = getEvents($pdo);
?>

<form action="index.php" method="post">
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
        <div class="mb-3">
            <label for="event" class="form-label">Select Event</label>
            <select class="form-select" id="event" name="event_id" required>
                <option value="" disabled selected>Select an event</option>
                <?php foreach ($events as $event): ?>
                    <option value="<?= htmlspecialchars($event['id']) ?>">
                        <?= htmlspecialchars($event['title']) ?> - <?= htmlspecialchars($event['event_date']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <input type="hidden" name="action" value="registered">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>