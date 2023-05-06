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
require_once APPROOT . '/views/student/inc/components/MainNavbar.php';


if ($request->isLoggedIn()) {
    Header::render(
        'Login',
        [
            URLROOT . '/public/css/common/student-base-style.css',
            URLROOT . '/public/css/student/components/main-nav-bar.css',
            URLROOT . '/public/css/common/not-found.css',

        ]
    );
}else {
    Header::render(
        'Login',
        [
            URLROOT . '/public/css/common/student-base-style.css',
            URLROOT . '/public/css/components/tutor-student-login-nav-bar.css',
            URLROOT . '/public/css/common/not-found.css',
        ]
    );
}

if ($request->isLoggedIn()) {
    MainNavbar::render($request);
}else {
    LandingPageNavBar::render($request);
}

?>

    <div class="main-area">
        <div class="main-container">
            <div class="container">
                <h1 class="title">404 Not Found</h1>
                <p class="subtitle">Oops! The page you requested could not be found.</p>
                <a class="home-link" href="<?php echo URLROOT . '/login' ?>">Go to Home Page</a>
            </div>
        </div>
    </div>

<?php Footer::render([]); ?>