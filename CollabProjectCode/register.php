<!--
    File Name: Register.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->
 

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

<body style="
 background-repeat: no-repeat;
 background-image: linear-gradient(to bottom right, #2F59C5, #6FC6D2);
 background-size: cover;
 font-size: small;
 font-family: Verdana, Geneva, Tahoma, sans-serif;
 font: bold;">

<?php

//define all the 'post' inputs into their own variables.

include("php/config.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['PASSWORD'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // set file name and save file 
    if (isset($_FILES['profile_blob'])) {
        $file_name = $_FILES['profile_blob']['name'];
        $file_tmp = $_FILES['profile_blob']['tmp_name'];
        $file_type = $_FILES['profile_blob']['type'];

        
        $upload_directory = 'uploads/vehicles/';
        $target_file = $upload_directory . basename($file_name);

        if (move_uploaded_file($file_tmp, $target_file)) {
            // uploaded
        } else {
            // Failed 
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        
        echo "Error: No file uploaded.";
    }

    //check if username is already in use as cant have multiple of same.

    $verify_query2 = mysqli_query($con, " SELECT username FROM users WHERE username ='$username'");

    if(mysqli_num_rows($verify_query2) != 0 ){
        echo "<div class='message'>
        <p> This Username is used, Try another</p>
        </div> <br>";
        echo "<a href ='javascript:self.history.back()' <button class ='btn'> Go Back </button>"; 
    }


    else{
       mysqli_query($con,"INSERT INTO users(username,PASSWORD,first_name,last_name,gender,email,telephone,profile_blob)Values('$username','$password','$first_name','$last_name','$gender','$email','$telephone','$file_name')")or die("Error Occured");
          echo "<div class='message'>
        <p> Success</p>
        </div> <br>";
        echo "<a href ='index.php' <button class 'btn'> Go Back </button>";
    
    }   }else{
?>
   


    <div class="container">
        <div class="box form-box">
            <header>Register</header>
            <form action="Register.php" method="post" enctype="multipart/form-data">
                <div class="field input ">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="PASSWORD" id="password" autocomplete="off" required>
                </div>



                <div class="field input">
                    <label for="fname">First Name</label>
                    <input type="text" name="first_name" id="fname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="lname">Last Name</label>
                    <input type="text" name="last_name" id="lname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

           
                <div class="field input">
                    <label for="gender">Gender</label>
                    <div class="radio-group radio-group-inline">
                        <label class="form-check">
                            <input type="radio" name="gender" id="male" autocomplete="off" value="male" required>
                            <span class="form-check-label">Male</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="gender" id="female" autocomplete="off" value="female" required>
                            <span class="form-check-label">Female</span>
                        </label>
                    </div>
                </div>
            

                


                <div class="field input">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="telephone" id="phone" pattern="[0-9]{12}" autocomplete="off"
                        required>
                </div>


                <div class="field input">
                    <label for="photo">Upload Photo:</label>
                    <input type="file"name="profile_blob" style="border-color: black; width: 70px; height: 50px; text-align: center; background-color: white; " accept=".jpg,.jpeg,.png" ><br><br>
                </div>


                <div class="field">

                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Login</a>
                </div>
            </form>
        </div>

    </div>
</body>
<?php } ?>
</html>
