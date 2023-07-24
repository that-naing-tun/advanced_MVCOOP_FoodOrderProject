<?php require_once APPROOT . '/views/inc/admin/header.php';

?>

<div class="main-content">
    <div class="wrapper">

        <h1>Add Food</h1>
        <br><br>

        <form action="<?php echo URLROOT; ?>/Food/store" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of The Food" required>
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the foods" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" required name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            foreach ($data['food'] as $category) {
                                $categoryActive = $category['active'];
                                if ($categoryActive == 'Yes') {
                                    $categoryId = $category['id'];
                                    $categoryTitle = $category['title'];
                            ?>

                                    <option value="<?php echo $categoryId; ?>"><?php echo $categoryTitle; ?></option>

                            <?php
                                }
                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" checked name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" checked name="active" value="Yes" required>Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>