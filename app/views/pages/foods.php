<?php
require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/components/auth_message.php'; ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.html" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $count = 0;
        foreach ($data['food'] as  $food) {

            if ($food['active'] == "Yes") {
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo URLROOT; ?>/food_images/<?php echo $food['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $food['title']; ?></h4>
                        <p class="food-price">$<?php echo $food['price']; ?></p>
                        <p class="food-detail">
                            <?php echo $food['description']; ?>
                        </p>
                        <br>
                        <a href="<?php echo URLROOT; ?>/Order/foodorder/<?php echo $food['id']; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


<?php require_once APPROOT . '/views/inc/footer.php'; ?>