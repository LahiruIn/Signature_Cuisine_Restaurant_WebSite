<?php

     //constants.php include
     include('../configer/constants.php');
     
     //get id admin delete
     $id = $_GET['id'];

     //create sql query delete admin
     $sql = "DELETE FROM table_admin WHERE id=$id";
     //exexute
     $res = mysqli_query($conn, $sql);


     //Redirect and msg
     if($res==true)
     {
       //done
       //echo "Admin Deleted Successfully";
       $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully.</div>";
       //redirect
       header('location:'.SITEURL.'admin/manage_admin.php');
     }
     else
     {
       //faild
       //echo "Failed to Delete Admin" ; 
       $_SESSION['delete'] = "<div class ='error'>Failed to Delete Admin. Try Again Later.</div>";
       header('location:'.SITEURL.'admin/manage_admin.php');
     }



?>