<?php require_once APPROOT . '/views/inc/admin/header.php';

?>



<div class="main-content">
    <div class="wrapper">
        <h1>Add Delivery_Company</h1>
        <br><br>


        <form action="<?php echo URLROOT; ?>/DeliveryCompany/store" method="POST" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>

                <tr>
                    <td>Company_name:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add-Category_Company" class="btn-secondary" required>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>