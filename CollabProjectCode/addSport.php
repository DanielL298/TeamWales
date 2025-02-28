<!--
    File Name: Register.php
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

<!DOCTYPE html>
<html lang="en">

<head>
   
   <style>
   </style>

</head>

<body >

<?php

//define all the 'post' inputs into their own variables.
include("php/config.php");

if (isset($_POST['submit'])) {
    $sport_id = $_POST['sport_id'];
    $sport_name = $_POST['sport_name'];
    $description1 = $_POST['description_para1'];
    $description2 = $_POST['description_para2'];
    $athletes = $_POST['athletes'];
    $medals_won = $_POST['medals_won'];

    // Check if sport ID already exists in the database
    $verify_query2 = mysqli_query($con, "SELECT sport_name FROM sports_info WHERE sport_name ='$sport_name'");

    if (mysqli_num_rows($verify_query2) != 0) {
        echo "<div class='message'>
        <p> This Sport Name is already used, Try another</p>
        </div> <br>";
        echo "<a href ='javascript:self.history.back()'><button class ='btn'> Go Back </button></a>"; 
    } else {
        // Insert the new sport into the database (without image)
        mysqli_query($con, "INSERT INTO sports_info(sport_id, sport_name, description_para1, description_para2, athletes, medals_won)
        VALUES('$sport_id', '$sport_name', '$description1', '$description2', '$athletes', '$medals_won')") 
        or die("Error Occured");

        echo "<div class='message'>
        <p> Sport Registered Successfully!</p>
        </div> <br>";
        echo "<a href ='sports.php'><button class ='btn'> Go Back </button></a>";
    }

} else {
?>

    <div class="container">
        <div class="box form-box">
            <header>Register Sport</header>
            <form action="addSport.php" method="post">
                
                <div class="field input ">
                    <label for="sport_id">Sport ID</label>
                    <input type="text" name="sport_id" id="sport_id" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="sport_name">Sport Name</label>
                    <input type="text" name="sport_name" id="sport_name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="description_para1">Description</label>
                    <input type="text" name="description_para1" id="description_para1" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="description_para2">Description 2</label>
                    <input type="text" name="description_para2" id="description_para2" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="athletes">Athletes</label>
                    <input type="text" name="athletes" id="athletes" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="medals_won">Medals Won</label>
                    <input type="text" name="medals_won" id="medals_won" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register Sport" required>
                </div>

            </form>
        </div>
    </div>

<?php } ?>

</body>
</html>
