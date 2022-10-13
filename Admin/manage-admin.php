    <?php include("partials/menu.php")?>

    <!-- Main content section start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>

            <?php 
                //session to add admin
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);//Removeing sessiion message
                }
                //session to delete admin
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                //session to update admin
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                //session user not found
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                // session password not match
                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
                // session password change
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>

            <br><br><br>
            <!-- btn Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                // Query to get all admin

                $sql = "SELECT * FROM tbl_admin";
                // execute the query 
                $res = mysqli_query($conn,$sql);

                if($res ==TRUE)
                {
                    //count rows to check whather we have data in database
                    $count = mysqli_num_rows($res);//function to get all the rows in database.

                    //check the num of rows
                    if($count>0)
                    {
                        $sn =1; //for S.N
                        //we have data in database
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            //using while loop to get all the data from DB
                            //and while loop'll run as long as we have data in DB

                            //get individual Data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            ?>
                <tr>
                    <td><?php echo$sn++.".";?></td>
                    <td><?php echo$full_name;?></td>
                    <td><?php echo$username;?></td>
                    <td>
                        <a href="<?php echo SITEURL?>Admin/update-password.php?id=<?php echo$id;?>"
                            class="btn-primary">Change Password</a>
                        <a href="<?php echo SITEURL;?>Admin/update-admin.php?id=<?php echo $id;?>"
                            class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL;?>Admin/delete-admin.php?id=<?php echo $id;?>"
                            class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <?php
                        }
                    }
                    else{
                        //we dont have data
                    }
                }
                
                ?>
            </table>
        </div>
    </div>
    <!-- Main content section ends -->

    <?php include("partials/footer.php")?>