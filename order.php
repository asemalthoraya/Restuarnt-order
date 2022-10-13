<?php include "partials/menu.php"?>


<?php 

    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];

        $sql = "SELECT * FROM tbl_food WHere id = $food_id";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);
        if($count ==1)
        {
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price']; 
            $image_name = $row['image_name'];  
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        header('location:'.SITEURL);
    }

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" id='order' class="order">
            <fieldset>
                <legend style="color:var(--light-yellow);">Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                        if($image_name =="")
                        {
                            echo "<div class='erorr'>No image Inserted .!</div>";
                        }
                        else
                        {
                    ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza"
                        class="img-responsive img-curve">
                    <?php
                        }
                        
                    
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3 style="color:var(--light-yellow);"><?php echo $title?></h3>
                    <input type="hidden" name="food" value="<?php echo $title?>">

                    <p style="color:var(--light-yellow);" class="food-price"><?php echo $price?> YER</p>
                    <input type="hidden" name="price" value="<?php echo $price?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend style="color:var(--light-yellow);">Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" id='name' placeholder="E.g. Asem Althoraya"
                    class="input-responsive">

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" id='tel_id' placeholder="E.g. 9843xxxxxx" class="input-responsive">

                <div class="order-label">Email</div>
                <input type="email" name="email" id='email' placeholder="E.g. asem012018@gmail.com"
                    class="input-responsive">

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" id='address' placeholder="E.g. Street, City, Country"
                    class="input-responsive"></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php 

    if(isset($_POST['submit']))
    {
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d H:i:s");
        $status = "Ordered";
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];


        $sql2 = "INSERT Into tbl_order Set
                food = '$food',
                price = $price,
                qty = $qty,
                total =$total,
                order_date = '$order_date',
                status = '$status',
                customer_name ='$customer_name',
                customer_email = '$customer_email',
                customer_address ='$customer_address',
                customer_contact = '$customer_contact'
        ";

        // echo $sql2;die();
        $res2 = mysqli_query($conn,$sql2)or die(mysqli_error($conn));

        if($res2 == TRUE)
        {
            $_SESSION['order'] = "<div class='success'>Food Ordered Successfully</div>";
            header('location:'.SITEURL);
            // echo "<script>window.location.href='index.php';</script>";
            
        }
        else
        {
            $_SESSION['order'] = "<div class='erorr'>Failed to Order Food</div>";
            header('location:'.SITEURL);
            // echo "<script>window.location.href='index.php';</script>";
        }


    }

?>
<?php include "partials/footer.php"?>