<?php
require_once APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/components/auth_message.php';
$database = new Database();
?>

<?php
$sessionEmial = $_SESSION['email'];
$user = $database->getBySessionEmail('users', $sessionEmial);
$userId = $user['id'];
$userPh_Number = $user['phone_number'];
$userDetails = $database->getByEmail('vw_userprofileupdate', $sessionEmial);
$deliveryCompany =   $database->readAll('delivery_company');

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>


        <form action="<?php echo URLROOT; ?>/Order/store" method="POST" class="order">
            <input type="hidden" name="food_id" value="<?php echo $data['food']['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $userId ?>">
            <input type="hidden" name="user_Ph" value="<?php echo $userPh_Number ?>">

            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($data['food']['image_name']) {
                    ?>
                        <img src="<?php echo URLROOT; ?>/food_images/<?php echo $data['food']['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    } else {
                        echo "<div class = 'error'> Image Not Available ;";
                    }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $data['food']['title']; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $data['food']['title']; ?>">

                    <p class="food-price">$<?php echo $data['food']['price']; ?></p>
                    <input type="hidden" name="price" value="<?php echo $data['food']['price']; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required min="1">

                </div>

            </fieldset>

            <fieldset>
                <legend>Choose address</legend>

                <table class="tbl-30">
                    <tr>
                        <td>
                            <label for="delivery-company" class="order-label">Delivery Company</label>
                            <br>
                            <select required class="input-address" id="delivery-company" name="delivery_company" onchange='GetCompany(this.value)'>
                                <option id="company" required selected="selected">Company Name</option>
                                <?php
                                foreach ($deliveryCompany as $company) {
                                ?>
                                    <option value="<?php echo $company['id']; ?>"><?php echo $company['company_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="address" class="order-label">Address</label>
                            <br>
                            <select required class="input-address" id="address" name="user_address" onchange="GetPrice(this.value, document.getElementById('delivery-company').value)">
                                <option required selected="selected">Select Address</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                        <td>Delivery Fee:</td>
                        <td>
                            <select required class="input-responsive" id="price_name" name="price_id" required>
                                <option required selected="selected">Suitable Price</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <br><br>
                <input type="submit" name="submit" value="Conform_Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<script>
    $(document).ready(function() {

        GetCompany(companyName);
        GetPrice(addressId, companyName);
    });

    function GetCompany(companyName) {
        var url = ' pages';
        var form_url = '<?php echo URLROOT; ?>/' + url + '/address';
        $.ajax({
            url: form_url,
            type: 'GET',
            data: jQuery.param({
                companyName: companyName
            }),
            success: function(address_list) {
                document.getElementById("address").innerHTML = address_list;
            }
        });
    }

    function GetPrice(addressId, companyName) {
        var url = 'pages';
        var form_url = '<?php echo URLROOT; ?>/' + url + '/price';
        $.ajax({
            url: form_url,
            type: 'GET',
            data: jQuery.param({
                addressId: addressId,
                companyName: companyName
            }),
            success: function(price) {
                document.getElementById("price_name").innerHTML = price;
            }
        });
    }
</script>