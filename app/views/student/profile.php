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
require_once APPROOT . '/views/student/inc/components/TutoringClassCard.php';


Header::render(
    'Profile',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/components/error-success-popup.css',
        URLROOT . '/public/css/student/profile.css'
    ]
);
?>

<div class="error-layout-background invisible">

    <div class="popup-error-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/cross.png' ?>" alt="" srcset="">
        <p id="error-message"></p>
        <button class="btn btn-search" id="error-ok">OK</button>
    </div>

    <div class="popup-success-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/success.png' ?>" alt="" srcset="">
        <p id="success-message"></p>
        <button class="btn btn-search" id="success-ok">OK</button>
    </div>

</div>

<div class="layout-background invisible">

    <div class="popup-send-message invisible">
        <p id="popup-heading">Complete 2FA First</p>
        <p id="popup-subheading">Enter the code we sent to your email</p>
        <input type="text" id="otp-input">
        <div class="send-msg-btn-container">
            <button class="btn btn-msg" id="reset-cancel">Cancel</button>
            <button class="btn btn-msg" id="reset-send">OK</button>
        </div>
        <p id="popup-resend">Resend the code</p>
    </div>

    <div class="popup-change-password invisible">
        <p id="popup-heading">Enter new password</p>
        <input type="password" id="new-password-input" class="password-confirm-input" placeholder="New Password">
        <input type="password" id="new-password-confirm-input" class="password-confirm-input" placeholder="Confirm Password">
        <div class="send-msg-btn-container">
            <button class="btn btn-msg" id="change-cancel">Cancel</button>
            <button class="btn btn-msg" id="change-send">OK</button>
        </div>
    </div>

    <div class="popup-delete-request invisible">
        <p id="popup-delete-heading">Are you sure you want to delete this request ?</p>
        <div class="confirm-btn-container">
            <button class="btn btn-msg" id="cancel-request-deletion">Cancel</button>
            <button class="btn btn-msg" id="confirm-request-confirm">Delete</button>
        </div>
    </div>

    <div class="popup-disable-profile invisible">
        <p id="popup-delete-heading">Are you sure you want to disable your account ?</p>
        <div class="confirm-btn-container">
            <button class="btn btn-msg" id="cancel-profile-disable">Cancel</button>
            <button class="btn btn-msg" id="confirm-profile-disable">Disable</button>
        </div>
    </div>

    <div class="popup-feedback-form invisible">
        <h1>Post a review</h1>
        <div class="feedback-star-container hidden">
            <img id="star-1" class="star" src="<?php echo URLROOT . '/public/img/student/big.png' ?>" alt="" srcset="">
            <img id="star-2" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
            <img id="star-3" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
            <img id="star-4" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
            <img id="star-5" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
        </div>
        <div class="comments-container">
            <p>Leave a comment (Optional):</p>
            <textarea name="" id="feedback-input" cols="30" rows="10"></textarea>
        </div>

        <div class="submit-btn-container">
            <button class="btn" id="feedback-cancel">Cancel</button>
            <button class="btn" id="feedback-ok">Submit</button>
        </div>
    </div>

    <div class="loader invisible"></div>
</div>


<?php
MainNavbar::render($request);
?>

<div class="main-area-container">

    <form action="<?php echo URLROOT . '/student/change-profile-picture' ?>"
          id="image-upload-form"
          enctype = "multipart/form-data"
          method="post">
        <h1 class="main-title">Hello <?php echo $data['first_name'] . " " . $data['last_name'] ?> </h1>
        <div class="upload-picture-container">
            <img src="<?php echo URLROOT . $request->getUserPicture() ?>" alt="" id="profile-picture">
            <input type="file" name="profile-picture" id="actual-btn" accept="image/*" hidden onchange="this.form.submit()" />
            <label for="actual-btn" id="profile-image-upload-btn">Change Profile Picture</label>
        </div>
    </form>

    <div class="main-area">

        <div class="utility-button-container">
            <button class="btn btn-utility" id="disable-profile">Disable Account</button>
            <button class="btn btn-utility" id="change-password">Change password</button>
            <button class="btn btn-utility" id="give-feedback">Give us a Feedback !!</button>
        </div>

        <form action="" method="post" id="complete-profile-form">
            <div class="form-main-area">

                <div class="form-row">
                    <div class="form-field">
                        <label for="first-name">First Name
                            <span id="first-name-error"><?php echo $data['errors']['first_name_error'] ?></span>
                        </label>
                        <input type="text" name="first-name" id="first-name-input" value="<?php echo $data['first_name'] ?>">
                    </div>
                    <div class="form-field">
                        <label for="last-name">Last Name
                            <span id="last-name-error"><?php echo $data['errors']['last_name_error'] ?></span>
                        </label>
                        <input type="text" name="last-name" id="last-name-input" value="<?php echo $data['last_name'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="address-line-1">Address Line 1
                            <span id="address-line-one-error"><?php echo $data['errors']['address_line_1_error'] ?></span>
                        </label>
                        <input type="text"
                               name="address-line-1"
                               id="address-one-input"
                               value="<?php echo $data['address_line1'] ?>">
                    </div>
                    <div class="form-field">
                        <label for="address_line_2">Address Line 2
                            <span id="address-line-two-error"><?php echo $data['errors']['address_line_2_error'] ?></span>
                        </label>
                        <input type="text"
                               name="address-line-2"
                               id="address-two-input"
                               value="<?php echo $data['address_line2'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="city">City <span <span id="city-error"><?php echo $data['errors']['city_error'] ?></span></label>
                        <input type="text" name="city" id="city-input" value="<?php echo $data['city'] ?>">
                    </div>
                    <div class="form-field">
                        <label for="district">District<span><?php echo $data['errors']['district_error'] ?></span></label>

                        <?php
                        $districts = array(
                            'Ampara', 'Anuradhapura', 'Badulla', 'Batticaloa', 'Colombo', 'Galle', 'Gampaha', 'Hambantota',
                            'Jaffna', 'Kalutara', 'Kandy', 'Kegalle', 'Kilinochchi', 'Kurunegala', 'Mannar', 'Matale', 'Matara',
                            'Moneragala', 'Mullaitivu', 'Nuwara Eliya', 'Polonnaruwa', 'Puttalam', 'Ratnapura', 'Trincomalee', 'Vavuniya'
                        );
                        ?>

                        <select name="district">
                            <?php foreach ($districts as $district) : ?>
                                <option value="<?php echo $district; ?>"<?php echo ($data['district'] === $district) ? 'selected' : ''; ?>>
                                    <?php echo $district; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="telephone-number">Telephone Number
                            <span id="telephone-error"><?php echo $data['errors']['telephone_number_error'] ?></span>
                        </label>
                        <input type="text"
                               name="telephone-number"
                               id="telephone-input"
                               value="<?php echo $data['phone_number'] ?>">
                    </div>
                    <div class="form-field">
                        <label for="gender">Gender</label>
                        <select name="gender">
                            <option value="not-selected"
                                <?php echo $data['gender'] === 'not-selected' ? 'selected' : '' ?>>
                                Not Selected
                            </option>
                            <option value="male"
                                <?php echo $data['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female"
                                <?php echo $data['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="medium">Medium</label>
                        <select name="medium" >
                            <option value="sinhala"
                                <?php echo $data['medium'] === 'sinhala' ? 'selected' : '' ?>>Sinhala</option>
                            <option value="english"
                                <?php echo $data['medium'] === 'english' ? 'selected' : '' ?>>English</option>
                            <option value="tamil"
                                <?php echo $data['medium'] === 'tamil' ? 'selected' : '' ?>>Tamil</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="year-of-exam">Year of Exam
                            <span id="exam-year-error"><?php echo $data['errors']['year_of_exam_error'] ?></span>
                        </label>
                        <input type="number" id="exam-year-input" name="year-of-exam" value="<?php echo $data['year_of_exam'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="preferred-class-mode">Preferred Class Mode</label>
                        <select name="preferred-class-mode" id="preferred-class-mode">
                            <option value="online"
                                <?php echo $data['mode'] === 'online' ? 'selected' : '' ?>>
                                Online
                            </option>
                            <option value="physical"
                                <?php echo $data['mode'] === 'physical' ? 'selected' : '' ?>>
                                Physical
                            </option>
                            <option value="both"
                                <?php echo $data['mode'] === 'both' ? 'selected' : '' ?>>
                                Both
                            </option>
                        </select>
                    </div>
                </div>

                <div class="map-container" id="map-container">
                    <p>Select location</p>
                    <div id="map" class="map"></div>
                    <div id="marker"
                         title="Marker"
                         style="<?php echo 'background:url(' . URLROOT . '/public/img/student/marker-64.ico)
                                     no-repeat top center; background-size: contain;' ?>">

                    </div>
                    <input type="number"
                           id="longitude"
                           name="longitude"
                           readonly
                           value="<?php echo $data['longitude']; ?>">

                    <input type="number"
                           id="latitude"
                           name="latitude"
                           readonly
                           value="<?php echo $data['latitude']; ?>">
                </div>


                <div id="submit-btn-container">
                    <input type="submit" value="Update" class="btn btn-search">
                </div>
            </div>
        </form>


    </div>
</div>

<?php Footer::render(
    [

        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        'https://cdn.jsdelivr.net/npm/chart.js',
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js',
        URLROOT . '/public/js/student/profile.js',
        URLROOT . '/public/js/student/student-profile-payment-table.js',
        URLROOT . '/public/js/student/disable-profile.js',
        URLROOT . '/public/js/student/feedback.js',
        URLROOT . '/public/js/common/tutor-student-profile-detail-validator-functions.js',
        URLROOT . '/public/js/common/tutor-student-profile-detail-validator.js'
    ]
);
?>

