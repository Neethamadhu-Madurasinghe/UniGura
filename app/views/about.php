<?php
/**
 * @var $data
 */

require_once APPROOT . "/views/example_inc/header.php";
?>

    <h1>Users</h1>
    <?php
    foreach ($data['example_auth'] as $user): ?>
        <p><?php echo $user->name . ' ' . $user->email ?></p>
    <?php endforeach;?>

    <?php require_once APPROOT . "/views/example_inc/footer.php"; ?>



