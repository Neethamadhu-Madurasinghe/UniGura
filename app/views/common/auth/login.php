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
        URLROOT . '/public/css/common/tutor-student-login.css',
    ]
);

LandingPageNavBar::render($request)
?>

<div class="main-area">
    <div class="main-container">
        <div class="image-area">
            <object>
                <img src="<?php echo URLROOT . '/public/img/common/Mobile login-pana.svg' ?>" alt="login">
            </object>
        </div>

        <div class="login-form-container">
            <h1>Login</h1>
            <p>Not already registered ? Register as a
                <a href="<?php echo URLROOT . '/student/register' ?>">Student</a>
                or
                <a href="<?php echo URLROOT . '/tutor/register' ?>">Tutor</a>
            </p>

            <form action="" class="login-form" method="POST" id="login-form">

                <div class="form-row">
                    <div class="form-field">
                        <label for="email">Email <span id="email-error"><?php echo $data['errors']['email_error'] ?></span></label>
                        <input type="text" class="form-input" name="email" id="login-email" value="<?php echo $data['email'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="password">Password
                            <span  id="password-error"><?php echo $data['errors']['password_error'] ?></span>
                        </label>
                        <input type="password" class="form-input" name="password" id="login-password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="remember-me-field">
                        <input type="checkbox" id="login-remember-me" name="remember-me">
                        <label for="login-remember-me">Remember me</label>
                    </div>
                    <div class="reset-password-field">
                        <a href="<?php echo URLROOT . '/reset-password/initiate' ?>" id="reset-password">Reset password</a>
                    </div>
                </div>

                <input type="submit" value="Login" class="btn">

            </form>
        </div>
    </div>
</div>

<?php Footer::render([
    URLROOT . '/public/js/common/login-signup-validation.js'
]); ?>