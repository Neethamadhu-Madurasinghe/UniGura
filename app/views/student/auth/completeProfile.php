<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/common/inc/components/IntermediateNavBar.php';


Header::render(
    'Complete Profile',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/components/intermediate-nav-bar.css',
        URLROOT . '/public/css/student/complete-profile.css',
    ]
);

IntermediateNavBar::render($request);

?>
    <div class="main-area-container">
        <div class="main-area">
            <h1 class="main-title">Complete Your Profile</h1>
            <form action="" id="complete-profile-form" method="POST" enctype = "multipart/form-data">
                <div class="upload-picture-container">
                    <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" id="profile-picture">
                    <input type="file" id="actual-btn" name="profile-picture" accept="image/*" hidden/>
                    <label for="actual-btn" id="profile-image-upload-btn">Upload Profile Picture</label>
                </div>

                <div class="form-main-area">

                    <div class="form-row">
                        <div class="form-field">
                            <label for="first-name">First Name *
                                <span id="first-name-error"><?php echo $data['errors']['first_name_error'] ?></span>
                            </label>
                            <input type="text" name="first-name" id="first-name-input" value="<?php echo $data['first_name'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="last-name">Last Name *
                                <span id="last-name-error"><?php echo $data['errors']['last_name_error'] ?></span>
                            </label>
                            <input type="text" name="last-name" id="last-name-input" value="<?php echo $data['last_name'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="address-line-1">Address Line 1 *
                                <span id="address-line-one-error"><?php echo $data['errors']['address_line_1_error'] ?></span>
                            </label>
                            <input type="text"
                                   name="address-line-1"
                                   id="address-one-input"
                                   value="<?php echo $data['address_line_1'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="address_line_2">Address Line 2
                                <span id="address-line-two-error"><?php echo $data['errors']['address_line_2_error'] ?></span>
                            </label>
                            <input type="text"
                                   name="address-line-2"
                                   id="address-two-input"
                                   value="<?php echo $data['address_line_2'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="city">City * <span id="city-error"><?php echo $data['errors']['city_error'] ?></span></label>
                            <input type="text" name="city" id="city-input" value="<?php echo $data['city'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="district">District * <span id="city-error"><?php echo $data['errors']['district_error'] ?></span></label>
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
                            <label for="telephone-number">Telephone Number *
                                <span id="telephone-error"><?php echo $data['errors']['telephone_number_error'] ?></span>
                            </label>
                            <input type="text"
                                   name="telephone-number"
                                   id="telephone-input"
                                   value="<?php echo $data['telephone_number'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="gender">Gender</label>
                            <select name="gender" id="">
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
                            <select name="medium" id="">
                                <option value="sinhala"
                                    <?php echo $data['medium'] === 'sinhala' ? 'selected' : '' ?>>Sinhala</option>
                                <option value="english"
                                    <?php echo $data['medium'] === 'english' ? 'selected' : '' ?>>English</option>
                                <option value="tamil"
                                    <?php echo $data['medium'] === 'both' ? 'selected' : '' ?>>Tamil</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="year-of-exam">Year of Exam *
                                <span id="exam-year-error"><?php echo $data['errors']['year_of_exam_error'] ?></span>
                            </label>
                            <input type="number" name="year-of-exam" id="exam-year-input" value="<?php echo $data['year_of_exam'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="preferred-class-mode">Preferred Class Mode</label>
                            <select name="preferred-class-mode" id="preferred-class-mode">
                                <option value="online"
                                    <?php echo $data['preferred_class_mode'] === 'online' ? 'selected' : '' ?>>
                                    Online
                                </option>
                                <option value="physical"
                                    <?php echo $data['preferred_class_mode'] === 'physical' ? 'selected' : '' ?>>
                                    Physical
                                </option>
                                <option value="both"
                                    <?php echo $data['preferred_class_mode'] === 'both' ? 'selected' : '' ?>>
                                    Both
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="map-container" id="map-container">
                        <div class="map-container-title">
                            <p>Select your current location</p>
                            <span id="help"> ? <span class="tooltiptext">This location will be used when searching tutors</span></span>
                        </div>

                        <div id="map" class="map"></div>
                        <div id="marker"
                             title="Marker"
                             style="<?php echo 'background:url(' . URLROOT . '/public/img/student/marker-64.ico)
                                     no-repeat top center; background-size: contain;' ?>">

                        </div>

                        <input type="number"
                               id="latitude"
                               name="latitude"
                               readonly
                               value="<?php echo $data['latitude']; ?>">

                        <input type="number"
                               id="longitude"
                               name="longitude"
                               readonly
                               value="<?php echo $data['longitude']; ?>">

                    </div>


                    <div id="submit-btn-container">
                        <input type="submit" value="Finish" class="btn btn-search">
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js',
        URLROOT . '/public/js/common/tutor-student-profile-detail-validator-functions.js',
        URLROOT . '/public/js/common/tutor-student-profile-detail-validator.js'
    ]
); ?>