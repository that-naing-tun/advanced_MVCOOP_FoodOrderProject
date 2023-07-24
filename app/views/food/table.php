<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Foods</h1>
        <br /> <br />

        <a href="<?php echo URLROOT; ?>/dashboard/addfood" class="btn-primary">Add Foods</a>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $serialnumber = 1;
            foreach ($data['food'] as $foods) {
            ?>
                <tr>
                    <td><?php echo $serialnumber++ ?></td>
                    <td><?php echo $foods['title']; ?></td>
                    <td><?php echo $foods['price']; ?></td>
                    <td>
                        <?php
                        $foodsimage = $foods['image_name'];
                        if ($foodsimage != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/food_images/<?php echo $foodsimage; ?>" width="100px">
                        <?php
                        } else {
                        ?>
                            <div class="error"><?php echo setMessage('error', 'Image is not Avialable '); ?></div>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?php echo $foods['featured']; ?></td>
                    <td><?php echo $foods['active']; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/Food/editFood/<?php echo base64_encode($foods['id']);  ?>" class="btn-secondary">Update Food</a>
                        <a href="<?php echo URLROOT; ?>/Food/destroy/<?php echo $foods['id']; ?>" class="btn-danger">Delete Food</a>
                    </td>
                </tr>
            <?php
            }
            ?>


        </table>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>