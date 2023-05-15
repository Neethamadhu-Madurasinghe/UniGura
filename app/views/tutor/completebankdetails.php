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
                            <select id="bank" name="bank">
                                <option value="">--Please select--</option>
                                <option value="Commercial Bank" <?php echo $data['bank'] === 'Commercial Bank' ? 'selected' : '' ?>>Commercial Bank</option>
                                <option value="Hatton National Bank" <?php echo $data['bank'] === 'Hatton National Bank' ? 'selected' : '' ?>>Hatton National Bank</option>
                                <option value="National Savings Bank" <?php echo $data['bank'] === 'National Savings Bank' ? 'selected' : '' ?>>National Savings Bank</option>
                                <option value="Pan Asia Banking Corporation" <?php echo $data['bank'] === 'Pan Asia Banking Corporation' ? 'selected' : '' ?>>Pan Asia Banking Corporation</option>
                                <option value="People's Bank" <?php echo $data['bank'] === "People's Bank" ? 'selected' : '' ?>>People's Bank</option>
                                <option value="Sampath Bank" <?php echo $data['bank'] === 'Sampath Bank' ? 'selected' : '' ?>>Sampath Bank</option>
                                <option value="Seylan Bank" <?php echo $data['bank'] === 'Seylan Bank' ? 'selected' : '' ?>>Seylan Bank</option>
                            </select>
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
                            <select id="branch" name="branch">
                                <option value="">--Please select--</option>
                                <option value="Colombo" <?php echo $data['branch'] === 'Colombo' ? 'selected' : '' ?>>Colombo</option>
                                <option value="Kandy" <?php echo $data['branch'] === 'Kandy' ? 'selected' : '' ?>>Kandy</option>
                                <option value="Galle" <?php echo $data['branch'] === 'Galle' ? 'selected' : '' ?>>Galle</option>
                                <option value="Jaffna" <?php echo $data['branch'] === 'Jaffna' ? 'selected' : '' ?>>Jaffna</option>
                                <option value="Matara" <?php echo $data['branch'] === 'Matara' ? 'selected' : '' ?>>Matara</option>
                                <option value="Negombo" <?php echo $data['branch'] === 'Negombo' ? 'selected' : '' ?>>Negombo</option>
                                <option value="Trincomalee" <?php echo $data['branch'] === 'Trincomalee' ? 'selected' : '' ?>>Trincomalee</option>
                            </select>
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