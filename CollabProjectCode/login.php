<!--
    File Name: Login.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->
<?php 
// start session the session details get set on this screen for the rest of a users experience
   session_start();

   include("php/config.php");
   if(isset($_POST['submit'])){
     $email = mysqli_real_escape_string($con,$_POST['email']);
     $password = mysqli_real_escape_string($con,$_POST['PASSWORD']);

    

  

    //if username and password are correct forward the user

   $result = mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND PASSWORD='$password' ") or die("Select Error");
   $row = mysqli_fetch_assoc($result);

   if(is_array($row) && !empty($row)){
       $_SESSION['valid'] = $row['email'];
       $_SESSION['username'] = $row['username'];

         // redirect to home.php if login is successful
         header("Location: home.php");
        exit; 
       
   }else{
    // error message 
       echo "<div class='message'>
         <p>Wrong Username or Password</p>
          </div> <br>";
      echo "<a href='Login.php'><button class='btn'>Go Back</button>";

   }
}else{

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  
  <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            /*TBD*/
            box-sizing: border-box;
        }

        nav {
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
            color: rgb(095, 092, 092);
            font-size: 1.78rem;
            font-weight: 400;
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
            max-height: 400px;
        }

        .sub-menu {
            background: #ffff;
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


        body {
            background: #e4e9f7;
            height: 100vh;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
        }

        .box {
            background: #fdfdfd;
            display: flex;
            flex-direction: column;
            padding: 25px 25px;
            border-radius: 20px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
        }

        .form-box {
            width: 450px;
            margin: 0px 10px;
        }

        .form-box header {
            font-size: 25px;
            font-weight: 600;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
            margin-bottom: 10px;
        }

        .form-box form .field {
            display: flex;
            margin-bottom: 10px;
            flex-direction: column;

        }

        .form-box form .input input {
            height: 40px;
            width: 100%;
            font-size: 16px;
            padding: 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }

        .btn {
            height: 35px;
            background: #18A015;
            border: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s;
            margin-top: 10px;
            padding: 0px 10px;
        }

        .btn:hover {
            opacity: 0.82;
        }

        .submit {
            width: 100%;
        }

        .links {
            margin-bottom: 15px;
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
             
           
           
           ?>

<header>








</header>
<div class="container">
        <div class="box form-box">



            <header>Login</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="PASSWORD" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>




                <div class="field">

                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Not a member? <a href="register.php">Register here</a>
                </div>
            </form>
        </div>

    </div>


   
</body>
<?php }?>
</html>