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


form
<?php 
// start session with all vehicle and user information related to the current session.
 // Start session
 session_start();

 include("php/config.php");

 // Check if the user is logged in
 if(isset($_SESSION['valid'])){
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






 //processs deleting a row if delete is selected.
if (isset($_POST['delete_sport'])) {
 
  $sport_name = mysqli_real_escape_string($con, $_POST['sport_name']);
  $check_query = mysqli_query($con, "SELECT * FROM sports_info WHERE sport_name='$sport_name'");
 
  if (mysqli_num_rows($check_query) > 0) {
      // deletion query
      $delete_query = mysqli_query($con, "DELETE FROM sports_info WHERE sport_name='$sport_name'");
 
      if ($delete_query) {
          // Redirect to success message
          header("Location: sports.php?message=Sport+deleted+successfully");
          exit;
      } else {
          echo "Error: Unable to delete the sport.";
      }
  } else {
      echo "Sport not found.";
  }
 }





 if (isset($_GET['sport'])) {
  $sport_name = mysqli_real_escape_string($con, $_GET['sport']);
  echo "<h1>Details for $sport_name</h1>";
  // Fetch and display details based on sport_name
} else {
  echo "<h1>No sport selected</h1>";
}

 // get the row specific to the button you clicked
 $query = mysqli_query($con, "SELECT * FROM sports_info WHERE sport_name='$sport_name'");

 // Validate it exists
 if ($result = mysqli_fetch_assoc($query)) {
     
     $sport_id = $result['sport_id'];
     $sport_name = $result['sport_name'];
     $description1 = $result['description_para1'];
     $description2 = $result['description_para2'];
     $athletes = $result['athletes'];
     $medals_won = $result['medals_won'];
 } else {
  
     echo "<h1>Sport not found</h1>";
     exit;
 }


?>









 <!--
    Sport information directly from sql
    -->

<body>
 

  <h1> Description:<?php echo $description1; ?></h1>
  <h1> Description2:<?php echo $description2; ?></h1>
  <h1> Athletes:<?php echo $athletes; ?></h1>
  <h1> Medals won:<?php echo $medals_won; ?></h1>

<a href="javascript:void(0);" onclick="window.history.back();">
      <button id="AdminloginButton" >Return</button>
</a> <br>

<?php 
// --------------- Anything that is displayed differently for an admin goes in here ---------
if ($role == 'Admin') {
  echo '<a href="editSport.php?sport=' . $sport_name . '">
      <button id="sport">
          Edit
      </button>
  </a>
  <br>
  ';
  echo '<form action="sportDisplay.php" method="POST">
  <input type="hidden" name="sport_name" value="' . htmlspecialchars($sport_name) . '">
  <button type="submit" name="delete_sport">Delete</button>
</form>';

}else if ($role =='guest') {
    echo "guest view";
}else {
    echo"member view";
}
?>
</body>

