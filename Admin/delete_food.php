<?php 

    include('../configer/constants.php');


    //echo "Delete";
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //process delete
        //echo "Process to Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove image file
        if($image_name != "")
        {
             //Image is available. So remove it
             $path = "../images/food/".$image_name;
             //remove image
             $remove = unlink($path);

             //Failed remove image and msg
             if($remove==false)
             {
                 //set session msg
                 $_SESSION['upload'] = "<div class='error'>Failed to Remove Food Image.</div>";
                 //redirect
                 header('location:'.SITEURL.'admin/manage_food .php');
                 die();
             }
        }

        $sql = "DELETE FROM table_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Delete Successfully.</div>";
            header('location:'.SITEURL.'admin/manage_food.php');
        }

        else
        {
          $_SESSION['delete'] = "<div class='error'>Food Delete Failed.</div>";
          header('location:'.SITEURL.'admin/manage_food.php');
        }
    }
    else 
    {
        //redirect
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage_food.php');
    }
?>