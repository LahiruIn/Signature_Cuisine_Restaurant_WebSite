<?php 
    include('../configer/constants.php');
    
    //destory the session
    session_destroy();
    //redirect
    header('location:'.SITEURL.'admin/login.php');

?>