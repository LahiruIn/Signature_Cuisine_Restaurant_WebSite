<?php include('partials/menu.php'); ?>

<div class="main-content">
      <div class="wrapper">
          <h1>Add Food</h1>

          <br><br>

          <?php 

              if(isset($_SESSION['upload']))
              {
                echo $_SESSION['upload']; //display msg
                unset($_SESSION['upload']); // remove msg
              }

              if(isset($_SESSION['add']))
              {
                echo $_SESSION['add']; //display msg
                unset($_SESSION['add']); // remove msg
              }

        

          ?>

          <!--add food start-->
          <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                  <tr>
                    <td>Title: </td>
                    <td>
                      <input type="text" name="title" placeholder="Food Title">
                    </td>
                  </tr>

                  <tr>
                    <td>Description:</td>
                    <td>
                       <textarea name="description" cols="30" rows="5" placeholder="Food Description"></textarea>
                    </td>
                  </tr>

                  <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                  </tr>

                  <tr>
                    <td>Select Image:</td>
                    <td>
                       <input type="file" name="image">
                    </td>
                  </tr>

                  <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php 
                                //display categories from database
                                //sql get all active category
                                $sql = "SELECT * FROM  food_category WHERE active='Yes'";
                                
                                //execute query
                                $res = mysqli_query($conn, $sql);

                                //check have categories or not
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                     //available categories
                                     while($row=mysqli_fetch_assoc($res))
                                     {
                                        //get details
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                     }
                                }
                                else
                                {
                                     //not have category
                                     ?>
                                     <option value="0">No Category Found</option>
                                     <?php
                                }


                                //Display no dropdown
                            

                            ?>

                        </select>
                    </td>
                  </tr>

                  <tr>
                    <td>Featured: </td>
                    <td>
                      <input type="radio" name="featured" value="Yes">Yes
                      <input type="radio" name="featured" value="No">No
                    </td>
                  </tr>

                  <tr>
                    <td>Active: </td>
                    <td>
                      <input type="radio" name="active" value="Yes">Yes
                      <input type="radio" name="active" value="No">No
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2">
                      <input type="submit" name="submit" value="Add Food" class="btn-secodary">
                    </td>
                  </tr>


                </table>
            </form>

            <?php
                //check button click or not
                if(isset($_POST['submit']))
                {
                    //add food database
                    //echo "click";

                    //get data from form
                    $title = $_POST['title'];
                    $descripton = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    
                    //featured and active are checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";  //setting default value
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";   //setting default value
                    }

                    //upload image
                    if(isset($_FILES['image']['name']))
                    {
                       //get details select image
                       $image_name = $_FILES['image']['name'];

                       //check image selected or not
                       if($image_name !="")
                       {
                          //rename and get extension
                          $image_info = explode('.', $image_name);
                          $ext = end($image_info);

                          //create new name image
                          $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;

                          //upload image
                          $src = $_FILES['image']['tmp_name'];

                          //destination path for the image upload
                          $dst = "../images/food/".$image_name;

                          //upload the food image
                          $upload = move_uploaded_file($src, $dst);


                          //check image upload or not
                          if($upload==false)
                          {
                              //faild upload iamge, redirct and stop process
                              
                              $_SESSION['upload'] = "<div class='error'>Failed uploaded Image.</div>";
                              header('location:'.SITEURL.'admin/add_food.php');

                              //die();
                          }

                       }
                    }
                    else
                    {
                       $image_name =""; //setting default value as blank
                    }

                    //insert database
                    //create sql query
                    $sql2 = "INSERT INTO table_food SET
                    title='$title',
                    description = '$descripton',
                    price = '$price',
                    image_name ='$image_name',
                    category_id ='$category',
                    featured ='$featured',
                    active ='$active'
                  ";
 
                  //execute query 
                  $res2 = mysqli_query($conn, $sql2);

                  //check data inserted or not
                  if($res2 == true)
                  {
                     $_SESSION['add'] = "<div class ='success'>Food Added Successfully.</div>";
                     //redirect
                     header('location:'.SITEURL.'admin/manage_food.php');
                  }
                  else
                  {
                     $_SESSION['add'] = "<div class ='error'>Failed to Add Food.</div>";
                     //redirect
                     header('location:'.SITEURL.'admin/manage_food.php');
                  }
                
                }
            ?>
      </div>
</div>


<?php include('partials/footer.php'); ?>