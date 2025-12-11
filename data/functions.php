<?php

// This function retrieves all events from the database - ordered by date.
// CURDATE() is used to filter events that are today or in the future.
function getEvents($pdo) {
    if (isset($_SESSION['user_id'])) {
        // Admins can see all events, including past ones
        $stmt = $pdo->prepare("SELECT * FROM events ORDER BY event_date ASC");
    }
    else{
        // Regular users see only upcoming events
        $stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getEventById($pdo, $id) {
    // sql to get event by id -  returns event where id matches input id
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function inputEvent($pdo, $event_id, $title, $location, $description) {
    // sql to register user to add new event
    $stmt = $pdo->prepare("
    INSERT INTO events (event_id, title, location, description)
    VALUES (:event_id, :title, :location, :description)
    ");
    return $stmt->execute([
        'event_id' => $event_id,
        'title' => $title,
        'location' => $location,
        'description' => $description
    ]);
}

function register($pdo, $event_id, $name, $email, $registered_at) {
    // sql to register user to event
    $stmt = $pdo->prepare("INSERT INTO registrations(event_id, name, email, registered_at) VALUES (:event_id, :name, :email, :registered_at)");
    //fixed my dyslexia typos to 'registered_at'
    return $stmt->execute([
        'event_id' => $event_id,
        'name' => $name,
        'email' => $email,
        'registered_at' => $registered_at
    ]);
}

function admin_find_by_username(string $username): ?array {
    //fetch user by username
    $pdo = get_pdo();
    // prepare and execute SQL statement to find user by username
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :u");
    $stmt->execute([':u'=>$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

//Get registered users and their event
function getRegistrations($pdo) {
    $stmt = $pdo->prepare("SELECT registrations.*, events.title AS event_title FROM registrations JOIN events ON registrations.event_id = events.id ORDER BY registrations.event_id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function eventDelete(int $id): int
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}

function createEvent($pdo, $title, $event_date, $location, $description) {
    // sql to create new event
    $stmt = $pdo->prepare("INSERT INTO events (title, event_date, location, description) VALUES (:title, :event_date, :location, :description)");
    return $stmt->execute([
        'title' => $title,
        'event_date' => $event_date,
        'location' => $location,
        'description' => $description
    ]);
}

function updateEvent($pdo, $id, $title, $event_date, $location, $description) {
    // sql to update existing event
    $stmt = $pdo->prepare("UPDATE events SET title = :title, event_date = :event_date, location = :location, description = :description WHERE id = :id");
    return $stmt->execute([
        'id' => $id,
        'title' => $title,
        'event_date' => $event_date,
        'location' => $location,
        'description' => $description
    ]);
}
?>