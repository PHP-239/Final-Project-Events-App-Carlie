<?php 
#Registrations partial
    require_once __DIR__ . '/../data/functions.php';
    $rows = getRegistrations($pdo);
?>

<div class ="container mt-3">
    <h1>Event Registrations</h1>
    <table class="table container mt-4">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Event</th>
            <th>Registered At</th>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): ?>
                <!--loops through registrations and display them-->
                <?php foreach ($rows as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r['name']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td><?= htmlspecialchars($r['event_title']) ?></td>
                        <td><?= htmlspecialchars($r['registered_at']) ?></td>
                    </tr>
                    
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-muted text-center py-4">
                        No Registrations found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
