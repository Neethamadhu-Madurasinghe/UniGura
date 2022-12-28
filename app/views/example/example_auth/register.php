<?php
/**
 * @var $data
 */
?>
<?php require_once APPROOT . '/views/example/example_inc/header.php'; ?>
<?php require_once APPROOT . '/views/example/example_inc/components/topnavbar.php' ?>



<div class="form-container">
    <h1>Register</h1>
    <form action="" method="POST">
        <!-- Name field-->
        <div class="form-input-title">Name</div>
        <input type="text" name="name" class="name" id="name" value="<?php echo $data['name']?>">
        <span class="form-invalid"><?php echo $data['name_error']?></span>

        <!-- Email field-->
        <div class="form-input-title">Email</div>
        <input type="text" name="email" class="email" id="email" value="<?php echo $data['email']?>">
        <span class="form-invalid"><?php echo $data['email_error']?></span>

        <!-- Password field-->
        <div class="form-input-title">Password</div>
        <input type="password" name="password" class="password" id="password"  value="<?php echo $data['password']?>">
        <span class="form-invalid"><?php echo $data['password_error']?></span>

        <!-- Confirm Password field-->
        <div class="form-input-title">Confirm Password</div>
        <input type="password" name="confirm_password" class="confirm_password" id="confirm_password"  value="<?php echo $data['confirm_password']?>">
        <span class="form-invalid"><?php echo $data['confirm_password_error']?></span>

        <br><br>
        <input type="submit" value="Register" class="form-btn">
    </form>
</div>

<?php require_once APPROOT . '/views/example/example_inc/footer.php'; ?>