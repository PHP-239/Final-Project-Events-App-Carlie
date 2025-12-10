<?php
    //require_once __DIR__ . '/../data/functions.php';
    //require_once __DIR__ . '/../data/db.php';
    // $pdo = get_pdo();
    
    // $event = getEventById($pdo,$id);

?>

<div class="container mt-4">
    <!--Displaying event details -->
    <h1><?= htmlspecialchars($event['title']) ?></h1>
    <h2><?= htmlspecialchars($event['event_date']) ?></h2>
    <h3><?= htmlspecialchars($event['location']) ?></h3>
<!-- also learned that nl2b introduces line breaks for linebreaks within the string.-->
    <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
  
</div>