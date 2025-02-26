<!--
    File Name: AdminLogin.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->
<?php 
//start session 
   session_start();

   
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  
  <style>
    
    body {
      background-repeat: no-repeat;
    background-image: linear-gradient(to bottom right, #76B0EF, #39DAD0);
    background-size: cover;
    height: 100vh;
    }

    button:hover {
      background-color: grey;
    }
  
    </style>
    

</head>

<body style ="
 background-repeat: no-repeat;
 background-image: linear-gradient(to bottom right, #76B0EF, #39DAD0);
 background-size: cover;
 font-size: small;
 font-family: Verdana, Geneva, Tahoma, sans-serif;
 font: bold;">

<?php 

        // set session data
             
             include("php/config.php");
             if(isset($_POST['submit'])){
               $username = mysqli_real_escape_string($con,$_POST['username']);
               $password = mysqli_real_escape_string($con,$_POST['PASSWORD']);

               $result = mysqli_query($con,"SELECT * FROM admin_ WHERE username='$username' AND PASSWORD='$password' ") or die("Select Error");
               $row = mysqli_fetch_assoc($result);

               if(is_array($row) && !empty($row)){
                   $_SESSION['valid'] = $row['username'];
                   $_SESSION['username'] = 'Admin';
                 

                     // Redirect to if login is successful
                     header("Location: AdminHome.php");
                    exit; // Exit after redirection to prevent further execution
                   
               }else{
                   echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
                  echo "<a href='AdminLogin.php'><button class='btn'>Go Back</button>";
        
               }
          
             }else{

           
           ?>

<header >

  <style>
    * /*This applies to all of the site and changes the font*/
     {
        margin: 0; 
        padding: 0;
        font-family: Arial, Helvetica, sans-serif; /*TBD*/
        box-sizing: border-box;
     }
    nav
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
        color: rgb(095, 092, 092);
        font-size: 40;
        font-weight: 400;
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
        max-height: 400px;
    }
    .sub-menu 
    {
        background: #ffff;
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

</style>
  

<script>
let subMenu = document.getElementById("subMenu"); //let submenu be called by the id submenu
function toggleMenu() //The actual function being called
{
    subMenu.classList.toggle("open-menu"); //toggle the open menu css class
}
</script>


 </header>
    
    <div style="font-family:Verdana, Geneva, Tahoma, sans-serif; font-weight: bolder; font-size: 15px;">
<div style ="display: block; height: 60%; width: 500px; margin-left: 40%; background-color: WHITE; text-align: center; margin-top: 10%; border-radius: 30px; box-shadow: 20px 20px 10px rgb(10, 5, 5); margin-bottom: 20%;">
  
<form method ="post" action ="AdminLogin.php">
----Log in----
  <br><br>
  username <br>
  <input type="text" id="fname" name="username"style="border-style: groove; border-top: white; border-left: white; border-right: white;font-family: Verdana, Geneva, Tahoma, sans-serif;"><br><br>
  Password <br> 
  <input type="text" id="fname2" name="PASSWORD"style="border-style: groove; border-top: white; border-left: white; border-right: white;font-family: Verdana, Geneva, Tahoma, sans-serif;"><br><br>

  <br><br>
  <input type="submit" name="submit" value="Login" />
  </form>
</div>
</div>
<?php }?>
</body>
</html>