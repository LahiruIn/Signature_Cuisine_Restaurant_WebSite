<?php include('partials/menu.php');?>

  <div class="main-content">
       <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        
        <?php 
             //check set or not
             if(isset($_GET['id']))
             {
                //echo"Getting the data";
                $id = $_GET['id'];
                //get all details
                $sql = "SELECT * FROM food_category WHERE id=$id";

                //execute query
                $res = mysqli_query($conn, $sql);

                //check id valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //get all data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }
                else
                {
                    //redirect
                    $_SESSION['no-category'] = "<div class ='error'>Category not Found.</div>";
                    header("location:".SITEURL.'admin/manage_category.php');
                }

             }
             else
             {  
                //redirect
                header('location:'.SITEURL.'admin/manage_category.php');
             }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
               <td> Title: </td>
               <td>
                  <input type="text" name="title" value="<?php echo $title; ?>">
               </td>
            </tr>

            <tr>
               <td> Current Image: </td>
               <td>
                  <?php 
                      if($current_image !="")
                      {
                           // display image
                           ?>
                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                           <?php
                      }
                      else
                      {
                           //display msg
                           echo "<div class='error'>Image Not Added.</div>";
                      }
                  ?>
               </td>
            </tr>

            <tr>
               <td>New Image:</td>
               <td>
                   <input type="file" name="image">
               </td>  
            </tr>

            <tr>
               <td>Featured: </td>
               <td>
                   <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                   <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
               </td>
            </tr>

            <tr>
               <td>Active: </td>
               <td>
                   <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                   <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
               </td>
            </tr>

            <tr>
               <td>
                   <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <input type="submit" name="submit" value="Update Category" class="btn-secodary">
               </td>
            </tr>

          </table>
          </form> 

          <?php
              if(isset($_POST['submit']))
              {
                  //echo "click";
                  //get all data our form
                  $id =$_POST['id'];
                  $title = $_POST['title'];
                  $current_image = $_POST['current_image'];
                  $featured = $_POST['featured'];
                  $active = $_POST['active'];

                  //update new image
                  if(isset($_FILES['image']['name']))
                  {
                      //get the image
                      $image_name = $_FILES['image']['name'];

                      //check image available or not
                      if($image_name != "")
                      {
                           //image available and upload image
                           //auto rename.get extention jpg, png, ect...
                           $image_info = explode('.', $image_name);
                           $ext = end($image_info);
                           //rename image
                           $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                      
                           $source_path = $_FILES['image']['tmp_name'];
                           $destination_path = "../images/category/".$image_name;

                           $upload = move_uploaded_file($source_path, $destination_path);

                           //check image uploaded or not
                           if($upload==false)
                           {
                               //set msg
                               $_SESSION['upload'] = "<div class='error'>Failed uploaded Image.</div>";
                               //redirect
                               header('location:'.SITEURL.'admin/manage_category.php');

                               //stop
                               die();

                           }

                           //remove the current image
                           $remove_path = "../images/category/".$current_image;

                           $remove = unlink($remove_path);

                           //check image remove or not
                           //remove display msg
                           if($remove==false)
                           {
                              //failed remove image
                              $_SESSION['failed-remove'] = "<div class ='error'>Failed remove Image.</div>";
                              //redirect
                              header('location:'.SITEURL.'admin/manage_category.php');
                              die();//stop 
                           }


                           //remove current image
                           if($current_image!="")
                           {
                              $remove_path = "../images/category/".$current_image;

                              $remove = unlink($remove_path);

                              //check image remove or not
                              //remove display msg
                              if($remove==false)
                              {
                                  //failed remove image
                                  $_SESSION['failed-remove'] = "<div class ='error'>Failed remove Image.</div>";
                                  //redirect
                                  header('location:'.SITEURL.'admin/manage_category.php');
                                  die();//stop 
                              }
                           }

                      }
                      else
                      {
                          $image_name = $current_image;
                      }
                  }
                  else
                  {
                      $image_name = $current_image;
                  }


                  //update database
                  $sql2 = "UPDATE food_category SET
                       title ='$title',
                       image_name = '$image_name',
                       featured = '$featured',
                       active = '$active'
                       WHERE id=$id
                       ";
                  
                  //execute query
                  $res2 = mysqli_query($conn, $sql2);

                  //exexuted or not
                  if($res2==true)
                  {
                      //update success
                      $_SESSION['update'] = "<div class ='success'>Category Updated Successfully.</div>";
                      //redirect
                      header('location:'.SITEURL.'admin/manage_category.php');

                  }
                  else
                  {
                      //update failed
                      $_SESSION['update'] = "<div class ='error'>Category Updated Failed.</div>";
                      //redirect
                      header('location:'.SITEURL.'admin/manage_category.php');
                  }

              } 
              
          ?>

       </div>
  </div>

  <?php include('partials/footer.php'); ?>