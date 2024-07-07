<?php include('partials/menu.php') ?>


<div class="main-content">
      <div class="wrapper">
          <h1>Add Admin</h1>
          <br /><br />

          <?php 
              if(isset($_SESSION['add'])) //cheaking
              {
                echo $_SESSION['add'];  //Display session msg
                unset($_SESSION['add']);//Remove session msg
              }
          ?>

          <form action="" method="POST">

                <table class="tbl-30">
                  <tr>
                    <td>Full Name: </td>
                    <td>
                      <input type="text" name="full_name" placeholder="Enter Your Full Name">
                    </td>
                  </tr>

                  <tr>
                    <td>Username: </td>
                    <td>
                      <input type="text" name="username" placeholder="Your Username">
                    </td>
                  </tr>

                  <tr>
                    <td>Password :</td>
                    <td>
                      <input type="password" name="password" placeholder="Your Password">
                    </td>
                  </tr>
                  <br>

                  <tr>
                    <td colspan="2">
                      <input type="submit" name="submit" value="Add Admin" class="btn-secodary">
                    </td>
                  </tr>

                </table>

          </form>
      </div>
  </div>

<?php include('partials/footer.php'); ?>


<?php
  //process the value from and save it in database
  //Cheak whether the submit button is clicked or not

  if (isset($_POST['submit'])) 
  {
    //button clicked
    //echo "Button Clicked";

    //Get the data from from
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //password encrytion

    //SQL Query to save the data into database
    $sql = "INSERT INTO table_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";

    //Executeing Query
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //check data is inserted or not display
    if($res==TRUE)
    {
      //data inserted
      //echo "Data Inserted";
      //Create a Session Variable to Display Msg
      $_SESSION['add'] = "Admin Added Successfully";
      //redirect page to manage admin
      header("location:".SITEURL.'admin/manage_admin.php');

    }
    else
    {
      //Failed to Insert data
      //echo "Failed to Insert Data";
      //Create a Session Variable to Display Msg
      $_SESSION['add'] = "Failed to Add Admin. Try Again";
      //redirect page to manage admin
      header("location:".SITEURL.'admin/add_admin.php');
    }

  }

?>
  