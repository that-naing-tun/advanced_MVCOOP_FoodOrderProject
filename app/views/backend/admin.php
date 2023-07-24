<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            $serialNuber = 1;
            foreach ($data['user'] as $user) {
                $role = $user['role'];
                if ($role == 1) {
            ?>
                    <tr>
                        <td><?php echo $serialNuber++ ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/Users/destroy/<?php echo base64_encode($user['id']); ?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </table>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>