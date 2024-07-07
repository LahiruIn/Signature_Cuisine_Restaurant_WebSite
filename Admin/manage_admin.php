<?php include('partials/menu.php'); ?>

    <!--Main content section strat-->
    <div class="main-content">
      <div class="wrapper">
          <h1>Manage Admin</h1>
          <br /><br />

          <?php
              if(isset($_SESSION['add']))
              {
                echo $_SESSION['add']; //display msg
                unset($_SESSION['add']); // remove msg
              }

              if(isset($_SESSION['delete']))
              {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
              }

              if(isset($_SESSION['update']))
              {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
              }

              if(isset($_SESSION['user-not-found']))
              {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
              }

              if(isset($_SESSION['pwd-not-match']))
              {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
              }

              if(isset($_SESSION['change-pwd']))
              {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']); 
              }

          ?>
          <br><br><br>

          <!--Add admin button-->
          <a href="add_admin.php" class="btn-primary">Add Admin</a>

          <br /><br /><br />

          <table class="tbl-full">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Actions</th>
            </tr>


            <?php 
            //Query to get all admin
            $sql = "SELECT * FROM table_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //cheak the Query is executed of not
            if($res == TRUE)
            {
              //Count Row to cheak
              $count = mysqli_num_rows($res);

              $sn=1; //create variable assign value

              if ($count>0)
                 {
                  //database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                      //get data
                      $id=$rows['id'];
                      $full_name=$rows['full_name'];
                      $username=$rows['username']

                      //Display value table
                      ?>
                      <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo $full_name; ?></td>
                          <td><?php echo $username; ?></td>
                          <td>
                              <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>"class="btn-primary">Change Password</a>
                              <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>"class="btn-secodary">Update Admin</a>
                              <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-third">Delete Admin</a>
                          </td>
                      </tr>

                      <?php 
                      
                    }
                 }
                 else
                 {
                  //Do not have data
                  
                 }
            }
          ?>

          </table>


      </div>
    </div>
    <!--Main content section end-->

<?php include('partials/footer.php') ?>