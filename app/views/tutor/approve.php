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
    'Tutor Approved',
    [
        URLROOT . '/public/css/tutor/approve.css?v=1.5'
    ]
);

?>


    <div class="container">
        <div class="header">
        <h1>Welcome , <?php echo $data['user_name']?></h1>
        </div>
        <hr>
        <div class="image">
        <img src="<?php echo URLROOT ?>/public/img/tutor/img3.png" alt="user greet">
        </div>
        <div class="text">
            Your Tutor Request has been Approved. 
        </div>
        <div class="message">
            To make your profile live please complete the required details
        </div>
        <div class="button">
            <a href="<?php echo URLROOT?>/tutor/complete-bank-detials">Complete Profile</a>
        </div>
        
    </div>

<?php Footer::render(
    [
        
    ]
);
?>