<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper-ord">
        <h1 class="text-center">Manage Order</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Customer name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count >0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        $customer_contact = $row['customer_contact'];
                        
            ?>
            <tr>
                <td><?php echo  $sn++?></td>
                <td><?php echo $food?></td>
                <td><?php echo $price?></td>
                <td><?php echo $qty?></td>
                <td><?php echo $total?></td>
                <td><?php echo $order_date?></td>

                <td>
                    <?php 
                        if($status == "Ordered")
                        {
                            echo "<lable>Order</lable>";
                        }
                        elseif ($status == "On Delivery")
                        {
                            echo "<lable style='color:orange;'>On Delivery</lable>";
                        }
                        elseif ($status == "Delivered")
                        {
                            echo "<lable style='color:Green;'>Delivered</lable>";
                        }
                        elseif ($status == "Cancelled")
                        {
                            echo "<lable style='color:red;'>Cancelled</lable>";
                        }
                    
                    ?>
                </td>

                <td><?php echo $customer_name?></td>
                <td><?php echo $customer_email?></td>
                <td><?php echo $customer_contact?></td>
                <td><?php echo $customer_address?></td>
                <td>
                    <a href="<?php echo SITEURL;?>Admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary"
                        style='padding:.5rem'>Update</a>
                </td>
            </tr>
            <?php
                    }
                }
                else
                {
                    echo "<div class='erorr'>THere is No Order Yet..!</div>";
                }
            
            ?>


        </table>
    </div>
</div>




<?php include("partials/footer.php")?>