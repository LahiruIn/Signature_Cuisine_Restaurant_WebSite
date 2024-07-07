<?php include('partials_frontend/menu.php'); ?>

 <?php 
    //check food id set or not
    if(isset($_GET['food_id']))
    {
         //get food id and details selected food
         $food_id = $_GET['food_id'];

         //get details of details of selected food
         $food_id = $_GET['food_id'];

         //get details selected food
         $sql = "SELECT * FROM table_food WHERE id=$food_id";
         //execute qur
         $res = mysqli_query($conn, $sql);
         //count row
         $count = mysqli_num_rows($res);
         //check data available or not
         if($count==1)
         {
             //get data from database
             $row = mysqli_fetch_assoc($res);
             $title = $row['title'];
             $price = $row['price'];
             $image_name = $row['image_name'];
         }
         else
         {
             //food not available - redirect
             header('location:'.SITEURL);

         }

    }
    else
    {
         //redirect
         header('location:'.SITEURL);
    }
 ?>
  
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php 
                         //check img available or not
                         if($image_name=="")
                         {
                              //img not avlb
                              echo "<div class='error'>Image not Available.</div>";
                         }
                         else
                         {
                              //img avlb
                              ?>
                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                              <?php
                         }

                    ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                  //check submit btn click or not
                  if(isset($_POST['submit']))
                  {
                      //get all details the form
                      $food = $_POST['food'];
                      $price = $_POST['price'];
                      $qty = $_POST['qty'];
                      $total = $price * $qty;
                      $order_date = date("Y-m-d h:i:sa");
                      $status = "ordered";
                      $customer_name = $_POST['full-name'];
                      $customer_contact = $_POST['contact'];
                      $customer_email = $_POST['email'];
                      $customer_address = $_POST['address'];

                      //save order database - create sql save data
                      $sql2 = "INSERT INTO food_order  SET
                            food = '$food',
                            price = '$price',
                            qty = '$qty',
                            total = '$total',
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                        ";

                        //echo $sql2; die();

                            //execute query
                            $res2 = mysqli_query($conn, $sql2);

                            //check query execute successful or not
                            if($res2==true)
                            {
                                 //qur executed order save
                                 $_SESSION['order'] = "<div class= 'success text-center'>Register successfully</div>";
                                 header('location:'.SITEURL);
                            }
                            else
                            {
                                //failed save order
                                $_SESSION['order'] = "<div class='error text-center'>Failed to order food.</div>";
                                 header('location:'.SITEURL);
                            }
                  }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials_frontend/footer.php'); ?>