<?php
session_start();
$database = new Database();
if (!empty($_GET['companyName'])) {
    $sessionEmial = $_SESSION['email'];
    $userDetails = $database->getByEmail('vw_userprofileupdate', $sessionEmial);

?>
    <option value="">Select Address</option>
    <?php foreach ($userDetails as $user) { ?>
        <option value="<?php echo $user['user_address']; ?>"><?php echo $user['user_address']; ?></option>
<?php }
}
