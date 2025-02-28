<!--
    File Name: eventDisplay.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->
<!--
    CSS goes directly below in the Head section
    -->

    <head>
<style>

</style>

</head>

<?php 
// Start session
session_start();

include("php/config.php");

// Check if the user is logged in
if (isset($_SESSION['valid'])) {
    $id = $_SESSION['username'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE username='$id'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_pfp = $result['profile_blob'];
    }

    $role = $_SESSION['username']; 
} else {
    $role = 'guest'; 
    // Assign guest role if no session
}

// Process deleting an event if delete is selected.
if (isset($_POST['delete_event'])) {
    $event_id = mysqli_real_escape_string($con, $_POST['event_id']);
    $check_query = mysqli_query($con, "SELECT * FROM events_info WHERE event_name='$event_id'");

    if (mysqli_num_rows($check_query) > 0) {
        // Deletion query
        $delete_query = mysqli_query($con, "DELETE FROM events_info WHERE event_name='$event_id'");

        if ($delete_query) {
            // Redirect to success message
            header("Location: events.php?message=Event+deleted+successfully");
            exit;
        } else {
            echo "Error: Unable to delete the event.";
        }
    } else {
        echo "Event not found.";
    }
}

if (isset($_GET['event'])) {
    $event_id = mysqli_real_escape_string($con, $_GET['event']);
    echo "<h1>Details for Event ID: $event_id</h1>";
    // Fetch and display details based on event_id
} else {
    echo "<h1>No event selected</h1>";
    exit;
}

// Get the row specific to the button clicked
$query = mysqli_query($con, "SELECT * FROM events_info WHERE event_name='$event_id'");

// Validate it exists
if ($result = mysqli_fetch_assoc($query)) {
    $event_name = $result['event_name'];
    $sport = $result['sport'];
    $location = $result['location'];
    $event_date = $result['event_date'];
    $result_info = $result['results'];
} else {
    echo "<h1>Event not found</h1>";
    exit;
}
?>

<!--
    Event information directly from SQL
-->
<body>

  <h1> Event Name: <?php echo $event_name; ?></h1>
  <h1> Sport: <?php echo $sport; ?></h1>
  <h1> Location: <?php echo $location; ?></h1>
  <h1> Date: <?php echo $event_date; ?></h1>
  <h1> Result: <?php echo $result_info; ?></h1>

<a href="javascript:void(0);" onclick="window.history.back();">
      <button id="AdminloginButton">Return</button>
</a> <br>

<?php 
// --------------- Admin-specific content ---------
if ($role == 'Admin') {
    echo '<a href="editEvent.php?event=' . $event_id . '">
      <button id="event">
          Edit
      </button>
  </a>
  <br>
  ';
    echo '<form action="eventDisplay.php" method="POST">
  <input type="hidden" name="event_id" value="' . htmlspecialchars($event_id) . '">
  <button type="submit" name="delete_event">Delete</button>
</form>';
} else if ($role == 'guest') {
    echo "guest view";
} else {
    echo "member view";
}
?>
</body>

