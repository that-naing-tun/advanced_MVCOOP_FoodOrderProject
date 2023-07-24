<?php

session_start();
require_once APPROOT . '/views/inc/admin/header.php';
require_once APPROOT . '/views/components/auth_message.php';
//print_r($data);
?>



<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br /> <br />

        <a href="<?php echo URLROOT; ?>/dashboard/createcategory" class="btn-primary">Add Category</a>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $serialNuber = 1;
            foreach ($data['category'] as $category) {
            ?>

                <tr>
                    <td><?php echo $serialNuber++  ?></td>
                    <td><?php echo $category['title']; ?></td>
                    <td>
                        <?php
                        $categoryImage = $category['image_name'];
                        if ($categoryImage != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/category_images/<?php echo $categoryImage; ?>" width="100px">
                        <?php
                        } else {
                        ?>
                            <div class="error"><?php echo setMessage('error', 'Image is not Avialable '); ?></div>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?php echo $category['active']; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/Category/editcategory/<?php echo base64_encode($category['id']);  ?>" class="btn-secondary">Update Category</a>
                        <a href="<?php echo URLROOT; ?>/Category/destroy/<?php echo $category['id']; ?>" class="btn-danger">Delete Category</a>
                    </td>
                </tr>

            <?php
            }

            ?>

        </table>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>