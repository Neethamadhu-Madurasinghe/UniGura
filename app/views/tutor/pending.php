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
        URLROOT . '/public/css/tutor/pendingpage.css'
    ]
);

?>

    <div class="container">
        <div class="header">
            <h1>Welcome , <?php echo $data['user_name']?></h1>
        </div>
        <hr>
        <img src="<?php echo URLROOT ?>/public/img/tutor/img2.png" alt="user greet">
        <div class="text">
            <p>Your account is pending and submited for approvel.</p>
        </div>
    </div>


<?php Footer::render(
    [
        
    ]
);
?>

