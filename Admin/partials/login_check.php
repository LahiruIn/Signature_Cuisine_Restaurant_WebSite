<?php
    //authorization
    if(!isset($_SESSION['user']))
    {
        //user  not logged
        $_SESSION['no-login-message'] = "<div class ='error text-center'>Please login to access Admin panel</div>";
        //redirect and msg
        header("location:".SITEURL.'admin/login.php');
    }
?>