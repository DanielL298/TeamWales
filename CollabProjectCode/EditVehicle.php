
<!--
    File Name: EditVehicle.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->



<?php 

// session with the current users data
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }

   // parameters for the profile photo so it can be used in  the header
   $id1 = $_SESSION['username'];
   $id = $_SESSION['username'];
   $query = mysqli_query($con,"SELECT*FROM users WHERE username='$id'");

   while($result = mysqli_fetch_assoc($query)){
       $res_pfp = $result['profile_blob'];
   }


   ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>


</head>
<body>
    <style>
        * /*This applies to all of the site and changes the font*/
       {
          margin: 0; 
          padding: 0;
          font-family: Arial, Helvetica, sans-serif; 
          box-sizing: border-box;
       }
      .nav-top
      {
          background: rgb( 110, 179, 205); /*Standard blue we have*/
          width: 100%;
          padding: 10px 10%; /*10px and 10%*/
          display: flex;
          align-items: center; /*start everything from center*/
          justify-content: space-between; /*Dictates how the content will be spaced*/
          position: relative;
      }
      .logo
      {
          width: 75px;
      }
      .user-pic
      {
          width: 50px;
          border-radius: 50%; /*Adds the border to the user pic*/
          cursor: pointer; /*Allows the cursor to */
          margin-left: 30px;
      }
      nav ul /*All of this sectoin only applues to the site name*/
      {
          width: 100%;
          text-align: left;
      }
      nav ul li /*These bits are here if we want to add anything more*/
      {
          display: inline-block;
          list-style: none;
          margin: 10px 20px;
      }
      nav ul li a /*This is what applies to the site title specificly*/
      {
          color: black;
          font-size: 1.78em;
          font-weight: 500;
          text-decoration: none;
      }
      .sub-menu-wrap /*What is applied around the sub menu to gibve it a box */
      {
          position: absolute; /*Possition is pre determined and will never change*/
          top: 100%;
          right: 15%;
          width: 320px;
          max-height: 0px; /*Starts hidden*/
          overflow: hidden; /*Just incase hide overflow from the menu*/
          transition: max-height 0.5s; /*Will change the height over the course of 0.5s*/
      }
      .sub-menu-wrap.open-menu /*When clicked on it will change over to 400px*/
      {
          max-height: 500px;
      }
      .sub-menu 
      {
          background: #ffff;
          border: 2px solid black;
          border-radius: 8px;
          padding: 20px;
          margin: 10px;
      }
      .user-info /*The users username and picture*/
      {
          display: flex;
          align-items: center;
      }
      .user-info h3
      {
          font-weight: 500;
      }
      .user-info img
      {
          width: 60px;
          border-radius: 50%;
          margin-right: 15px;
      }
      .sub-menu hr /*line breaks in the submenu*/
      {
          border: 0;
          height: 3px;
          width: 100%;
          background: #ccc;
          margin: 15px 0 10px;
      }
      .sub-menu-link
      {
          display: flex;
          align-items: center;
          text-decoration: none;
          color: #525252;
          margin: 12px 0;
      }
      .sub-menu-link p
      {
          width: 100%;
      }
      .sub-menu-link img
      {
          width: 40px;
          background: #e5e5e5;
          border-radius: 50%;
          padding: 8px;
          margin-right: 15px;
      }
      .sub-menu-link span /*The > at the end of the links*/
      {
          font-size: 22px;
      }
      .sub-menu-link:hover span /*When hovering over the text and > make it bold*/
      {
          font-weight: 600;
      }
      .sub-menu-link:hover p
      {
          font-weight: 600;
      }
      /*Nav progress bar****************************************************/
      .nav-site-progress
        {
            padding: 4%;
            justify-content: space-between;
            float: left;
            width: 100%;
        }
        .nav-site-progress a
        {
            color: black;
            font-size: 1.2em;
            font-weight: 300;
            transition: font-size 0.3s;
            transition: font-weight 0.3;
        }
        .nav-site-progress a::after 
        {
            content: "|";
            padding: 8px;
            font-size: 1.1em;
        }
        .nav-site-progress a:hover
        {
            font-weight: 400;
            font-size: 1.3em;
        }
        .nav-site-progress hr
        {
          border: 0;
          height: 3px;
          width: 100%;
          background: gray;
          margin: 13px 0 2px;
        }
        /*Start of the actuall site css*************************************/
        h1
        {
            padding: 5%;
        }   
        .foreground
        {
            background-color: rgb(239, 239, 239); 
            width: 80%; 
            height: 80%; 
            margin-left: 9%; 
            transform: translateY(5%);
            border-radius: 5px;
            border: 2px solid black;
        }
        .container 
        {
            display: flex;
            justify-content: space-between;
            width: 98%;
        }
        .column 
        {
            flex: 1;
            padding: 14px;
            box-sizing: border-box;
            height: 100%;
        }
        .caravan-box 
        {
            background-color: white;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
            height: 260px;
            transition: height 0.5s;
        }
        .caravan-box:hover
        {
            height: 270px;
            border: 2px solid black;
            border-radius: 10px;
            cursor: pointer;
        }
        .caravan-title
        {
            font-size: 0.900em;
            font-weight: 400;
            padding: 2%;
        }
        .caravan-box img
        {
            height: 140px;
            width: 100%;
        }
        .sub-text
        {
            font-size: 0.720em;
            font-weight: 100;
            padding-bottom: 2%;
        }
        .view-button
        {
            font-size: 0.800em;
            float: right;
            width: 50%;
            background-color: white;
        }
        button:hover
        {
            background-color: rgb(000, 156, 000);
            color: white;
            cursor: pointer;
        }
        .caravan-box hr
        {
          border: 0;
          height: 2px;
          width: 100%;
          background: #ccc;
          margin: 1px 0 10px;
        }
           .inputs
           {
            margin-left: 15%;
            padding: 2%;
           }
           input
           {
            width: 30%;
            height: 40px;
            margin-right: 15%;
            background-color: white;
            color: #000000;
            padding: 3px;
            border-radius: 10px;
            box-shadow:0 0 15px 4px rgba(0,0,0,0.06);
           }
           .inputs-background
           {
            background-color: rgb(057, 075, 043);
            width: 100%;
            height: 100%
           }
           img
           {
            border-radius: 20px;
            height: 70%;
            width: 100%;
           }
           .submit-button
           {
            width: 80px;
            height: 40px;
           }
   </style>
   

   <?php

include("php/config.php");

//vehicle id session carried from the previous page
$id = $_SESSION['vehicle_id'];

//submit button sets all input variables

 if(isset($_POST['submit'])){

    $vehicleName =$_POST['vehicle_id'];
    $location =$_POST['location'];
    $model =$_POST['vehicle_model'];
    $year =$_POST['year'];
    $bodytype =$_POST['vehicle_bodytype'];
    $doors =$_POST['num_doors'];
    $fuelType =$_POST['fuel_type'];
    $mileage =$_POST['mileage'];


     // define the process for the file upload for the vehicle Image
     if (isset($_FILES['image_url'])) {
        $file_name = $_FILES['image_url']['name'];
        $file_tmp = $_FILES['image_url']['tmp_name'];
        $file_type = $_FILES['image_url']['type'];

        // move uploaded file to desired location
        $upload_directory = 'uploads/vehicles/';
        $target_file = $upload_directory . basename($file_name);

        if (move_uploaded_file($file_tmp, $target_file)) {
            // file  uploaded
            mysqli_query($con, "UPDATE vehicle_details SET image_url = '$file_name' WHERE vehicle_id ='$id'");
            
        } else {
            // failed 
        }}
 

        // checks if the username is used
    $verify_query2 = mysqli_query($con, " SELECT vehicle_id FROM vehicle_details WHERE vehicle_id ='$vehicleName'");

    if(mysqli_num_rows($verify_query2) != 0  && $vehicleName != $id){
        echo "<div class='message'>
        <p> This Vehicle name is used, Try another</p>
        </div> <br>";
        echo "<a href ='javascript:self.history.back()' <button class ='btn'> Go Back </button>"; 
     }else{

     

  
    //checks vehicle id
    $verify_query = mysqli_query($con, "UPDATE vehicle_details SET vehicle_id = '$vehicleName',vehicle_model = '$model',vehicle_bodytype = '$bodytype',fuel_type = '$fuelType', mileage = '$mileage',location = '$location',year = '$year',num_doors = '$doors' WHERE vehicle_id ='$id'");


     // prompt user if they are succesfull
    if($verify_query){
        echo "<div class='message'>
        <p>vehicle Updated!</p>
    </div> <br>";
  echo "<a href='javascript:window.history.go(-2)' class='btn'>Go Back</a>";
        $_SESSION['vehicle_id'] =$vehicleName;

    }
}
 }

 // re set all the vehicle vairables ready to be output 
    
    $id = $_SESSION['vehicle_id'];
    $query = mysqli_query($con,"SELECT*FROM vehicle_details WHERE vehicle_id='$id' ");

    while($result = mysqli_fetch_assoc($query)){
         $res_vehicleName =$result['vehicle_id'];
        $res_location =$result['location'];
        $res_model =$result['vehicle_model'];
        $res_year =$result['year'];
        $res_bodytype =$result['vehicle_bodytype'];
        $res_doors =$result['num_doors'];
        $res_fuelType =$result['fuel_type'];
        $res_milage =$result['mileage'];


    }


?>

<?php 

//navbar only shows if you are a user

if ($id1 != 'Admin' ){

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
        <a href='listView.php'>List View</a>
        <a href='editVehicle.php'>Edit vehicle</a>
       
        <hr>
    </nav>

";

}else {
    echo "admin view";
}



// add caravan input boxes all contained that are auto complete with the current up to date data
?> 
    <div>
        <h1> Add Caravan</h1>
    </div>

    <div class="inputs-background">

        <div class="foreground">     

        <form method="post" action="EditVehicle.php" enctype="multipart/form-data">

            <br>
            <div class ="inputs">
            <input type="text" value ="<?php echo $res_vehicleName; ?>" name ="vehicle_id">
            <input type="text" value ="<?php echo $res_location; ?>" name ="location"><br><br>
            <input type="text" value ="<?php echo $res_model; ?>" name ="vehicle_model">
            <input type="text" value ="<?php echo $res_year; ?>" name ="year"><br><br>
            <input type="text" value ="<?php echo $res_bodytype; ?>" name ="vehicle_bodytype">
            <input type="text" value ="<?php echo $res_doors; ?>" name ="num_doors"><br><br>
            <input type="text" value ="<?php echo $res_fuelType; ?>" name ="fuel_type">
            <input type="text"value ="<?php echo $res_milage; ?>"name ="mileage">
            <br>
            <input type="file"name="image_url" style="border-color: black; width: 70px; height: 50px; text-align: center; background-color: white; " accept=".jpg,.jpeg,.png" ><br><br>
            <input type="submit" name="submit" value="submit" />


    </form>
    </div>
        <br> 
    </div>
    </div>

    
        

    <script>
        let subMenu = document.getElementById("subMenu"); //let submenu be called by the id submenu
        function toggleMenu() //The actual function being called
        {
            subMenu.classList.toggle("open-menu"); //toggle the open menu css class
        }
        </script>

<?php  ?>
</body>

</html>