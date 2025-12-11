<?php
#event create partial
//check if editing an existing event
$isEditing = isset($_SESSION['edit_event']);
$event = $isEditing ? $_SESSION['edit_event'] : null;
?>

<form action="index.php" method= "post" >
    <h1>Enter Event Details</h1>
    <!-- Hidden input to indicate whether creating or updating an event -->
        <?php if ($isEditing): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($event['id']) ?>">
        <?php endif; ?>

    <div class="mb-3">
        <label for="title" class="form-label">Event Title</label>
        <input type="text" class="form-control" id="title" name="title" value= "<?= htmlspecialchars($event['title'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date</label>                                               <!-- Format date for input field -->
        <input type="date" class="form-control" id="event_date" name="event_date" value= "<?= htmlspecialchars(date('Y-m-d',strtotime($event['event_date'])) ?? '') ?>" required>
    </div>
    <div>
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" value= "<?= htmlspecialchars($event['location'] ?? '') ?>" >
    </div>
    <div class="mb-3">  
        <label for="description" class="form-label">Event Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required> <?= htmlspecialchars($event['description'] ?? '')?></textarea>
    </div>   
    
    <input type="hidden" name="action" value="<?= $isEditing ? 'update' : 'create' ?>">
    <button type="submit" class="btn btn-primary"><?= $isEditing ? 'Update Event' : 'Create Event' ?></button>

</form>

<?php
// Clearing out session editing data after rendering the form
if ($isEditing) {
    unset($_SESSION['edit_event']);
}
?>