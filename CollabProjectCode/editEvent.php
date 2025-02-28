<?php 
// Start session
session_start();

include("php/config.php");

// Check if the user is logged in
$role = 'guest'; // Default role
if (isset($_SESSION['valid'])) {
    $id = $_SESSION['username'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE username='$id'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_pfp = $result['profile_blob'];
    }

    $role = $_SESSION['username']; 
}

// Check if event is selected
if (isset($_GET['event'])) {

    // My sqli escape string allows for protection against SQL injection.
    $event_name = mysqli_real_escape_string($con, $_GET['event']);
    $query = mysqli_query($con, "SELECT * FROM events_info WHERE event_name='$event_name'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_id = $result['event_id'];
        $res_name = $result['event_name'];
        $res_sport = $result['sport'];
        $res_location = $result['location'];
        $res_date = $result['event_date'];
        $res_results = $result['results'];
    } else {
        echo "<h1>Event not found</h1>";
        exit;
    }
} else {
    echo "<h1>No event selected</h1>";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $event_Id = mysqli_real_escape_string($con, $_POST['event_id']);
    $event_Name = mysqli_real_escape_string($con, $_POST['event_name']);
    $sport = mysqli_real_escape_string($con, $_POST['sport']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $event_date = mysqli_real_escape_string($con, $_POST['event_date']);
    $results = mysqli_real_escape_string($con, $_POST['results']);

    // Check if event ID exists preventing data redundancy.
    $verify_query2 = mysqli_query($con, "SELECT event_name FROM events_info WHERE event_name ='$event_Name'");

    if (mysqli_num_rows($verify_query2) != 0 && $event_Name != $res_name) {
        echo "<div class='message'>
        <p>This Event Name is already in use, try another</p>
        </div> <br>";
        echo "<a href='javascript:self.history.back();'><button class='btn'>Go Back</button></a>"; 
    } else {
        // SQL queries that Update event details
        $edit_query = mysqli_query($con, "UPDATE events_info  SET event_id='$event_Id', event_name='$event_Name', sport='$sport', location='$location', event_date='$event_date', results='$results' WHERE event_name='$res_name'");

        if ($edit_query) {
            echo "<div class='message'><p>Event Updated!</p></div><br>";
            echo "<a href='home.php'><button class='btn'>Go Home</button></a>";

            // Redirect to the same page after update
            header("Location: events.php?event=" . urlencode($event_Name));
            exit(); 
        } else {
            echo "<div class='message'><p>Error updating event: " . mysqli_error($con) . "</p></div>";
        }
    }
}
?>

<!--
    Html code, all front end elements.
    -->

<body>
<a href="events.php">
    <button id="return">Return</button>
</a><br>

<div class="box form-box">
    <header>Edit Event</header>
    <form action="editEvent.php?event=<?php echo urlencode($res_name); ?>" method="post">
        <div class="field input">
            <label for="event_id">Event ID</label>
            <input type="text" name="event_id" id="event_id" autocomplete="off" value="<?php echo $res_id; ?>" required>
        </div>

        <div class="field input">
            <label for="event_name">Event Name</label>
            <input type="text" name="event_name" id="event_name" autocomplete="off" value="<?php echo $res_name; ?>" required>
        </div>

        <div class="field input">
            <label for="sport">Sport</label>
            <input type="text" name="sport" id="sport" autocomplete="off" value="<?php echo $res_sport; ?>" required>
        </div>

        <div class="field input">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" autocomplete="off" value="<?php echo $res_location; ?>" required>
        </div>

        <div class="field input">
            <label for="event_date">Event Date</label>
            <input type="date" name="event_date" id="event_date" value="<?php echo $res_date; ?>" required>
        </div>

        <div class="field input">
            <label for="results">Results</label>
            <input type="text" name="results" id="results" autocomplete="off" value="<?php echo $res_results; ?>" required>
        </div>

        <div class="field input">
            <input type="submit" name="submit" value="Update Event">
        </div>
    </form>
</div>
</body>
