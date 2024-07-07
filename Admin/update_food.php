<?php include('partials/menu.php');?>

  <div class="main-content">
       <div class="wrapper">
         <h1>Update Food</h1>
         <br><br>

         <?php 
             //check set or not
             if(isset($_GET['id']))
             {
                //echo"Getting the data";
                $id = $_GET['id'];
                //get all details
                $sql2 = "SELECT * FROM table_food WHERE id=$id";

                //execute query
                $res2 = mysqli_query($conn, $sql2);

                //check id valid or not
                $row2 = mysqli_fetch_assoc($res2);
          
                    //get all data
                    $title = $row2['title'];
                    $descripton = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                    
             }
             else
             {  
                //redirect
                header('location:'.SITEURL.'admin/manage_food.php');
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
               <td> Description: </td>
               <td>
                  <textarea name="description" cols="30" rows="5"><?php echo $descripton; ?></textarea>
               </td>
            </tr>

            <tr>
               <td> Price: </td>
               <td>
                  <input type="number" name="price" value="<?php echo $price; ?>">
               </td>
            </tr>

            <tr>
               <td> Current Image: </td>
               <td>
                 <?php 
                      if($current_image =="")
                      {
                           //display msg
                           echo "<div class='error'>Image Not Added.</div>";
                      }
                      else
                      {                         
                           // display image
                           ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                           <?php
                      }
                  ?>
               </td>
            </tr>

            <tr>
               <td>Select New Image:</td>
               <td>
                   <input type="file" name="image">
               </td>  
            </tr>

            <tr>
                 <td>Category:</td>
                 <td>
                     <select name="category">
                        <?php 
                             //get active category
                             $sql = "SELECT * FROM food_category WHERE active='Yes'";
                             //execute query
                             $res = mysqli_query($conn, $sql);
                             $count = mysqli_num_rows($res);

                             //cheak category available or not
                             if($count>0)
                             {
                                 //category available
                                 while($row=mysqli_fetch_assoc($res))
                                 {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                 }
                             }
                             else
                             {
                                 //category not available
                                 echo "<option value='0'>Category Not Available.</option>";
                             }
                        ?>
                          
                     </select>
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
                   <input type="hidden" name="id" value="<?php echo $id; ?>">
                   <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                   <input type="submit" name="submit" value="Update Food" class="btn-secodary">
               </td>
            </tr>

          </table>
          </form> 

          <?php
              if(isset($_POST['submit']))
              {
                  // echo "Button work";
                  //get all details
                  $id =$_POST['id'];
                  $title = $_POST['title'];
                  $descripton = $_POST['description'];
                  $price = $_POST['price'];
                  $current_image = $_POST['current_image'];
                  $category = $_POST['category'];

                  $featured = $_POST['featured'];
                  $active = $_POST['active'];

                  //upload img
                  //check upload btn  clicked or not
                  if(isset($_FILES['image']['name']))
                  {
                      //upload btn clicked
                      $image_name = $_FILES['image']['name'];  //new img name

                      //check file is available or not
                      if($image_name!="")
                      {
                          //image is avble and rename image
                          $image_info = explode('.', $image_name);
                          $ext = end($image_info);
                          $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;

                          //get source path and destination path
                          $src_path = $_FILES['image']['tmp_name'];
                          $dest_path = "../images/food/".$image_name;

                          //upload img
                          $upload = move_uploaded_file($src_path, $dest_path);

                          //check img uploaded or not
                          if($upload==false)
                          {
                              //upload failed
                              $_SESSION['upload'] = "<div class='error'>Failed to upload new Image.</div>";
                               //redirect
                               header('location:'.SITEURL.'admin/manage_food.php');

                               //stop
                               die();
                          }
                          //remove img if new img upload and current img exixts
                          //remove current img available
                          if($current_image!="")
                          {
                              //current img availble 
                              //remove the img
                              $remove_path = "../images/food/".$current_image;

                              $remove = unlink($remove_path);

                              //check image remove or not
                              if($remove==false)
                              {
                                  //failed to remove current img
                                  $_SESSION['remove-failed'] = "<div class ='error'>Failed remove Current Image.</div>";
                                  //redirect
                                  header('location:'.SITEURL.'admin/manage_food.php');
                                  die();//stop 
                              }
                          }

                      }
                      else
                      {
                        $image_name = $current_image;  //default image when img is not selected
                      }
                      
                  }
                  else
                  {
                      $image_name = $current_image;  //default imf when button is not clicked
                  }

                  

                  //update food database
                  $sql3 = "UPDATE table_food SET
                       title ='$title',
                       description ='$descripton',
                       price = '$price',
                       image_name = '$image_name',
                       category_id = '$category',
                       featured = '$featured',
                       active = '$active'
                       WHERE id=$id
                       ";
                  
                  //execute query
                  $res3 = mysqli_query($conn, $sql3);

                  //exexuted or not
                  if($res3==true)
                  {
                     //update success
                     $_SESSION['update'] = "<div class ='success'>Food Updated Successfully.</div>";
                     //redirect
                     header('location:'.SITEURL.'admin/manage_food.php');

                  }
                  else
                  {
                     //update failed
                     $_SESSION['update'] = "<div class ='error'>Food Updated Failed.</div>";
                     //redirect
                     header('location:'.SITEURL.'admin/manage_food.php');
                  }

              
              }
          ?>

       </div>
  </div>

<?php include('partials/footer.php');?>
