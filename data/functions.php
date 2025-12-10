<?php

// This function retrieves all upcoming events from the database
function getEvents($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM events ORDER BY event_date ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getEventById($pdo, $id) {
    // sql to get event by id -  returns event where id matches input id
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function inputEvent($pdo, $eventId, $title, $location, $description) {
    // sql to register user to add new event
    $stmt = $pdo->prepare("INSERT INTO events (id, title, location, description) VALUES (:event_id, :title, :location, :description)");
    return $stmt->execute([
        'event_id' => $eventId,
        'title' => $title,
        'location' => $location,
        'description' => $description
    ]);
}

function register($pdo, $eventId, $name, $email, $registred_at) {
    // sql to register user to event
    $stmt = $pdo->prepare("INSERT INTO registrations(id, eventId, name, email, register_at) VALUES (:event_id, :name, :email, :registered_at)");

    return $stmt->execute([
        'event_id' => $eventId,
        'name' => $name,
        'email' => $email,
        'registered_at' => $registred_at
    ]);
}
?>