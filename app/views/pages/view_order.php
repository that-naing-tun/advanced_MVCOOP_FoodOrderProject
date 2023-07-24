<?php
require_once APPROOT . '/views/inc/header.php';
$database = new Database();
$email = $_SESSION['email'];
$user = $database->getBySessionEmail('users', $email);
$userId = $user['id'];
$orderdetails = $database->getByIdAll('vw_orderall', $userId);
?>

<hr>
<table class="order_table">
    <thead>
        <tr>
            <th>No</th>
            <th>User Name</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Delivery Company</th>
            <th>Delivery Fee</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sn = 1;
        foreach ($orderdetails as $order) {
        ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $order['name']; ?></td>
                <td><?php echo $order['title']; ?></td>
                <td><?php echo $order['food_Price']; ?></td>
                <td><?php echo $order['qty']; ?></td>
                <td><?php echo $order['total']; ?></td>
                <td><?php echo $order['status']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['delivery_CompanyName']; ?></td>
                <td><?php echo $order['delivery_Price']; ?></td>
                <td><?php echo $order['user_address']; ?></td>
                <td><?php echo $order['phone_number']; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<hr>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>