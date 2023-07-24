<?php require_once APPROOT . '/views/inc/admin/header.php';
$database = new Database();
$deliveryPrice = $database->readAll('price');
$deliveryPriceID = $data['delivery_price']['deliveryPrice_ID'];
$deliveryPriceDetails = $database->getById('delivery_price', $deliveryPriceID);

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Price</h1>
        <br><br>
        <form action="<?php echo URLROOT; ?>/DeliveryPrice/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="deliveryPrice_id" value="<?php echo $deliveryPriceID; ?>">
            <input type="hidden" name="street_id" value="<?php echo $deliveryPriceDetails['street_id']; ?>">
            <input type="hidden" name="township_id" value="<?php echo $deliveryPriceDetails['township_id']; ?>">
            <input type="hidden" name="city_id" value="<?php echo $deliveryPriceDetails['city_id']; ?>">
            <input type="hidden" name="deliveryCompany_id" value="<?php echo $deliveryPriceDetails['deliveryCompany_id']; ?>">


            <table class="tbl-30">

                <tr>
                    <td>Delivery Address : </td>
                    <td>
                        <b><?php echo $data['delivery_price']['delivery_address']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>DeliveryCompany_Name : </td>
                    <td>
                        <b><?php echo  $data['delivery_price']['deliveryCompany_Name']; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Delivery_Price : </td>
                    <td>
                        <select name="price_id">

                            <?php
                            foreach ($deliveryPrice as $price) {
                            ?>
                                <option value="<?php echo $price['id']; ?>">
                                    <?php echo $price['price']; ?>
                                </option>
                            <?php
                            }
                            ?>

                        </select>
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