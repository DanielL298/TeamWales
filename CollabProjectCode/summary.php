<!--
    File Name: Summary.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->
<?php 

// start session with all vehicle and user information related to the current session.
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }

   // specifically define the name of the profile photo

   $id = $_SESSION['username'];
   $query = mysqli_query($con,"SELECT*FROM users WHERE username='$id'");

   while($result = mysqli_fetch_assoc($query)){
       $res_pfp = $result['profile_blob'];
   }
?>

<?php 
            // find the sessions vehicle and save each row into a variable
            $vehicleName = $_SESSION['vehicle_id'];
            
          
            $query = mysqli_query($con,"SELECT*FROM vehicle_details WHERE vehicle_id='$vehicleName'");

            while($result = mysqli_fetch_assoc($query)){
                $res_location = $result['location'];
                $res_model = $result['vehicle_model'];
                $res_year = $result['year'];
                $res_bodytype = $result['vehicle_bodytype'];
                $res_doors = $result['num_doors'];
                $res_fuelType = $result['fuel_type'];
                $res_milage = $result['mileage'];
                $user_id =$result['user_id'];
                $book_status =$result['book_status'];


                //find its specific profile photo
                $query2 = mysqli_query($con,"SELECT*FROM vehicle_details WHERE vehicle_id='$vehicleName'");
                while($result = mysqli_fetch_assoc($query2)){
                $res_pfpVehicle = $result['image_url'];
                }


               
            }
            

           
            
            ?>
<?php 

            //set username so it can be added to the caravan details if its booked. and also update the booking boolean.
          $user =  $_SESSION['username'];
 
          
  if(isset($_POST['book'])){

    mysqli_query($con,"UPDATE vehicle_details SET book_status = 1 WHERE vehicle_id = '$vehicleName'");
    mysqli_query($con,"UPDATE vehicle_details SET user_booking = '$user' WHERE vehicle_id = '$vehicleName'");

    echo "<script>window.history.go(-2);</script>";
}

if(isset($_POST['unbook'])){

    mysqli_query($con,"UPDATE vehicle_details SET book_status = 0 WHERE vehicle_id = '$vehicleName'");
    mysqli_query($con,"UPDATE vehicle_details SET user_booking = 0 WHERE vehicle_id = '$vehicleName'");
    echo "<script>window.history.go(-2);</script>";
}

//simple delete query that removes the whole database row when clicked.
if(isset($_POST['delete'])) {
  
    mysqli_query($con,"DELETE FROM vehicle_details WHERE vehicle_id = '$vehicleName'");
    echo "<script>window.history.go(-2);</script>";

}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"></html>

<head>
    <meta charset="utf-8" /> <!--Most up to date charecter set-->
    <title>'caravan title' - RentMyCaravan</title>
    <!--I would like to take the caravan title and put that as teh title of the site-->
</head>
<body>

   


<style>
        *

        /*This applies to all of the site and changes the font*/
            {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        .nav-top {
            background: rgb(110, 179, 205);
            /*Standard blue we have*/
            width: 100%;
            padding: 10px 10%;
            /*10px and 10%*/
            display: flex;
            align-items: center;
            /*start everything from center*/
            justify-content: space-between;
            /*Dictates how the content will be spaced*/
            position: relative;
        }

        .logo {
            width: 75px;
        }

        .user-pic {
            width: 50px;
            border-radius: 50%;
            /*Adds the border to the user pic*/
            cursor: pointer;
            /*Allows the cursor to */
            margin-left: 30px;
        }

        nav ul

        /*All of this sectoin only applues to the site name*/
            {
            width: 100%;
            text-align: left;
        }

        nav ul li

        /*These bits are here if we want to add anything more*/
            {
            display: inline-block;
            list-style: none;
            margin: 10px 20px;
        }

        nav ul li a

        /*This is what applies to the site title specificly*/
            {
            color: black;
            font-size: 1.78em;
            font-weight: 500;
            text-decoration: none;
        }

        .sub-menu-wrap

        /*What is applied around the sub menu to gibve it a box */
            {
            position: absolute;
            /*Possition is pre determined and will never change*/
            top: 100%;
            right: 15%;
            width: 320px;
            max-height: 0px;
            /*Starts hidden*/
            overflow: hidden;
            /*Just incase hide overflow from the menu*/
            transition: max-height 0.5s;
            /*Will change the height over the course of 0.5s*/
            

        }

        .sub-menu-wrap.open-menu

        /*When clicked on it will change over to 400px*/
            {
            max-height: 500px;
            
        }

        .sub-menu {
            background: #ffff;
            border: 2px solid black;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
        }

        .user-info

        /*The users username and picture*/
            {
            display: flex;
            align-items: center;
        }

        .user-info h3 {
            font-weight: 500;
        }

        .user-info img {
            width: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .sub-menu hr

        /*line breaks in the submenu*/
            {
            border: 0;
            height: 3px;
            width: 100%;
            background: #ccc;
            margin: 15px 0 10px;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .sub-menu-link img {
            width: 40px;
            background: #e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }

        .sub-menu-link span

        /*The > at the end of the links*/
            {
            font-size: 22px;
        }

        .sub-menu-link:hover span

        /*When hovering over the text and > make it bold*/
            {
            font-weight: 600;
        }

        .sub-menu-link:hover p {
            font-weight: 600;
        }

        .nav-site-progress {
            padding: 4%;
            justify-content: space-between;
            float: left;
            width: 100%;
        }

        .nav-site-progress a {
            color: black;
            font-size: 1.2em;
            font-weight: 300;
            transition: font-size 0.3s;
            transition: font-weight 0.3;
        }

        .nav-site-progress a::after {
            content: "|";
            padding: 8px;
            font-size: 1.1em;
        }

        .nav-site-progress a:hover {
            font-weight: 400;
            font-size: 1.3em;
        }

        .nav-site-progress hr {
            border: 0;
            height: 3px;
            width: 100%;
            background: gray;
            margin: 13px 0 2px;
        }

        

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;

        }

        .container {
            float: left;
            margin-left: 180px;
            width: 500px;
            height: 600px;
            position: absolute;

        }

        #header {
            margin-bottom: 40px;
        }

        .image-container {
            width: 500px;
            height: 550px;
            overflow: hidden;
            /* Ensure the image doesn't overflow the container */
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .container2 {
            right: 0%;
            margin-right: 150px;
            margin-top: 80px;
            width: 450px;
            height: 600px;
            position: absolute;
            z-index: -1;


        }

        .container2 #title {
            margin-bottom: 50px;
            text-align: center;

        }

        .container2 p {
            margin-bottom: 25px;
            font-weight: 600;

        }

        .buttons {
            text-align: center;
            margin-top: 40px;

        }

        .field {
            display: inline-block;
            /* Display buttons inline */
            margin: 40px;
            /* Add some space between buttons */
        }

        .btn {
            height: 35px;
            border: 0;
            width: 80px;
            border-radius: 5px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            transition: all .3s;
            margin-top: 10px;
            padding: 0px 10px;

        }



        .footer_section {
            background-color: #435334;
            color: #ffffff;
            padding: 20px;
            margin-top: 800px;
            max-height: 200px;


        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }


        .contact_info {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 30px;
            max-width: 200px;
           
        }

        #contact_us {
            margin-bottom: 20px;

        }

        .contact_info p{
            margin-bottom: 10px;
        }

        .links {
            display: flex;
            flex-direction: column;
            margin-right: 700px;
            margin-top: 30px;
        }

        .links a {
            color: #fff;
            align-content: center;
            text-decoration: none;
            padding: 5px 10px;
        }

        .links a:hover {
            color: darkgrey;
        }



        .footer__copy {
            margin-top: 10px;
            float: right;

        }


    </style>


<?php 

// omit navbar for admins its not needed
if ($id != 'Admin' ){

            echo "
<nav class='nav-top'>
        <img src='images/Logo.PNG' class='logo'> <!--The logo-->
        <ul>
            <li><a href='index.php'>RentmyCaravan.io</a></li> <!--The site title, able to be clicked to go back to the main menu-->
        </ul>
        
        <img src='uploads/$res_pfp' class='user-pic' onclick='toggleMenu()'> <!--Triggers the script to transition to the submenu-->
        <div class='sub-menu-wrap' id='subMenu'> <!--Surounds the submenu-->
            <div class='sub-menu'> <!--The actual submenu-->
                <div class='user-info'> <!--Anything to do with the user like profile pic and username-->
                    <img src='uploads/$res_pfp'>
                    <h2>$id</h2>
                </div>
                <hr> <!--A break line-->
                <a href='listView.php' class='sub-menu-link'> <!--Where it links to-->
                    <img src='images/list.PNG'> <!--The image for it-->
                    <p>List view</p> <!--What the user sees-->
                    <span>></span> <!--Makes it look nicer as a line-->
                </a>
                <a href='addScreen.php' class='sub-menu-link'>
                    <img src='images/+.PNG'>
                    <p>Add a caravan</p>
                    <span>></span>
                </a>
                <a href='home.php' class='sub-menu-link'>
                    <img src='images/empty profile.PNG'>
                    <p>Profile</p>
                    <span>></span>
                </a>
                <hr>
                
                <a href='index.php' class='sub-menu-link'>
                    <img src='images/signout.PNG'>
                    <p>Sign out</p>
                    <span>></span>
                </a>
                <hr>
            </div>
        </div>
    </nav>

    
    <nav class='nav-site-progress'>
        <a href='index.php'>Main Menu</a>
        <a href='home.php'>Home</a>
        <a href='addScreen.php'>Add caravan</a>
        <a href='listView.php'>List View</a>
       
        <hr>
    </nav>

";

}else {
    echo "admin view";
}

?> 
    
   
</header>

<section>
<div class="container">
            <div id="header">
                <h1>Caravan Summary</h1>
            </div>
            <div class="image-container">
                <img src="uploads/vehicles/<?php echo$res_pfpVehicle;?>">
            </div>
        </div>





<?php echo  "<div class='container2'>" ?>
<?php echo "<h1 id= 'title'> Title: $vehicleName</h1>" ?>
<br>
<?php echo "<p>Vehicle model: $res_model</p>" ?>
<br>
<?php echo "<p>Vehicle Body type: $res_bodytype</p>" ?>
<br>
<?php echo "<p>Fuel type: $res_fuelType</p>" ?>
<br>
<?php echo "<p>Milage: $res_milage</p>" ?>
<br>
<?php echo "<p>Location: $res_location</p>" ?>
<br>
<?php echo "<p>Year: $res_year</p>" ?>
<br>
<?php echo "<p>Number of doors: $res_doors</p>" ?>
<br>
<?php echo" </div>" ?>


<div class="buttons">



        <?php 
        

    // only show edit and delete buttons if you are an admin or you are the original user that listed the caravan.
        if ($_SESSION['valid'] === 'Admin'|| $_SESSION['username'] === $user_id ) {
        echo
            "
            <div class='field'>
            <a href='editVehicle.php'>
            <input type='submit' class='btn' name='submit' value='Edit' style='background-color: #18A015;'
                required>
                </a>
        </div>

        <form  id ='delete' action='Summary.php' method='post'>
        <div class='field'>
            <input type='submit' class='btn' name='delete' value='Delete' style='background-color: rgba(255, 0, 0, 0.726);'
                required>
        </div>
        </form>
      
        </form>

   
            ";


        }

        // only show book if book status is = to 0 (false)

       
        if ($book_status === "0"){

            echo "
            <form  id ='book' action='Summary.php'method='post'>
            <div class='field'>
                <input type= 'hidden'>
                <input type='submit' class='btn' name='book' value='Book' style='background-color: rgba(255, 0, 0, 0.726);'
                    required>
            </div>
            ";
        }

        // only show unbook if book status is 1 (true)

        if ($book_status === "1"){

            echo "

            <form  id ='book' action='Summary.php' method='post'>
            <div class='field'>
                <input type= 'hidden'>
                <input type='submit' class='btn' name='unbook' value='unbook' style='background-color: rgba(255, 0, 0, 0.726);'
                    required>
            </div>
            </form>


            </div>

            </div> 

            ";
            
        }
        
        ?>



    
  
              
    </section>
        <footer class="footer_section">
        <div class="footer-content">
            <div class="contact_info">
                <h3 id="contact_us">Contact Us</h3>
                <p >rentmycaravan.io@gmail.com</p>
                <p >+44 20 1234 5678</p>
            </div>

            <div class="links">
                
                <a href="Main menu.html">Main Menu</a>
                <a href="about.html">About</a>
                <a href="addScreen.html">Add Caravan</a>
                <a href="listView.html">List View</a>
            </div>
        </div>

        <div>
            <p class="footer__copy">&#169; RentMyCaravan.io. All rights reserved</p>
        </div>
    </footer>

<script>
    let subMenu = document.getElementById("subMenu"); //let submenu be called by the id submenu
    function toggleMenu() //The actual function being called
    {
        subMenu.classList.toggle("open-menu"); //toggle the open menu css class
    }
    </script>

</body>
</html>