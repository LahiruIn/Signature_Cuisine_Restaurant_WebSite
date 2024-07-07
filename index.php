<?php include('partials_frontend/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
         if(isset($_SESSION['order']))
         {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
         }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Food Categories</h2>

            <?php 
                //create sql query to display categories from database
                $sql = "SELECT * FROM food_category WHERE active='Yes' AND featured='Yes' LIMIT 6";
                //execute query
                $res = mysqli_query($conn, $sql);
                //count row to check category is available
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                     //categories available
                     while($row=mysqli_fetch_assoc($res))
                     {
                         //get values 
                         $id = $row['id'];
                         $title = $row['title'];
                         $image_name = $row['image_name'];
                         ?>
                         
                         <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                           <div class="box-3 float-container">
                              <?php 
                                  //check imahe availabale or not
                                  if($image_name=="")
                                  {
                                      //Display msg
                                      echo "<div class='error'>Image not available</div>";
                                  }
                                  else
                                  {
                                      //image available
                                      ?>
                                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                      <?php
                                  }
                              ?>
                              
                              <h3 class="float-text text-white"><?php echo $title; ?></h3>
                           </div>
                         </a>

                         <?php
                     }
                }
                else
                {
                     //Categories not available
                     echo "<div class='error'>Category Not Available</div>";
                }
            ?>
                   
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- FOOD Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
            // Get food from database that are active and featured
            $sql2 = "SELECT * FROM table_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            // Execute query
            $res2 = mysqli_query($conn, $sql2);
            // Count rows
            $count2 = mysqli_num_rows($res2);

            // Check if food items are available or not
            if($count2 > 0) {
                // Food items available
                while($row = mysqli_fetch_assoc($res2)) {
                    // Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                // Check if image is available or not
                                if($image_name == "") {
                                    // Image not available
                                    echo "<div class='error'>Image not found.</div>";
                                } else {
                                    // Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            } 
            else
            {
                // Food not available
                echo "<div class='error'>Food not available.</div>";
            }
        ?>

        <div class="clearfix"></div>

    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
    <!-- FOOD Menu Section Ends Here -->

    
    <?php include('partials_frontend/footer.php'); ?>