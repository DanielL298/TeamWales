<!--
    File Name: addEvent.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Event</title>
</head>

<body>

<?php
include("php/config.php");

if (isset($_POST['submit'])) {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $sport = $_POST['sport'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $result = $_POST['result'];

    // Check if event ID already exists in the database
    $verify_query = mysqli_query($con, "SELECT event_name FROM events_info WHERE event_name ='$event_name'");

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
        <p> This Event Name is already used, Try another</p>
        </div> <br>";
        echo "<a href ='javascript:self.history.back()'><button class ='btn'> Go Back </button></a>"; 
    } else {
        // Insert the new event into the database
        mysqli_query($con, "INSERT INTO events_info(event_id, event_name, sport, location, event_date, results)
        VALUES('$event_id', '$event_name', '$sport', '$location', '$event_date', '$result')") 
        or die("Error Occured");

        echo "<div class='message'>
        <p> Event Registered Successfully!</p>
        </div> <br>";
        echo "<a href ='events.php'><button class ='btn'> Go Back </button></a>";
    }

} else {
?>

    <div class="container">
        <div class="box form-box">
            <header>Register Event</header>
            <form action="addEvent.php" method="post">
                
                <div class="field input">
                    <label for="event_id">Event ID</label>
                    <input type="text" name="event_id" id="event_id" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="event_name">Event Name</label>
                    <input type="text" name="event_name" id="event_name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="sport">Sport</label>
                    <input type="text" name="sport" id="sport" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="event_date">Event Date</label>
                    <input type="date" name="event_date" id="event_date" required>
                </div>

                <div class="field input">
                    <label for="result">Result</label>
                    <input type="text" name="result" id="result" autocomplete="off">
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register Event">
                </div>

            </form>
        </div>
    </div>

<?php } ?>

</body>
</html>
