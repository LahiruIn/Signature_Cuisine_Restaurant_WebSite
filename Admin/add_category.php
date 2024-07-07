<?php include('partials/menu.php'); ?>

<div class="main-content">
      <div class="wrapper">
          <h1>Add Category</h1>

          <br><br>

          <?php 
              
              if(isset($_SESSION['add']))
              {
                echo $_SESSION['add']; //display msg
                unset($_SESSION['add']); // remove msg
              }

              if(isset($_SESSION['upload']))
              {
                echo $_SESSION['upload']; //display msg
                unset($_SESSION['upload']); // remove msg
              }

          ?>
          
          <br><br>
          <!--add category start-->
          <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                  <tr>
                    <td>Title: </td>
                    <td>
                      <input type="text" name="title" placeholder="Category Title">
                    </td>
                  </tr>

                  <tr>
                    <td>Select Image:</td>
                    <td>
                       <input type="file" name="image">
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
                      <input type="submit" name="submit" value="Add Category" class="btn-secodary">
                    </td>
                  </tr>

                </table>

           </form>
          <!--add category end-->

          <?php 
          
                //Cheak submit button click or not
                if(isset($_POST['submit']))
                {
                  //echo "click";

                  $title = $_POST['title'];

                  //radio input
                  if(isset($_POST['featured']))
                  {
                     //get value
                     $featured = $_POST['featured'];
                  }
                  else
                  {
                      //set value
                      $featured = "No";
                  }

                  if(isset($_POST['active']))
                  {
                      $active = $_POST['active'];
                  }
                  else
                  {
                      $active = "No";
                  }

                  //check image select
                  //print_r($_FILES['image']);
                  //die(); //break code

                  if(isset($_FILES['image']['name']))
                  {
                      //upload image
                      //image name, source path
                      $image_name = $_FILES['image']['name'];

                      //upload image only
                    if($image_name !="")
                    {                  

                      //auto rename.get extention jpg, png, ect...
                      $ext  = end(explode('.', $image_name));

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
                          header("location:".SITEURL.'admin/add_category.php');

                          //stop
                          die();

                      }
                    }
                  }
                  else
                  {
                      //Don't upload image and set image name value
                      $image_name="";
                  }

                  //Create sql query
                  $sql = "INSERT INTO food_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                  ";

                  $res = mysqli_query($conn, $sql);

                  if($res==true)
                  {
                     $_SESSION['add'] = "<div class ='success'>Category Added Successfully.</div>";
                     //redirect
                     header("location:".SITEURL.'admin/manage_category.php');
                  }
                  else
                  {
                     $_SESSION['add'] = "<div class ='error'>Failed to Add Category.</div>";
                     //redirect
                     header("location:".SITEURL.'admin/manage_category.php');
                  }

                }
          ?>
      </div>
</div>


<?php include('partials/footer.php') ?>