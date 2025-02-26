
<!--
    File Name: Edit.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->


<?php 


    //start the session that includes the user data
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
  
  
    

</head>

<body style ="
 background-repeat: no-repeat;
 background-image: linear-gradient(to bottom right, #76B0EF, #39DAD0);
 background-size: cover;
 font-size: small;
 font-family: Verdana, Geneva, Tahoma, sans-serif;
 font: bold;">



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



 

<script>
let subMenu = document.getElementById("subMenu"); //let submenu be called by the id submenu
function toggleMe actual functionu() //Then being called
{
    subMenu.classList.toggle("open-menu"); //toggle the open menu css class
}
</script>


 </header>

 <?php 

            //define the inputs when submit button is clicked
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['PASSWORD'];
                $first = $_POST['first_name'];
                $last = $_POST['last_name'];
                $gender = $_POST['gender'];
                $telephone = $_POST['telephone'];         
                $id = $_SESSION['username'];

                //if a photo is entered define the names, and save to file

                if (isset($_FILES['profile_blob'])) {
                    $file_name = $_FILES['profile_blob']['name'];
                    $file_tmp = $_FILES['profile_blob']['tmp_name'];
                    $file_type = $_FILES['profile_blob']['type'];
            
                    // move uploaded file to desired location
                    $upload_directory = 'uploads/';
                    $target_file = $upload_directory . basename($file_name);

                    //sets database to line up with saved image
            
                    if (move_uploaded_file($file_tmp, $target_file)) {
                        // file uploaded
                        mysqli_query($con,"UPDATE users SET profile_blob='$file_name' WHERE username='$id' ") or die(mysqli_error($con));
                    } else {
                        
                    }}


                    //check if username exists
                    $verify_query2 = mysqli_query($con, " SELECT username FROM users WHERE username ='$username'");

                    if(mysqli_num_rows($verify_query2) != 0 && $username != $id){
                        echo "<div class='message'>
                        <p> This Username is used, Try another</p>
                        </div> <br>";
                        echo "<a href ='javascript:self.history.back()' <button class ='btn'> Go Back </button>"; 
                     }else{

                    


              //edit the row with input information query
                $edit_query = mysqli_query($con,"UPDATE users SET username='$username', email='$email', PASSWORD='$password', first_name='$first', last_name='$last', gender='$gender', telephone='$telephone' WHERE username='$id' ") or die(mysqli_error($con));
                mysqli_query($con,"UPDATE vehicle_details SET user_id ='$username' WHERE user_id='$id' ") or die(mysqli_error($con));
                
              //prompt that continues the users experience
                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='home.php'><button class='btn'>Go Home</button></a>";
              $_SESSION['username'] =$username;
                }
                }
               }


                //update current users name, and update all of the information vairables to the recently entered data
                $id = $_SESSION['username'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE username='$id' ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];
                    $res_Pass = $result['PASSWORD'];
                    $res_First = $result['first_name'];
                    $res_Last = $result['last_name'];
                    $res_gender = $result['gender'];
                    $res_telephone = $result['telephone'];
                    $res_profile_blob = $result['profile_blob'];
                } 
            
                
                        // this code sets out input boxes within a white box and sets the default value to the currrent value so the user knows what to edit.
            ?>
       
   <div class="container">



   
        <div class="box form-box">
            <header>Edit user profile</header>
            <form action="Edit.php" method="post" enctype="multipart/form-data">
                <div class="field input ">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" value ="<?php echo $res_Uname; ?>" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="PASSWORD" id="password" autocomplete="off"value ="<?php echo $res_Pass; ?>" required>
                </div>



                <div class="field input">
                    <label for="fname">First Name</label>
                    <input type="text" name="first_name" id="fname" autocomplete="off" value ="<?php echo $res_First; ?>"required>
                </div>

                <div class="field input">
                    <label for="lname">Last Name</label>
                    <input type="text" name="last_name" id="lname" autocomplete="off" value ="<?php echo $res_Last; ?>"required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off"value ="<?php echo $res_Email; ?>" required>
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
                    <input type="tel" name="telephone" id="phone" pattern="[0-9]{12}" autocomplete="off" value ="<?php echo $res_telephone; ?>"
                        required>
                </div>


                <div class="field input">
                    <label for="photo">Upload Photo:</label>
                    <input type="file"name="profile_blob" style="border-color: black; width: 70px; height: 50px; text-align: center; background-color: white; " accept=".jpg,.jpeg,.png" ><br><br>
                </div>


                <div class="field">

                    <input type="submit" class="btn" name="submit" value="Edit" required>
                </div>
                <div class="links">
                    Change Your mind? <a href="home.php">Return</a>
                </div>
            </form>
        </div>

    </div>
</body>
</html>