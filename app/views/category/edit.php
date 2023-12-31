<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <form action="<?php echo URLROOT; ?>/Category/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['categories']['id']; ?>">
            <input type="hidden" name="current_image" value="<?php echo $data['categories']['image_name']; ?>">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $data['categories']['title']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($data['categories']['image_name'] != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/category_images/<?php echo $data['categories']['image_name']; ?>" width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($data['categories']['active'] == "Yes") {
                                    echo "Checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($data['categories']['active'] == "No") {
                                    echo "Checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $data['categories']['id']; ?> ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>