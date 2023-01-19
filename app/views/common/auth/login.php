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

$header = new Header(
    'Login',
    [
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/components/tutor-student-login-nav-bar.css',
        URLROOT . '/public/css/common/tutor-student-login.css',
    ]
);

$navbar = new LandingPageNavBar($request);

$header->render();
?>

<?php $navbar->render(); ?>

<div class="main-area">
    <div class="main-container">

        <div class="image-area">
            <object>
                <img src="<?php echo URLROOT . '/public/img/common/Mobile login-pana.svg' ?>" alt="login">
            </object>
        </div>

        <div class="login-form-container">
            <h1>Login</h1>
            <p>Register as a
                <a href="<?php echo URLROOT . '/student/register' ?>">Student</a>
                or
                <a href="<?php echo URLROOT . '/tutor/register' ?>">Tutor</a>
            </p>

            <form action="" class="login-form" method="POST">

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
                    <div class="remember-me-field">
                        <input type="checkbox" id="login-remember-me" name="remember-me">
                        <label for="login-remember-me">Remember me</label>
                    </div>
                    <div class="reset-password-field">
                        <a href="" id="reset-password">Reset password</a>
                    </div>
                </div>

                <input type="submit" value="Login" class="btn">

            </form>
        </div>
    </div>
</div>

<?php Footer::render([]); ?>
