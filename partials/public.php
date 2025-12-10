<?php

require_once __DIR__ . '/../data/functions.php';
$rows = getEvents($pdo);

?>

<table class="table">
    <thead>
        <th>Title</th>
        <th>Date</th>
        <th>Location</th>
        <th>Description</th>
    </thead>
    <tbody>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td><?= htmlspecialchars($r['event_date']) ?></td>
                    <td><?= htmlspecialchars($r['location']) ?></td>
                    <td><?= htmlspecialchars($r['description']) ?></td>
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