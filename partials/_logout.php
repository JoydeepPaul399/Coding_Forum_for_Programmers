<?php
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo "Please wait we are logging you out there";
    session_unset();
    session_destroy();
    header("location: /forum/index.php");
    exit();
    
}

else{
    header("location: /forum/index.php");   
}




?>