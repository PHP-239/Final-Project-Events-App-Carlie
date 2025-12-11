<?php
// index.php

require_once 'data/db.php';
require_once 'data/functions.php';


session_start();


function require_login(): void {
    //check if user session exists or is empty
    if (empty($_SESSION['user_id'])) {
        //if $_SESSION['user_id'] is not set or empty, redirect to login page
        header('Location: ?view=login');
        exit;
    }
}


// Get view and action from request
$view = filter_input(INPUT_GET, 'view') ?: 'list';
$action = filter_input(INPUT_POST, 'action');

// Defined public views and actions
$public_views   = ['login', 'list', 'register','registered','event_details'];
$public_actions = ['login', 'register', 'event_details'];

if ($action && !in_array($action, $public_actions, true)) {
    require_login();
}

if (!$action && !in_array($view, $public_views, true)) {
    require_login();
}

$pdo = get_pdo();
// //print_r($pdo);


switch ($action){
    case 'login':
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if ($username && $password) {
            
            //call user_find_by_username function from functions.php-- see functions.php for details
            $admin = admin_find_by_username($username);
            //verify password using password_verify
            if ($admin && password_verify($password, $admin['password_hash'])) {
                $_SESSION['user_id'] = (int)$admin['id'];
                $view = 'list';
            } else {
                $login_error = "Invalid username or password.";
                $view = 'login';
            }
        } else {
            $login_error = "Enter both fields.";
            $view = 'login';
        }
        break;
    case 'register':
        // show registration form
        $view = 'register';
        break;
    case 'registered':
        // Handle registration confirmation action
        if (!isset($_POST['event_id'], $_POST['name'], $_POST['email'])) {
            echo "<p class='text-danger'>All fields are required.</p>";
            $view = 'register';
            break;
        }else{
            register($pdo,
            filter_input(INPUT_POST, 'event_id', FILTER_VALIDATE_INT),
            htmlspecialchars(trim((string)($_POST['name'] ?? ''))),
            htmlspecialchars(trim((string)($_POST['email'] ?? ''))),
            //get current date and time for registration timestamp
            date('Y-m-d H:i:s'));
            $view = 'registered';
        }
        
        break;
    case 'event_details':
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
    case 'logout':
        $_SESSION = [];
        session_destroy();
        session_start();
        $view = 'login';
        break;

    case 'delete':
        $eventId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($eventId) {
            $deletedRows = eventDelete($eventId);
            if ($deletedRows > 0) {
                $view = 'list';
            } else {
                echo "<p class='text-danger'>Event not found or could not be deleted.</p>";
            }
        } else {
            echo "<p class='text-danger'>Invalid event ID.</p>";
        }
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
        //$events = getEvents($pdo);
        include 'partials/public.php';
    }else if ($view === 'event_details') {
        include 'partials/event_details.php';
    }else if ($view === 'register') {
        include 'partials/event-registration.php';
    } else if ($view === 'registered') {
        include 'partials/registration_confirmation.php';
    }else if ($view === 'login') {
        include 'partials/admin-login.php';
    }else if ($view === 'registrations') {
        
        include 'partials/registrations.php';
    }
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>