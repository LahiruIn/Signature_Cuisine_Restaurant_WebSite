<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
     <h1>Update Reservation</h1>
          <br /><br /><br />

      <?php 
      if(isset($_GET['id']))
      {
        //get id
        $id=$_GET['id'];

        //create sql query
        $sql="SELECT * FROM food_order WHERE id=$id";

        //execute query
        $res=mysqli_query($conn, $sql);

          //cheak available or not
          $count = mysqli_num_rows($res);
          if($count==1)
          {
            //get details
            //echo "Admin Available";
            $row=mysqli_fetch_assoc($res);

            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['qty'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];

          }
          
          else
          {
            //redirect page
            header('location:'.SITEURL.'admin/manage_order.php');
          }
      }
      else
      {
        //redirect page
        header('location:'.SITEURL.'admin/manage_order.php');
      }
        
      ?>

<form action=""method="POST">

<table class="tbl-30">
  <tr>
    <td>Food Name:</td>
    <td>
      <b><?php echo $food; ?></b>
    </td>
  </tr>

  <tr>
    <td>Price:</td>
    <td>
    <b><?php echo $price; ?></b>
    </td>
  </tr>
 
  <tr>
    <td>Qty:</td>
    <td>
      <input type="number" name="qty"value="<?php echo $qty; ?>">
    </td>

  </tr>

  <tr>
    <td>Status:</td>
    <td>
      <select name="status">
          <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
          <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
          <option <?php if($status=="Deliverded"){echo "selected";} ?> value="Deliverded">Deliverded</option>
          <option <?php if($status=="Canacelled"){echo "selected";} ?> value="Canacelled">Canacelled</option>
      </select>
    </td>
  </tr>

  <tr>
    <td>Customer Name:</td>
    <td>
      <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
    </td>
  </tr>

  <tr>
    <td>Customer Contact:</td>
    <td>
      <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
    </td>
  </tr>

  <tr>
    <td>Customer Email:</td>
    <td>
      <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
    </td>
  </tr>

  <tr>
    <td>Customer Address:</td>
    <td>
      <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
    </td>
  </tr>

  <tr>
    <td colspan="2">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="price" value="<?php echo $price; ?>">
    <input type="submit" name="submit" value="Update Order" class="btn-secodary">
    </td>
  </tr>


</table>

</form>

        <?php
           // check btn click or not
           if(isset($_POST['submit']))
           {
              //echo "click";
              // get all values
              $id = $_POST['id'];
              $price = $_POST['price'];
              $qty = $_POST['qty'];
              $total = $price * $qty;
              $status = $_POST['status'];
              $customer_name = $_POST['customer_name'];
              $customer_contact = $_POST['customer_contact'];
              $customer_email = $_POST['customer_email'];
              $customer_address = $_POST['customer_address'];

              //update value
              $sql2 = "UPDATE food_order SET
                  qty = $qty,
                  total = $total,
                  status = '$status',
                  customer_name = '$customer_name',
                  customer_contact = '$customer_contact',
                  customer_email = '$customer_email',
                  customer_address = '$customer_address'
                  WHERE id=$id
                  ";

                  //execute query
                  $res2 = mysqli_query($conn, $sql2);

                  //check update or not
                  //redirect
                  if($res2==true)
                  {
                    $_SESSION['update']= "<div class='success'> Reservation Updated Successfully.</div>";
          
                    //redirect
                    header('location:'.SITEURL.'admin/manage_order.php');
                  }
                  else
                  {
                  $_SESSION['update']= "<div class='error'> Order Updated Failed.Try Again Later.</div>";
          
                  //redirect
                  header('location:'.SITEURL.'admin/manage_order.php');
                  }

           }
        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>
