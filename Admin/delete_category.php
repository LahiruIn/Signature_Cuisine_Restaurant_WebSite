<?php 

    include('../configer/constants.php');


    //echo "Delete";
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get value and delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove image file
        if($image_name !="")
        {
             //Image is available. So remove it
             $path = "../images/category/".$image_name;
             //remove image
             $remove = unlink($path);

             //Failed remove image and msg
             if($remove==false)
             {
                 //set session msg
                 $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                 //redirect
                 header('location:'.SITEURL.'admin/manage_category.php');
                 die();
             }
             
        }

        $sql = "DELETE FROM food_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Category Delete Successfully.</div>";
            header('location:'.SITEURL.'admin/manage_category.php');
        }

        else
        {
          $_SESSION['delete'] = "<div class='error'>Category Delete Failed.</div>";
          header('location:'.SITEURL.'admin/manage_category.php');
        }
        
    }
    else
    {
        //redirect
        header('location:'.SITEURL.'admin/manage_category.php');
    }
?>