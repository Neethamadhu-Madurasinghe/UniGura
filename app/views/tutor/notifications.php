<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/tutor/inc/components/MainNavbar.php';

Header::render(
    'Tutor Notifications',
    [
        URLROOT . '/public/css/tutor/base.css?v=1.0',
        URLROOT . '/public/css/tutor/notification.css?v=1.0'
    ]
);

MainNavbar::render($request);
?>
    <section >
        
        <div class="container">

            <div class="right">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>
            <div class="left">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>

            </div>

        </div>
    </section>


<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js'
    ]
);
?>

