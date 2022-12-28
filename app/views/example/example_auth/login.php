<?php
/**
 * @var $data
 */
?>
<?php require_once APPROOT . '/views/example/example_inc/header.php'; ?>
<?php require_once APPROOT . '/views/example/example_inc/components/topnavbar.php' ?>



    <div class="form-container">
        <h1>Login</h1>
        <form action="" method="POST">

            <!-- Email field-->
            <div class="form-input-title">Email</div>
            <input type="text" name="email" class="email" id="email" value="<?php echo $data['email'] ?>">
            <span class="form-invalid"><?php echo $data['email_error'] ?></span>

            <!-- Password field-->
            <div class="form-input-title">Password</div>
            <input type="password" name="password" class="password" id="password">
            <span class="form-invalid"><?php echo $data['password_error'] ?></span>

            <br><br>
            <input type="submit" value="Register" class="form-btn">
        </form>
    </div>

<?php require_once APPROOT . '/views/example/example_inc/footer.php'; ?>