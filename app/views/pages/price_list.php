<?php
$database = new Database();
if (!empty($_GET['addressId']) && !empty($_GET['companyName'])) {

    $deliveryAddress = $_GET['addressId'];
    $companyID = $_GET['companyName'];

    $price =  $database->getPriceByAddressNameAndCompanyName(
        'vw_deliveryprice',
        'delivery_address',
        $deliveryAddress,
        'deliveryCompany_ID',
        $companyID
    );

?>

    <option value="<?php echo $price['Price_ID']; ?>"><?php echo $price['delivery_Price']; ?></option>
<?php
}
