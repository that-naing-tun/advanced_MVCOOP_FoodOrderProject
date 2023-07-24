<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/Delivery.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/order.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <!-- <link rel="stylesheet" href="/css/admin.css"> -->


</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="<?php echo URLROOT; ?>/images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/pages/categories">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/pages/foods">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/pages/view_order">Order Table</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/pages/login">Logout</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/pages/profile">Profile</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->