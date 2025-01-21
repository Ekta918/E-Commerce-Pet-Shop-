<!-- Bootstrap CSS link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<!-- Bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="text-center">
        <?php
        $get_orders="select * from `user_orders`";
        $result=mysqli_query($con,$get_orders);
        $row_count=mysqli_num_rows($result);
        
    if($row_count==0)
    {
        echo "<h2 class='text-danger text-center mt-5'>No orders yet!!</h2>";
    }
    else
    {
        echo "<tr>
        <th>Sl No.</th>
        <th>Due Amount</th>
        <th>Total Products</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Delete</th>
        </tr>
    </thead>
    <tbody class='text-center'>";

        $number=0;
        while($row_data=mysqli_fetch_assoc($result))
        {
            $order_id=$row_data['order_id'];
            $user_id=$row_data['user_id'];
            $amount_due=$row_data['amount_due'];
            $total_products=$row_data['total_products'];
            $order_date=$row_data['order_date'];
            $order_status=$row_data['order_status'];
            $number++;

            echo "<tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$total_products</td>
            <td>$order_date</td>
            <td>$order_status</td>
            <td><a href='index.php?delete_order=$order_id' type='button' class='btn btn-danger text-light' 
            data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash-can'></i></a></td>
        </tr>";
        }
    }
        ?>
        </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this??</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <a href="./index.php?list_orders" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_order=<?php echo $order_id ?>'
         class='text-light text-decoration-none'>Yes</a></button>
      </div>
    </div>
  </div>
</div>
