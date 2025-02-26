


<?php
    // this no matter where you are in the programme logs you out 
session_start();
session_unset();
session_destroy(); 
header("Location: index.php"); 
exit();
?>