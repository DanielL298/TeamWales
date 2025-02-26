<!--
    File Name: index.php
    Author: Computing without design
    Date: Start 01/03/24 - End NA/NA/24
    Version Info: Final- 
    -->



<?php 
// start the session
session_start();

include("php/config.php");




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Team Wales</title>


    
    <style>
        *

     
    </style>


</head>






<body>
    <section>
        <div class="welcome-section">
            <div class="text-container">

                <h6 style="padding-top: 20px;"> Please <a href="login.php">sign in</a> , or <a
                        href="register.php">Register</a> an account with
                    us
                    today!</h6>

               
               
                        <h6>New Customer? <a href="register.php"> Register</a> an account</h6>
                        <div class="buttons">
                            <a href="register.php">
                                <button class="btn">Register</button>
                            </a>
                        </div>
                    </div>

                    <div class="button-container">
                        <h6>Existing Customer? <a href="login.php">Login</a> here</h6>
                        <div class="buttons">
                            <a href="login.php">
                                <button class="btn">Login</button>
                            </a>
                            
                        </div> 

                  
          </div>    
                        
                    </div>
                    <div class="button-container">
                        <h6>Admin? <a href="adminLogin.php">Admin Login</a> here</h6>
                        <div class="buttons">
                            <a href="adminLogin.php">
                                <button class="btn">Admin Login</button>
                            </a>
                    </div>

                </div>
            </div>
            
            


            <h1> continue as guest</h1>
            <a href="sports.php"><button>Sports</button></a>
            <a href="partners.php"><button>Partners</button></a>
            <a href="sports.php"><button>buttton 4</button></a>
       
            

        </div>



           


       



        </section>

        <footer class="footer_section">
           
        </footer>






     


</body>

</html>