<?php require_once APPROOT . '/views/inc/admin/header.php';
$database = new Database();
?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br /><br /><br />


        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food_Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order_Date</th>
                <th>Status</th>
                <th>User_Name</th>
                <th>Phone_number</th>
                <th>Address</th>
                <th>Delivery Fee</th>
                <th>Delivery Company</th>
                <th>Actions</th>
            </tr>

            <?php
            $tbl_order = $database->readAll('vw_orderall');
            // $addressID = $tbl_order['Address_Id'];
            // echo $addressID;
            // exit;
            $sn = 1;
            foreach ($tbl_order as $order) {
                // $addressID =  $order['Address_Id'];
                // $user_id = $database->getById('tbl_order', $addressID);
                // print_r($user_id);
                // exit;
            ?>

                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $order['title']; ?></td>
                    <td>$<?php echo $order['food_Price']; ?></td>
                    <td><?php echo $order['qty']; ?></td>
                    <td><?php echo $order['total']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo $order['name']; ?></td>
                    <td><?php echo $order['phone_number']; ?></td>
                    <td><?php echo $order['user_address']; ?></td>
                    <td><?php echo $order['delivery_Price']; ?></td>
                    <td><?php echo $order['delivery_CompanyName']; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/Order/destroy/<?php echo $order['order_ID']; ?>" class="btn-primary">Delete Order</a>
                        <a href="<?php echo URLROOT; ?>/Order/editorder/<?php echo $order['order_ID']; ?>" class="btn-secondary">Update Order</a>
                    </td>
                </tr>
            <?php
            }

            ?>



        </table>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends -->


<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>