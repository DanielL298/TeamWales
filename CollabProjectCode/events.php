<!--
    File Name: eventsListView.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
-->

<?php 
// Start session
session_start();
include("php/config.php");

// Check if the user is logged in
$role = 'guest'; // Default role for guest
if (isset($_SESSION['valid'])) {
    $id = $_SESSION['username'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE username='$id'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_pfp = $result['profile_blob'];
    }

    $role = $_SESSION['username']; // Assign the logged-in user role
}

// Fetch all events from the database
$query = mysqli_query($con, "SELECT * FROM events_info");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Events List</title>
</head>
<body>

<h2>Events List</h2>

<?php while ($row = mysqli_fetch_assoc($query)): ?>
    <a href="eventDisplay.php?event=<?php echo urlencode($row['event_name']); ?>">
        <button id="event_<?php echo $row['event_name']; ?>">
            <?php echo $row['event_name']; ?>
        </button>
    </a>
    <br>
<?php endwhile; ?>

<!-- Return button -->
<a href="javascript:void(0);" onclick="window.history.back();">
    <button id="AdminloginButton">Return</button>
</a> 
<br>

<?php 
// Admin-specific content
if ($role == 'Admin') {
    echo '<a href="addEvent.php">
            <button id="AdminloginButton">Add</button>
          </a><br>';
    echo '<h1> Admin view </h1>';
} elseif ($role == 'guest') {
    echo "guest view";
} else {
    echo "member view";
}
?>

</body>
</html>
