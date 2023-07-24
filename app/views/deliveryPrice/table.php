<?php require_once APPROOT . '/views/inc/admin/header.php';
$database = new Database();
$orderall = $database->readAll('vw_deliveryprice');

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage DeliveryPrice</h1>
        <br /> <br />

        <a href="<?php echo URLROOT; ?>/dashboard/deliverypriceCreate" class="btn-primary">Add DeliveryPrice</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N </th>
                <th>Address </th>
                <th>DeliveryCompany </th>
                <th>Price </th>
                <th>Active</th>

            </tr>

            <?php
            $sn = 1;
            foreach ($orderall as $order) {
            ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $order['delivery_address'] ?></td>
                    <td><?php echo $order['deliveryCompany_Name'] ?></td>
                    <td><?php echo $order['delivery_Price'] ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/DeliveryPrice/editdeliveryPrice/<?php echo $order['deliveryPrice_ID'];  ?>" class="btn-secondary">Update </a>
                    </td>
                </tr>
            <?php
            } ?>
        </table>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>