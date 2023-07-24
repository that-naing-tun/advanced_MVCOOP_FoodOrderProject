<?php
require_once APPROOT . '/views/inc/admin/header.php';
require_once APPROOT . '/views/components/auth_message.php';
?>



<div class="main-content">
    <div class="wrapper">
        <h1>Manage Delivery </h1>
        <br /> <br />

        <a href="<?php echo URLROOT; ?>/dashboard/createDeliveryCompany" class="btn-primary">Add Delivery</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Image</th>
                <th>Company_Name</th>
            </tr>

            <?php
            $sn = 1;
            foreach ($data['delivery_company'] as $delivery_company) {
            ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td>
                        <?php
                        $delivery_companyImage = $delivery_company['image'];
                        if ($delivery_companyImage != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/deliveryCompany_images/<?php echo $delivery_companyImage; ?>" width="100px">
                        <?php
                        } else {
                        ?>
                            <div class="error"><?php echo setMessage('error', 'Image is not Avialable '); ?></div>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?php echo $delivery_company['company_name']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>