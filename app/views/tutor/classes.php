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
    'Tutor Dashboard',
    [
        URLROOT . '/public/css/tutor/base.css?v=1.0',
        URLROOT . '/public/css/tutor/class.css?v=1.8'
    ]
);

MainNavbar::render($request);
?>








?>