<?php include('../configer/constants.php'); ?>

<html>
    <head>
        <title>Login - Signature Cuisine</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
          <h1 class="text-center">Login</h1>
          <br><br>

          <?php
            if(isset($_SESSION['login']))
            {
              echo $_SESSION['login'];
              unset($_SESSION['login']);
            } 

            if(isset($_SESSION['no-login-message']))
            {
              echo $_SESSION['no-login-message'];
              unset($_SESSION['no-login-message']);
            }
          
          ?>

          <br><br>

          <!--login form starts-->
          <form action="" method="POST" class="text-center">
          Username: <br>
          <input type="text" name="username" placeholder="Enter Username"> <br><br>

          Password: <br>
          <input type="password" name="password" placeholder="Enter Password"> <br><br>
          
          <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>  
          </form>
          <!--login form end-->

          <p class="text-center">Created By - <a href="Lahiru Induwara">Lahiru Induwara</a></p>
        </div>

    </body>
</html>


<?php 
  
    //submit btn click or not
    if(isset($_POST['submit']))
    {
       //get data login
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //check username password
        $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);


        //count rowscheck user
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //login success
            $_SESSION['login'] = "<div class ='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; //cheak logged or not

            //redirect
            header("location:".SITEURL.'admin/');
        }
        else
        {
            // login faild user not avble
            $_SESSION['login'] = "<div class ='error text-center'>Login Faild. Please cheak username or passwprd did not match.</div>";
            //redirect
            header("location:".SITEURL.'admin/login.php');
        }

    }