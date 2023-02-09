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
        URLROOT . '/public/css/tutor/complete-profile.css',
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="main-area-container">
    <div class="main-area">
        <h1 class="main-title">My Profile</h1>
        <form action="update-profile" id="complete-profile-form" method="POST" enctype='multipart/form-data'>
            <div class="upload-picture-container">
                <img src="<?php echo URLROOT . '/public/img/tutor/profile.png' ?>" alt="" id="profile-picture">
                <input type="file" id="actual-btn" name="profile-picture" accept="image/*" hidden />
                <label for="actual-btn" id="profile-image-upload-btn">Upload Profile Picture</label>
            </div>

            <div class="form-main-area">

                <div class="form-field">
                    <label for="first-name">First Name
                        <!-- <span><?php echo $data['errors']['first_name_error'] ?></span>  -->
                    </label>
                    <input type="text" name="first-name" id="">
                </div>
                <div class="form-field">
                    <label for="last-name">Last Name
                        <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                    </label>
                    <input type="text" name="last-name" id="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="last-name">Subject
                        <!--  <span><?php echo $data['errors']['subject_error'] ?></span> -->
                    </label>
                    <input type="text" name="lsubject" id="">
                </div>
                <div class="form-field">
                    <label for="telephone-number">Phone Number
                        <!-- <span><?php echo $data['errors']['phone_number_error'] ?></span> -->
                    </label>
                    <input type="text" name="phone-number" id="">
                </div>

            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="street">District
                        <!--   <span><?php echo $data['errors']['district_error'] ?></span> -->
                    </label>
                    <input type="text" name="district" id="">
                </div>

                <div class="form-field">
                    <label for="city">City
                        <!--<span><?php echo $data['errors']['city_error'] ?></span> -->
                    </label>
                    <input type="text" name="city" id="">
                </div>

            </div>

            <div id="submit-btn-container">
                <input type="submit" value="Finish" class="btn btn-search">
            </div>


            <?php Footer::render(
                [
                    'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
                    URLROOT . '/public/js/common/student-tutor-complete-profile.js'
                ]
            ); ?>