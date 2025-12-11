<?php
#public
require_once __DIR__ . '/../data/functions.php';
$rows = getEvents($pdo);

?>

<div class ="container mt-3">
    <h1>Upcoming Events</h1>
    <table class="table container mt-4">
    <thead>
        <th>Title</th>
        <th>Date</th>
        <th>Details</th>
        <?php
        if (isset($_SESSION['user_id'])):?>
            <th>Delete</th>
            <th>Edit</th>
        <?php endif; ?>
    </thead>
    <tbody>
        <?php if (count($rows) > 0): ?>
            <!--loops through events and display them-->
            <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td><?= htmlspecialchars($r['event_date']) ?></td>
                    <td> 
                        <form method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="hidden" name="action" value="event_details">
                            <button class="btn btn-sm btn btn-outline-info">View Event</button>
                        </form>
                    </td>
                    <?php

                    if (isset($_SESSION['user_id'])):?>

                    <form action="index.php" method="post" class = "d-inline">
                         <td>
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="hidden" name="action" value="delete"> 
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </form>
                    <form action="index.php" method="post" class = "d-inline">
                        <td> 
                            <input type="hidden" name="action" value="edit"> 
                            <button class="btn btn-sm btn-outline-success">Edit</button>
                        </td>
                    </form>
            
                       
                    <?php endif; ?>
                </tr>

                
                
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-muted text-center py-4">
                    No Events found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

    <?php
        if (isset($_SESSION['user_id'])):?>
            <div class="mt-4">
                <a href="?view=create" class="btn btn-primary">Create New Event</a>
            </div>
    <?php endif; ?>
</div>