<?php require_once APPROOT . '/views/inc/admin/header.php';
$database = new Database();
$statusDetails = $database->readAll('status');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <form action="<?php echo URLROOT; ?>/Order/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="order_id" value="<?php echo $data['order']['order_ID']; ?>">
            <input type="hidden" name="food_id" value="<?php echo $data['order']['food_ID']; ?>">
            <input type="hidden" name="qty" value="<?php echo $data['order']['qty']; ?>">
            <input type="hidden" name="total" value="<?php echo $data['order']['total']; ?>">
            <input type="hidden" name="order_date" value="<?php echo $data['order']['order_date']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $data['order']['user_ID']; ?>">
            <input type="hidden" name="address_id" value="<?php echo $data['order']['address_ID']; ?>">
            <input type="hidden" name="deliveryPrice_id" value="<?php echo $data['order']['DeliveryPrice_ID']; ?>">
            <input type="hidden" name="deliveryCompany_id" value="<?php echo $data['order']['company_ID']; ?>">
            <input type="hidden" name="phone_number" value="<?php echo $data['order']['phone_number']; ?>">

            <table class="tbl-30">

                <tr>
                    <td>Food Name: </td>
                    <td>
                        <b><?php echo $data['order']['title']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Food Price: </td>
                    <td>
                        <b><?php echo $data['order']['food_Price']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Qty : </td>
                    <td>
                        <b><?php echo $data['order']['qty']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Total : </td>
                    <td>
                        <b><?php echo  $data['order']['total']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Order Date: </td>
                    <td>
                        <b><?php echo $data['order']['order_date']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status_id">

                            <?php
                            foreach ($statusDetails as $status) {
                            ?>
                                <option value="<?php echo $status['id']; ?>">
                                    <?php echo $status['status']; ?>
                                </option>
                            <?php
                            }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>User_Name: </td>
                    <td>
                        <b><?php echo $data['order']['name']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>User Address: </td>
                    <td>
                        <b><?php echo $data['order']['user_address']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td>
                        <b><?php echo $data['order']['phone_number']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Delivery Price: </td>
                    <td>
                        <b><?php echo $data['order']['delivery_Price']; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Delivery Company: </td>
                    <td>
                        <b><?php echo $data['order']['delivery_CompanyName']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>