<?php
// Script to connect to the database 
$servername="localhost";
$username="root";
$password="";
$dbname="idiscuss";

$conn= mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Unable to connect ". mysqli_connect_error());
}

else{

}

?>