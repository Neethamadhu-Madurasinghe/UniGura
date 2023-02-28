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
    'Complete Profile',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/complete-profile.css'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="main-area-container">
    <div class="main-area">
        <h1 class="main-title">Complete Your Profile</h1>
        <form action="" id="complete-profile-form" method="POST" enctype='multipart/form-data'>
            <div class="form first">
                <div class="form-main-area">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="bank-name">Bank Name
                                <span><?php echo $data['errors']['bank_error'] ?></span>
                            </label>
                            <input type="text" name="bank" id="" value="<?php echo $data['bank'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="account-number">Account Number
                                <span><?php echo $data['errors']['account_number_error'] ?></span>
                            </label>
                            <input type="text" name="account-number" id="" value="<?php echo $data['account_number'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label for="account-name"> Account Name
                                <span><?php echo $data['errors']['account_name_error'] ?></span>
                            </label>
                            <input type="text" name="account-name" id="" value="<?php echo $data['account_name'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="branch"> Branch
                                <span><?php echo $data['errors']['branch_error'] ?></span>
                            </label>
                            <input type="text" name="branch" id="" value="<?php echo $data['branch'] ?>">
                        </div>
                    </div>

                    <div id="submit-btn-container">
                        <input type="submit" id="submit" value="Next" class="btn btn-search">
                    </div>
                </div>
        </form>
    </div>
</div>


<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js'

    ]
); ?>