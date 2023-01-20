<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/student/inc/components/MainNavbar.php';


Header::render(
    'Dashboard',
    [
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/student/components/main-nav-bar.css',

    ]
);

MainNavbar::render($request);
?>



<?php Footer::render(
    [

        URLROOT . '/public/js/student/student-main-nav-bar.js'
    ]
); ?>