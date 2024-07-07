<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
     <h1>Manage Food</h1>
     <br /><br />

     <?php 
              
        if(isset($_SESSION['add']))
        {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
           echo $_SESSION['delete'];
           unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload']))
        {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize']))
        {
           echo $_SESSION['unauthorize'];
           unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['update']))
        {
           echo $_SESSION['update'];
           unset($_SESSION['update']);
        }

     ?>

     <br><br>
          <!--Add admin button-->
          <a href="<?php echo SITEURL; ?>admin/add_food.php" class="btn-primary">Add Food</a>

          <br /><br /><br />

          <table class="tbl-full">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Price</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Action</th>
            </tr>

            <?php 
                 //create sql query get all food
                 $sql = "SELECT * FROM table_food";

                 //execute query
                 $res = mysqli_query($conn, $sql);

                 //check have food or not
                 $count = mysqli_num_rows($res);

                 //create id num variable
                 $sn=1;

                 if($count>0)
                 {             
                    //have data
                    while($row=mysqli_fetch_array($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                              <?php
                                    //cheak have image or not
                                    if($image_name=="")
                                    {
                                        //not have image display error msg
                                        echo "<div class='error'>Image not Added.</div>";
                                    }     
                                    else
                                    {
                                        //have image
                                        ?>
                                        <img src = "<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }                            
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"class="btn-secodary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"class="btn-third">Delete Food</a>
                             </td>
                        </tr>

                        <?php
              
                    }
                 }
                 else
                 {
                    //Food not have
                    echo "<tr><td colspan='7' class='error'> Food not Added Yet.</td></tr>"; 
                 }
            ?>

            

          </table>
    </div>
</div>

<?php include('partials/footer.php') ?>