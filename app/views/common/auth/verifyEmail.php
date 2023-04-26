<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/common/inc/components/IntermediateNavBar.php';

Header::render(
    'Verify Email Address',
    [
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/components/intermediate-nav-bar.css',
        URLROOT . '/public/css/common/tutor-student-verify-email.css',
    ]
);

IntermediateNavBar::render($request);
?>

    <div class="main-area">
        <div class="main-container">

            <div class="login-form-container">
                <h1>Verify your email address</h1>

                <form action="" class="login-form" method="POST">

                    <div class="form-row">
                        <div class="form-field">
                            <label for="code">Please enter the verification code we sent to your email address</label>
                            <input type="text" class="form-input" name="code" id="login-email">
                            <span class="error"><?php echo $data['error'] ?></span>
                        </div>
                    </div>




                    <input type="submit" value="Verify" class="btn">

                    <a href="<?php echo URLROOT . '/verify-email?resend=true'?>" class="resend">Resend Code</a>
                </form>
            </div>
        </div>
    </div>

<?php Footer::render([]); ?>