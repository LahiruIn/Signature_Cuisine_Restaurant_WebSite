<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
     <h1>Manage Category</h1>

     <br /><br />

     <?php 
              
        if(isset($_SESSION['add']))
        {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))
        {
           echo $_SESSION['remove'];
           unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete']))
        {
           echo $_SESSION['delete'];
           unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-category']))
        {
           echo $_SESSION['no-category'];
           unset($_SESSION['no-category']);
        }

        if(isset($_SESSION['update']))
        {
           echo $_SESSION['update'];
           unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload']))
        {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
        }

        
              
      ?>

      <br><br>

          <!--Add admin button-->
          <a href="<?php echo SITEURL . 'admin/add_category.php'; ?>" class="btn-primary">Add Category</a>

          <br /><br /><br />

          <table class="tbl-full">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Actions</th>
            </tr>

            <?php 
                //get all category
                $sql = "SELECT * FROM food_category";

                //execute query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //number variable
                $sn=1;

                //check data
                if($count>0)
                {
                    //have data
                    while($row=mysqli_fetch_array($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                          <tr>
                             <td><?php echo $sn++; ?></td>
                             <td><?php echo $title; ?></td>

                             <td>
                                <?php 
                                    //no  available image
                                    if($image_name!="")
                                    {
                                        //show image
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">

                                        <?php
                                    }
                                    else
                                    {
                                         //show msg
                                         echo "<div class='error'>Image not Added.</div>";
                                    }

                                ?>
                             </td>

                             <td><?php echo $featured; ?></td>
                             <td><?php echo $active; ?></td>
                             <td>
                                 <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secodary">Update Category</a>
                                 <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-third">Delete Category</a>
                             </td>
                          </tr>

                        <?php
                    }
                }
                else
                {
                    //no have data
                    ?>

                    <tr>
                        <td colspan="6"><div class="error">Category Not Added.</div></td>
                    </tr>

                    <?php
                }
            ?>

          
          </table>
    </div>
</div>

<?php include('partials/footer.php') ?>