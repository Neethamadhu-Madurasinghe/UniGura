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

$navbar = new LandingPageNavBar($request);

Header::render(
    'Register as a Tutor',
    [
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/components/tutor-student-login-nav-bar.css',
        URLROOT . '/public/css/common/tutor-student-register.css',
    ]
);

LandingPageNavBar::render($request)
?>

<div class="main-area">
    <div class="main-container">

        <div class="image-area">
            <object>
                <img src="<?php echo URLROOT . '/public/img/common/Mobile login-rafiki.svg' ?>"
                     alt="register_page_image">
            </object>
        </div>

        <div class="login-form-container">
            <h1>Register as a Tutor</h1>
            <p>Already have an account?
                <a href="<?php echo URLROOT . '/login' ?>">Login</a>
            </p>

            <form action="" class="login-form" method="POST" id="register-form">

                <div class="form-row">
                    <div class="form-field">
                        <label for="email">Email <span><?php echo $data['errors']['email_error'] ?></span></label>
                        <input type="text"
                               class="form-input"
                               name="email"
                               id="login-email"
                               value="<?php echo $data['email'] ?>">
                    </div>
                </div>

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
                        <input type="password" class="form-input" name="confirm-password" id="login-password-confirm">
                    </div>
                </div>
                <input type="submit" value="Register" class="btn">
            </form>
        </div>
    </div>
</div>

<?php Footer::render([
    URLROOT . '/public/js/common/login-signup-validation.js'
]); ?>
