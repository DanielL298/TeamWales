
<!--
    File Name: Edit.php
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
$role = 'guest'; // Default role
if (isset($_SESSION['valid'])) {
    $id = $_SESSION['username'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE username='$id'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_pfp = $result['profile_blob'];
    }

    $role = $_SESSION['username']; 
}

// Check if sport is selected
if (isset($_GET['sport'])) {

    // My sqli escape string allos for protection against SQL injection.
    $sport_name = mysqli_real_escape_string($con, $_GET['sport']);
    $query = mysqli_query($con, "SELECT * FROM sports_info WHERE sport_name='$sport_name'");

    if ($result = mysqli_fetch_assoc($query)) {
        $res_id = $result['sport_id'];
        $res_name = $result['sport_name'];
        $res_desc1 = $result['description_para1'];
        $res_desc2 = $result['description_para2'];
        $athletes = $result['athletes'];
        $medals_won = $result['medals_won'];
    } else {
        echo "<h1>Sport not found</h1>";
        exit;
    }
} else {
    echo "<h1>No sport selected</h1>";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $sport_Id = mysqli_real_escape_string($con, $_POST['sport_id']);
    $sport_Name = mysqli_real_escape_string($con, $_POST['sport_name']);
    $description1 = mysqli_real_escape_string($con, $_POST['description_para1']);
    $description2 = mysqli_real_escape_string($con, $_POST['description_para2']);
    $athletes = mysqli_real_escape_string($con, $_POST['athletes']);
    $medals = mysqli_real_escape_string($con, $_POST['medals_won']);

    // Check if sport name exists preventing data redundancy.
    $verify_query2 = mysqli_query($con, "SELECT sport_name FROM sports_info WHERE sport_name ='$sport_Name'");

    if (mysqli_num_rows($verify_query2) != 0 && $sport_Name != $res_name) {
        echo "<div class='message'>
        <p>This Sport Name is already in use, try another</p>
        </div> <br>";
        echo "<a href='javascript:self.history.back();'><button class='btn'>Go Back</button></a>"; 
    } else {
        // SQL queries that Update sport details
        $edit_query = mysqli_query($con, "UPDATE sports_info 
            SET sport_id='$sport_Id', sport_name='$sport_Name', description_para1='$description1', 
                description_para2='$description2', athletes='$athletes', medals_won='$medals' 
            WHERE sport_id='$res_id'");

        if ($edit_query) {
            echo "<div class='message'><p>Sport Updated!</p></div><br>";
            echo "<a href='home.php'><button class='btn'>Go Home</button></a>";

            // Redirect to the same page after update
            header("Location: editSport.php?sport=" . urlencode($sport_Name));
            exit(); 
        } else {
            echo "<div class='message'><p>Error updating sport: " . mysqli_error($con) . "</p></div>";
        }
    }
}

?>

<!--
    Html code, all front end elements.
    -->


<body>
<a href="sports.php">
    <button id="return">Return</button>
</a><br>

<div class="box form-box">
    <header>Edit Sport</header>
    <form action="editSport.php?sport=<?php echo urlencode($res_name); ?>" method="post">
        <div class="field input">
            <label for="sport_id">Sport ID</label>
            <input type="text" name="sport_id" id="sport_id" autocomplete="off" value="<?php echo $res_id; ?>" required>
        </div>

        <div class="field input">
            <label for="sport_name">Sport Name</label>
            <input type="text" name="sport_name" id="sport_name" autocomplete="off" value="<?php echo $res_name; ?>" required>
        </div>

        <div class="field input">
            <label for="description_para1">Description</label>
            <input type="text" name="description_para1" id="description_para1" autocomplete="off" value="<?php echo $res_desc1; ?>" required>
        </div>

        <div class="field input">
            <label for="description_para2">Description 2</label>
            <input type="text" name="description_para2" id="description_para2" autocomplete="off" value="<?php echo $res_desc2; ?>" required>
        </div>

        <div class="field input">
            <label for="athletes">Athletes</label>
            <input type="text" name="athletes" id="athletes" autocomplete="off" value="<?php echo $athletes; ?>" required>
        </div>

        <div class="field input">
            <label for="medals_won">Medals Won</label>
            <input type="text" name="medals_won" id="medals_won" autocomplete="off" value="<?php echo $medals_won; ?>" required>
        </div>

        <div class="field input">
            <input type="submit" name="submit" value="Update Sport">
        </div>
    </form>
</div>
</body>
