<form action="index.php" method= "post" >
    enter event details:
    <div class="mb-3">
        <label for="title" class="form-label">Event Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date</label>
        <input type="date" class="form-control" id="event_date" name="event_date" required>
    </div>
    <div class="mb-3">  
        <label for="description" class="form-label">Event Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>      
    <input type="hidden" name="action" value="create">
    <button type="submit" class="btn btn-primary">Create Event</button>

</form>