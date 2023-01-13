<?php
/**
 * @var $data
 */
?>

<?php require_once APPROOT . '/views/student/inc/header.php'; ?>

<link  rel="stylesheet" href="<?php echo URLROOT ?>/public/css/student-register.css" />
<title>Login</title>
</head>
<body>

<div class="form-container">
    <h1>Register</h1>
    <form action="" method="POST">
        <!-- Email field-->
        <div class="form-input-title">Email</div>
        <input type="text" name="email" class="email" id="email" value="<?php echo $data['email']?>">
        <span class="form-invalid"><?php echo $data['errors']['email_error']?></span>

        <!-- Password field-->
        <div class="form-input-title">Password</div>
        <input type="password" name="password" class="password" id="password"  value="<?php echo $data['password']?>">
        <span class="form-invalid"><?php echo $data['errors']['password_error']?></span>

        <!-- Confirm Password field-->
        <div class="form-input-title">Confirm Password</div>
        <input type="password" name="confirm-password" class="confirm_password" id="confirm_password"  value="<?php echo $data['confirm_password']?>">
        <span class="form-invalid"><?php echo $data['errors']['confirm_password_error']?></span>

        <br><br>
        <input type="submit" value="Register" class="form-btn">
    </form>
</div>

<?php require_once APPROOT . '/views/student/inc/footer.php'; ?>
