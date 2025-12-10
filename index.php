<?php
// index.php

require_once 'data/db.php';
require_once 'data/functions.php';


session_start();

$view = filter_input(INPUT_GET, 'view') ?: 'list';
$action = filter_input(INPUT_POST, 'action');

$pdo = get_pdo();
// //print_r($pdo);


switch ($action){
    case 'login':
        // Handle login action
        break;
    case 'event_register':
        // Handle event registration action
        break;
    case 'admin_login':
        // Handle admin login action
        break;
    case 'view_event':
        $eventId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($eventId) {
            $event = getEventById($pdo, $eventId);
            if ($event) {
                $r = $event; // to match variable used in partial
                //Had to move event up here wasn't being called down there! aaaaaa!
                $view = 'event_details';
            } else {
                echo "<p class='text-danger'>Event not found.</p>";
            }
        } else {
            echo "<p class='text-danger'>Invalid event ID.</p>";
        }
        break;
    default:
        $view = 'list';
        break;
}



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
    <?php
    include 'components/nav.php';
    if ($view === 'list') {
        $events = getEvents($pdo);
        include 'partials/public.php';
    }else if ($view === 'event_details') {
        include 'partials/event_details.php';
    }
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>