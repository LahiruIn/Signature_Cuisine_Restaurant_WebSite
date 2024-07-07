<?php
   
   //Start Session
   session_start();


   //Create constants
   define('SITEURL', 'http://localhost:8080/Signature_cuisine/');
   define('LOCALHOST', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'signature_db');


   $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die (mysqli_error($conn)); //database connection
   $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //select database
   
?>