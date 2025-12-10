<?php

require_once __DIR__ . '/../data/functions.php';
$rows = getEvents($pdo);

?>

<table class="table container mt-4">
    <thead>
        <th>Title</th>
        <th>Date</th>
        <th>Details</th>
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
                            <input type="hidden" name="action" value="view_event">
                            <button class="btn btn-sm btn-outline-success">View Event</button>
                        </form>
                    </td>
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