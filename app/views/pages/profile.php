<?php
require_once APPROOT . '/views/inc/header.php';
require_once APPROOT . '/views/components/auth_message.php';
$database = new Database();
?>

<?php
$sessionEmial = $_SESSION['email'];
$user = $database->getBySessionEmail('users', $sessionEmial);
$userId = $user['id'];
$userDetails = $database->getByEmail('vw_userprofile', $sessionEmial);


?>

<section class="food-search_profile">
    <div class="container">

        <h2 class="text-center text-white">User Information ;</h2>


        <form action="" method="POST" class="order">

            <fieldset>
                <legend><b>Profile Details</b></legend>


                <table class="tbl-32">
                    <tr>
                        <td><b>Name :</b></td>
                        <td>
                            <input type="text" name="name" class="input-responsiveUpdate" value="<?php echo $user['name']; ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Email :</b></td>
                        <td>
                            <input type="text" name="email" class="input-responsiveUpdate" value="<?php echo $user['email']; ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <td><b>PhoneNumber:</b> </td>
                        <td>
                            <input type="text" name="phoneNumber" class="input-responsiveUpdate" value="<?php echo $user['phone_number']; ?>" readonly>
                        </td>
                    </tr>

                    <?php
                    $count = 1;
                    foreach ($userDetails as $address) {
                    ?>
                        <tr>
                            <td><b>Address :<?php echo $count++; ?></b></td>
                            <td>
                                <input type="text" readonly name="address" class="input-responsiveAddress" value="<?php echo $address['user_address']; ?>">
                            </td>
                        </tr>
                    <?php
                    }
                    ?>


                </table>

                <a href="<?php echo URLROOT; ?>/Pages/update_profile/?id=<?php echo $userId; ?>" class="btn-secondary input-responsive">Edit_Profile</a>

            </fieldset>
        </form>

    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>