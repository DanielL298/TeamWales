<?php 
// carry over session data
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
   header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet">
    <title>Home</title>
</head>
<body>
    

        <div class="right-links">

            <?php 
            
     
            
           
            ?>

            <a href="logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
               
            <a href="sports.php">
      <button id="Admin view" >Sports</button>
      </a> <br>
      
      <a href="events.php">
      <button id="AdminloginButton" >Events</button>
      </a> <br>

      <a href="athletes.php">
      <button id="AdminloginButton" >Athletes</button>
      </a> <br>

      

            </div>
          </div>
       </div>

    </main>
</body>
</html>