<?php
// index.php

require_once 'data/db.php';
require_once 'data/functions.php';

$pdo = get_pdo();
//print_r($pdo);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP FINAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <p>HI</p>
    <?php
        $events = getEvents($pdo);
        foreach($events as $event) {
            echo "<div class='card mb-3 bg-secondary text-white'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($event['title']) . "</h5>";
            echo "<p class='card-text'>Date: " . htmlspecialchars($event['event_date']) . "</p>";
            echo "<p class='card-text'>Location: " . htmlspecialchars($event['location']) . "</p>";
            echo "</div>";
            echo "</div>";
        }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>