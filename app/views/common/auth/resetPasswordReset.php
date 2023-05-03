<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/common/inc/components/LandingPageNavBar.php';

Header::render(
    'Login',
    [
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/components/tutor-student-login-nav-bar.css',
        URLROOT . '/public/css/common/tutor-student-reset-password.css',
        URLROOT . '/public/css/common/tutor-student-reset-password-override.css',
    ]
);

LandingPageNavBar::render($request)
?>

    <div class="main-area">
        <div class="main-container">
            <div class="image-area">
                <object>
                    <img src="<?php echo URLROOT . '/public/img/common/reset-password.jpg' ?>" alt="login">
                </object>
            </div>

            <div class="login-form-container">
                <h1>Set new password</h1>

                <form action="" class="login-form" method="POST">

                    <div class="form-row">
                        <div class="form-field">
                            <label for="password">Password
                                <span><?php echo $data['errors']['password_error'] ?></span>
                            </label>
                            <input type="password" class="form-input" name="password" id="login-password">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" class="form-input" name="confirm-password" id="login-password">
                        </div>
                    </div>

                    <input type="submit" value="Verify" class="btn">

                </form>
            </div>
        </div>
    </div>

<?php Footer::render([]); ?><?php
