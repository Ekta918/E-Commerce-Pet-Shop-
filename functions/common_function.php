<?php

//include connect file
//include("./includes/connect.php");

//getting products
function getproducts()
{
    global $con;

    // Condition to check isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0,6";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];

                // Output HTML for each product
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'><strong>Price: $product_price/-</strong></p>
                                
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>
                                    <i class='fa-solid fa-cart-shopping'></i>
                                </a>
                                
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-success'>
                                    <i class='fa-solid fa-eye'></i>
                                </a>

                                <!-- Add to Wishlist button -->
                                <a href='cart.php?add_to_wishlist=$product_id' class='btn btn-danger'>
                                    <i class='far fa-heart'></i>
                                </a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}

//getting all products
function get_all_products()
{
  global $con;

    //condition to check isset or not
    if(!isset($_GET['category']))
    {
      if(!isset($_GET['brand']))
      {
    $select_query="select * from `products` order by rand()";
            $result_query=mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query))
            {
              $product_id=$row['product_id'];
              $product_title=$row['product_title'];
              $category_id=$row['category_id'];
              $brand_id=$row['brand_id'];
              $product_image1=$row['product_image1'];
              $product_price=$row['product_price'];

              echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
          <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'><strong>Price: $product_price/-</strong></p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-cart-shopping'></i></a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-success'><i class='fa-solid fa-eye'></i></a>
          <a href='cart.php?add_to_wishlist=$product_id' class='btn btn-danger'><i class='far fa-heart'></i></a>
        </div>
        </div>
        </div>";
             }
}
}
}

//getting unique category

function get_unique_categories()
{
  global $con;

    //condition to check isset or not
    if(isset($_GET['category']))
    {
      $category_id=$_GET['category'];
    $select_query="select * from `products` where category_id=$category_id";
            $result_query=mysqli_query($con,$select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0)
            {
              echo "<h2 class='text-center text-danger'>No Stock for this category</h2>";
            }
            while($row=mysqli_fetch_assoc($result_query))
            {
              $product_id=$row['product_id'];
              $product_title=$row['product_title'];
              $category_id=$row['category_id'];
              $brand_id=$row['brand_id'];
              $product_image1=$row['product_image1'];
              $product_price=$row['product_price'];

              echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
          <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'><strong>Price: $product_price/-</strong></p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-cart-shopping'></i></a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-success'><i class='fa-solid fa-eye'></i></a>
          <a href='cart.php?add_to_wishlist=$product_id' class='btn btn-danger'><i class='far fa-heart'></i></a>
        </div>
        </div>
        </div>";
             }
}
}

//displaying unique brands

function get_unique_brands()
{
  global $con;

    //condition to check isset or not
    if(isset($_GET['brand']))
    {
      $brand_id=$_GET['brand'];
    $select_query="select * from `products` where brand_id=$brand_id";
            $result_query=mysqli_query($con,$select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0)
            {
              echo "<h2 class='text-center text-danger'>This brand is not available for service</h2>";
            }
            while($row=mysqli_fetch_assoc($result_query))
            {
              $product_id=$row['product_id'];
              $product_title=$row['product_title'];
              $category_id=$row['category_id'];
              $brand_id=$row['brand_id'];
              $product_image1=$row['product_image1'];
              $product_price=$row['product_price'];

              echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
          <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'><strong>Price: $product_price/-</strong></p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-cart-shopping'></i></a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-success'><i class='fa-solid fa-eye'></i></a>
          <a href='cart.php?add_to_wishlist=$product_id' class='btn btn-danger'><i class='far fa-heart'></i></a>
        </div>
        </div>
        </div>";
             }
}
}

//displaying brands in side navbar
function getbrands()
{
    global $con;
    $select_brands="select * from `brands`";
          $result_brands=mysqli_query($con,$select_brands);
          while($row_data=mysqli_fetch_assoc($result_brands))
          {
            $brand_title=$row_data['brand_title'];
            $brand_id=$row_data['brand_id'];
            echo "<li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title<a>
          </li>";
          }
}

//displaying categories in sidenav
function getcategories()
{
    global $con;
    $select_categories="select * from `categories`";
    $result_categories=mysqli_query($con,$select_categories);
    while($row_data=mysqli_fetch_assoc($result_categories))
    {
        $category_title=$row_data['category_title'];
        $category_id=$row_data['category_id'];
        echo "<li class='nav-item'>
        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title<a>
        </li>";
    }
}

//searching products

function search_product()
{
  global $con;
    if(isset($_GET['search_data_product']))
    {
      $serach_data_value=$_GET['search_data'];
    $search_query="select * from `products` where product_keywords like '%$serach_data_value%'";
            $result_query=mysqli_query($con,$search_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows==0)
            {
              echo "<h2 class='text-center text-danger'>No results match. No products found on this category!</h2>";
            }
            
            while($row=mysqli_fetch_assoc($result_query))
            {
              $product_id=$row['product_id'];
              $product_title=$row['product_title'];
              $category_id=$row['category_id'];
              $brand_id=$row['brand_id'];
              $product_image1=$row['product_image1'];
              $product_price=$row['product_price'];

              echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
          <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'><strong>Price: $product_price/-</strong></p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-cart-shopping'></i></a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-success'><i class='fa-solid fa-eye'></i></a>
          <a href='cart.php?add_to_wishlist=$product_id' class='btn btn-danger'><i class='far fa-heart'></i></a>
        </div>
        </div>
        </div>";
             }
}
}

//view details function
function view_details()
{
  global $con;

    //condition to check isset or not
    if(isset($_GET['product_id']))
    {
    if(!isset($_GET['category']))
    {
      if(!isset($_GET['brand']))
      {
        $product_id=$_GET['product_id'];
    $select_query="select * from `products` where product_id=$product_id";
            $result_query=mysqli_query($con,$select_query);
            while($row=mysqli_fetch_assoc($result_query))
            {
              $product_id=$row['product_id'];
              $product_title=$row['product_title'];
              $product_decription=$row['product_decription'];
              $category_id=$row['category_id'];
              $brand_id=$row['brand_id'];
              $product_image1=$row['product_image1'];
              $product_image2=$row['product_image2'];
              $product_price=$row['product_price'];

              echo "<div class='col-md-4 mb-2'>
        <div class='card'>
          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
          <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'><strong>Price: $product_price/-</strong></p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-cart-shopping'></i></a>
          <a href='product_detail.php?product_id=$product_id' class='btn btn-success'><i class='fa-solid fa-eye'></i></a>
          <a href='cart.php?add_to_wishlist=$product_id' class='btn btn-danger'><i class='far fa-heart'></i></a>
          </div>
        </div>
        </div>
        <div class='col-md-8'>
                <div class='row'>
                    <div class='col-md-12'>
                        <h4 class='text-center mb-5'>Product Detail</h4>
                    </div>
            <div class='col-md-6'>
                <div class='product-details'>
                    <img src='./admin_area/product_images/$product_image2' class='img-fluid' alt='Product Image'>
                </div>
            </div>
            <div class='col-md-6'>
                <h1>Title:$product_title</h1>
                <p><strong>Price: $product_price/-</strong></p>
                <p>Description:$product_decription</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
            </div>
            </div>";
             }
}
}
}
}

//get ip address function

// function getIPAddress() {  
//     //whether ip is from the share internet  
//      if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
//                 $ip = $_SERVER['HTTP_CLIENT_IP'];  
//         }  
//     //whether ip is from the proxy  
//     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
//                 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
//      }  
// //whether ip is from the remote address  
//     else{  
//              $ip = $_SERVER['REMOTE_ADDR'];  
//      }  
//      return $ip;  
// }
function getIPAddress() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  

//cart function
function cart()
{
  if(isset($_GET['add_to_cart']))
  {
    global $con;
    $get_ip_add = getIPAddress();
    $get_product_id=$_GET['add_to_cart'];
    $search_query="select * from `cart_details` where ip_address='$get_ip_add' and product_id=$get_product_id";
    $result_query=mysqli_query($con,$search_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows>0)
    {
      echo "<script>alert('This item is already present inside cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
    else
    {
      $insert_query="insert into `cart_details` (product_id,ip_address,quantity) value($get_product_id,'$get_ip_add',0)";
      $result_query=mysqli_query($con,$insert_query);
      echo "<script>alert('Item is added to cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}

//function to get cart item number
function cart_item()
{
  if(isset($_GET['add_to_cart']))
  {
    global $con;
    $get_ip_add = getIPAddress();
    $search_query="select * from `cart_details` where ip_address='$get_ip_add'";
    $result_query=mysqli_query($con,$search_query);
    $count_cart_items=mysqli_num_rows($result_query);
  }
  else
  {
    global $con;
    $get_ip_add = getIPAddress();
    $search_query="select * from `cart_details` where ip_address='$get_ip_add'";
    $result_query=mysqli_query($con,$search_query);
    $count_cart_items=mysqli_num_rows($result_query);
  }
  echo $count_cart_items;
}

//total price function
function total_cart_price()
{
  global $con;
  $get_ip_add = getIPAddress();
  $total_price=0;
  $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
  $result=mysqli_query($con,$cart_query);
  while($row=mysqli_fetch_array($result))
  {
    $product_id=$row['product_id'];
    $select_products="select * from `products` where product_id='$product_id'";
    $result_products=mysqli_query($con,$select_products);
    while($row_product_price=mysqli_fetch_array($result_products))
    {
      $product_price=array($row_product_price['product_price']);   //[200,300]
      $product_values=array_sum($product_price);//[500]
      $total_price+=$product_values;//500
    }
  }
  echo $total_price;
}

//get user order details
function get_user_order_details()
{
  global $con;
  $username=$_SESSION['username'];
  $get_details="select * from `user_table`";
  $result_query=mysqli_query($con,$get_details);
  while($row_query=mysqli_fetch_array($result_query))
  {
    $user_id=$row_query['user_id'];
    if(!isset($_GET['edit_account']))
    {
      if(!isset($_GET['my_orders']))
      {
        if(!isset($_GET['delete_account']))
        {
          $get_orders="select * from `user_orders` where user_id=$user_id and order_status='pending'";
          $result_orders_query=mysqli_query($con,$get_orders);
          $row_count=mysqli_num_rows($result_orders_query);
          if($row_count>0)
          {
            echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> 
            pending orders</h3>
            <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>";
          }
          else {
            echo "<h3 class='text-center text-success mt-5 mb-2'>You have no pending orders.</h3>
            <p class='text-center'><a href='../display_all.php' class='text-dark'>Explore Products</a></p>";
        }
        }
      }
    }
  }
  
}
//add to wishlist
function add_to_wishlist() {
  if(isset($_GET['add_to_wishlist'])) {
    global $con;
    $get_ip_add = getIPAddress();
    $get_product_id = $_GET['add_to_wishlist'];
    
    // Check if the product is already in the wishlist
    $search_query = "SELECT * FROM `wishlist_details` WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    
    if($num_of_rows > 0) {
      echo "<script>alert('This item is already in your wishlist')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
    } else {
      // Add product to wishlist
      $insert_query = "INSERT INTO `wishlist_details` (product_id, ip_address) VALUES ($get_product_id, '$get_ip_add')";
      $result_query = mysqli_query($con, $insert_query);
      echo "<script>alert('Item added to wishlist')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
    }
  }
}
//count wishlist item

function wishlist_item_count() {
  if(isset($_GET['add_to_wishlist'])) {
    global $con;
    $get_ip_add = getIPAddress();
    $search_query = "SELECT * FROM `wishlist_details` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $search_query);
    $count_wishlist_items = mysqli_num_rows($result_query);
  } else {
    global $con;
    $get_ip_add = getIPAddress();
    $search_query = "SELECT * FROM `wishlist_details` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $search_query);
    $count_wishlist_items = mysqli_num_rows($result_query);
  }
  echo $count_wishlist_items;
}

?>