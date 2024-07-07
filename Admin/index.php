<?php include('partials/menu.php'); ?>


    <!--Main content section strat-->
    <div class="main-content">
      <div class="wrapper">
          <h1>Dashboard</h1>

          <br><br>

          <?php
            if(isset($_SESSION['login']))
            {
              echo $_SESSION['login'];
              unset($_SESSION['login']);
            } 
          
          ?>
          <br><br>

          <div class="col-4 text-center">
            <h1>5</h1>
            <br /> 
            Categories
          </div>

          <div class="col-4 text-center">
            <h1>22</h1>
            <br /> 
            Food
          </div>

          <div class="col-4 text-center">
            <h1>12</h1>
            <br /> 
            Orders
          </div>

          <div class="col-4 text-center">
            <h1>$ 48</h1>
            <br /> 
            Total
          </div>

          <div class="clearfix"></div>

      </div>
    </div>
    <!--Main content section end-->

<?php include('partials/footer.php') ?>