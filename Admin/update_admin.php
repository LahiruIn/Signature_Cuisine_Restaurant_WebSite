<?php include('partials/menu.php'); ?>

<div class="main-content">
     <div class="wrapper">
      <h1>Update Admin</h1>
      <br><br>

      <?php 
        //get id
        $id=$_GET['id'];

        //create sql query
        $sql="SELECT * FROM table_admin WHERE id=$id";

        //execute query
        $res=mysqli_query($conn, $sql);

        //check query executed or not
        if($res==true)
        { 
          //cheak available or not
          $count = mysqli_num_rows($res);
          if($count==1)
          {
            //get details
            //echo "Admin Available";
            $row=mysqli_fetch_assoc($res);

            $full_name = $row['full_name'];
            $username = $row['username'];
          }
          
          else
          {
            //redirect page
            header('location:'.SITEURL.'admin/manage_admin.php');
          }
        }
      ?>

      <form action=""method="POST">

      <table class="tbl-30">
        <tr>
          <td>Full Name:</td>
          <td>
            <input type="text" name="full_name"value="<?php echo $full_name; ?>">
          </td>
        </tr>
       
        <tr>
          <td>Username:</td>
          <td>
            <input type="text" name="username"value="<?php echo $username; ?>">
          </td>
      
        </tr>

        <tr>
          <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="submit" name="submit" value="Update Admin" class="btn-secodary">
          </td>
        </tr>


      </table>

      </form>
     </div>
</div>


<?php 
     //cheak submit btn click or not
     if(isset($_POST['submit']))
     {
        //echo"Button click";
        //get all data
         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];

        //create sql query
        $sql = "UPDATE table_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        //execute query
        $res = mysqli_query($conn, $sql);

        //execute successfull or not
        if($res==true)
        {
          $_SESSION['update']= "<div class='success'> Admin Updated Successfully.</div>";

          //redirect
          header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else
        {
        $_SESSION['update']= "<div class='error'> Admin Updated Failed.Try Again Later.</div>";

        //redirect
        header('location:'.SITEURL.'admin/manage_admin.php');
        }

     }
?>


<?php include('partials/footer.php'); ?>