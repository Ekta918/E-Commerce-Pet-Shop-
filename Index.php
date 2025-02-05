<?php
include("includes/connect.php");
include("functions/common_function.php");
session_start();
$offers = $con->query("SELECT * FROM offers WHERE status='active' AND expiry_date >= CURDATE() ORDER BY expiry_date ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shop</title>
    <!-- bootstrap css link -->
    
     <!-- font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!--css file-->
    <link rel="stylesheet" href="style.css">
    <style>
      body
      {
        overflow-x:hidden;
      }
      .offers-banner {
        background-color: #ffedc2;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }
      .offers-banner h4 {
        margin: 0;
        font-size: 1.2rem;
        color: #ff7a00;
      }
      .offers-banner ul {
        list-style: none;
        padding: 0;
        margin: 5px 0 0;
      }
      .offers-banner ul li {
        font-size: 0.95rem;
        color: #333;
      }
      .offers-banner ul li i {
        color: #ff7a00;
        margin-right: 5px;
      }
    </style>
</head>
<body>
    <!-- navbar -->
     <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <img src="./images/l1.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php

        if(isset($_SESSION['username']))
        {
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/profile.php'>My Account</a>
        </li>";
        }
        else
        {
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
        </li>";
        }

        ?>
        <li class="nav-item">
          <a class="nav-link" href="about_us.php">About Us</a>
        </li>
        <li class="nav-item">
    <a class="nav-link" href="wishlist.php"><i class="fa-solid fa-heart"></i><sup><?php
        wishlist_item_count(); // Function to display the number of wishlist items
    ?></sup></a>
</li>

        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
          cart_item();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php
          total_cart_price();?>/-</a>
        </li>
      </ul>
      <form class="d-flex" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search Here..." aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light " name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!--calling cart function-->
<?php
  cart();
?> 

<!--second child-->
<nav class="navbar1 navbar-expand-lg">
    <ul class="navbar-nav me-auto">
      <?php

        if(!isset($_SESSION['username']))
        {
          echo "<li class='nav-item1'>
          <a class='nav-link1 active' aria-current='page' href='#'>Welcome Guest</a>
        </li>";
        }
        else
        {
          echo "<li class='nav-item1'>
          <a class='nav-link1 active' aria-current='page' href='#'>Welcome ".$_SESSION['username']."</a>
          </li>";
        }

        if(!isset($_SESSION['username']))
        {
          echo "<li class='nav-item1'>
          <a class='nav-link1 active' aria-current='page' href='./users_area/user_login.php'>Login</a>
        </li>";
        }
        else
        {
          echo "<li class='nav-item1'>
          <a class='nav-link1 active' aria-current='page' href='./users_area/logout.php'>Logout</a>
        </li>";
        }

        ?> 
    </ul>
</nav>

<!-- Offers Section -->
<div class="offers-banner">
            <h4>Special Offers:</h4>
            <ul>
                <?php if ($offers->num_rows > 0): ?>
                    <?php while ($offer = $offers->fetch_assoc()): ?>
                        <li><i class="fa-solid fa-tag"></i><?= $offer['code'] ?> - <?= $offer['discount'] ?>% off (Expires: <?= $offer['expiry_date'] ?>)</li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No active offers at the moment. Stay tuned!</li>
                <?php endif; ?>
            </ul>
        </div>

<!--third child-->
<div class="container my-5">
    <h2 class="text-center mb-4">Welcome to Our Pet Shop!</h2>
    <!-- <div class="carousel-inner">
        <?php
        $query = "SELECT * FROM slider_images";
        $result = mysqli_query($con, $query);

        if (!$result) {
            die("<p>Database query failed: " . mysqli_error($con) . "</p>");
        }

        $images = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!empty($images)) {
            foreach ($images as $index => $image) {
                $activeClass = $index === 0 ? 'active' : '';
                $imagePath = 'admin_area/' . htmlspecialchars($image['image_path'], ENT_QUOTES, 'UTF-8');
                //echo '<p>Debug Image Path: ' . $imagePath . '</p>'; // Debug
                echo '<div class="carousel-item ' . $activeClass . '">';
                echo '<img src="' . $imagePath . '" class="d-block w-100" alt="Slider Image">';
                echo '</div>';
            }
        } else {
            echo '<div class="carousel-item active">';
            echo '<img src="https://via.placeholder.com/800x400?text=No+Images+Available" class="d-block w-100" alt="No Images">';
            echo '</div>';
        }
        ?>
    </div> -->
    <div id="petCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $query = "SELECT * FROM slider_images";
        $result = mysqli_query($con, $query);

        if (!$result) {
            die("<p>Database query failed: " . mysqli_error($con) . "</p>");
        }

        $images = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!empty($images)) {
            foreach ($images as $index => $image) {
                $activeClass = $index === 0 ? 'active' : '';
                $imagePath = 'admin_area/' . htmlspecialchars($image['image_path'], ENT_QUOTES, 'UTF-8');
                echo '<div class="carousel-item ' . $activeClass . '">';
                echo '<img src="' . $imagePath . '" class="d-block w-100" alt="Slider Image">';
                echo '</div>';
            }
        } else {
            echo '<div class="carousel-item active">';
            echo '<img src="https://via.placeholder.com/800x400?text=No+Images+Available" class="d-block w-100" alt="No Images">';
            echo '</div>';
        }
        ?>
    </div>
    <!-- Add controls for sliding -->
    <a class="carousel-control-prev" href="#petCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#petCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

</div>

<!--fourth child-->
<div class="row px-1">
    <div class="col-md-10">
        <!--Products-->
        <div class="row">
         <?php
          getproducts();
          get_unique_categories();
          get_unique_brands();
          //$ip = getIPAddress();  
          //echo 'User Real IP Address - '.$ip;  
        ?>
          <!-- fetching products-->
        <!--Row end-->
        </div>
    <!--column end-->
    </div>
    <div class="sidebar-item col-md-2 p-0">
        <!--sidenav-->
        <!-- Brands to be displayed-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item2">
            <a href="#" class="nav-link text-light"><h4 class="side-nav-heading">Delivery Brands</h4></a>
          </li>
          <?php

          getbrands();

          ?>
        </ul>
        <!-- Categories to be displayed-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item2">
            <a href="#" class="nav-link text-light"><h4 class="side-nav-heading">Categories</h4></a>
          </li>
          <?php
            getcategories();
          ?>
        </ul>
    </div>
</div>

<!--last child-->
<?php
include("./includes/Footer.php");
?>
</div>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>