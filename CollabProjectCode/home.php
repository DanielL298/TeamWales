<!--
    File Name: home.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->
<?php 

//start the session with all of the user information.
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <style>
        

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
            margin: 20px 10px;
            margin-bottom: 20px;
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


        .form-box form .field label {
            font-size: 16px;
            margin-bottom: 5px;
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

        .radio-group {
            display: flex;
            flex-direction: column;
             
        }

        .radio-group label {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .radio-group-inline {
            display: flex;
            flex-direction: row;
             /*Arrange items horizontally */
        }

        
        .radio-group input[type="radio"] {
            margin-right: 50px;
             /*Adjust as needed */
        }

        .radio-group input[type="radio"] .form-check-label {
            margin: 0px;
            /* Adjust as needed */
        }

        



      

        .submit {
            width: 100%;
        }

        .links {
            margin-bottom: 15px;
        }
        button {
            background-color: #33A1FF; 
            color: white; 
            border: 2px solid #33A1FF;
            border-radius: 15px;
            margin-top: 5px; 
            height: 50px;
            margin-left: 40%;
            width:100px;
        }
        button:hover {
            opacity: 0.8;
        }

    </style>


</head>

<body style="
 background-repeat: no-repeat;
 background-image: linear-gradient(to bottom right, #2F59C5, #6FC6D2);
 background-size: cover;
 font-size: small;
 font-family: Verdana, Geneva, Tahoma, sans-serif;
 font: bold;">

<?php

        // set all of the variables to be accessed
           
           $id = $_SESSION['username'];
           $query = mysqli_query($con,"SELECT*FROM users WHERE username='$id'");

           while($result = mysqli_fetch_assoc($query)){
               $res_Uname = $result['username'];
               $res_email = $result['email'];
               $res_pfp = $result['profile_blob'];
               $res_first =$result['first_name'];
               $res_Last =$result['last_name'];
               
              
           }
           
         


?>
   


    <div class="container">
        <div class="box form-box">
            <header>Welcome <?php echo $res_Uname?></header>

            <img src="uploads/<?php echo $res_pfp; ?>" alt="Uploaded Image"  class="pfp" style ="height: 150px; width: 150px; margin-left: 35%; border-radius: 30px;">


            <a href='edit.php'><button>Change profile</button></a>
            <a href="sports.php"><button>Sports</button></a>
            <a href="partners.php"><button>Partners</button></a>
            <a href="screen.php"><button>buttton 4</button></a>

            <a href="logout.php"><button>Log Out</button></a><br>
            

            
            
            </form>
        </div>

    </div>
</body>
<?php  ?>
</html>
