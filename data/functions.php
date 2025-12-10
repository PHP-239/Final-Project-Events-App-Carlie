<?php
function getEvents($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>