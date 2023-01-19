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
        URLROOT . '/public/css/student/complete-profile.css',
    ]
);
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
                            <label for="first-name">First Name
                                <span><?php echo $data['errors']['first_name_error'] ?></span>
                            </label>
                            <input type="text" name="first-name" id="" value="<?php echo $data['first_name'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="last-name">Last Name
                                <span><?php echo $data['errors']['last_name_error'] ?></span>
                            </label>
                            <input type="text" name="last-name" id="" value="<?php echo $data['last_name'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="letter-box-number">Letter Box Number
                                <span><?php echo $data['errors']['letter_box_number_error'] ?></span>
                            </label>
                            <input type="text"
                                   name="letter-box-number"
                                   id=""
                                   value="<?php echo $data['letter_box_number'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="street">Street
                                <span><?php echo $data['errors']['street_error'] ?></span>
                            </label>
                            <input type="text" name="street" id="" value="<?php echo $data['street'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="city">City <span><?php echo $data['errors']['city_error'] ?></span></label>
                            <input type="text" name="city" id="" value="<?php echo $data['city'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="year-of-exam">Year of Exam
                                <span><?php echo $data['errors']['year_of_exam_error'] ?></span>
                            </label>
                            <input type="number" name="year-of-exam" id="" value="<?php echo $data['year_of_exam'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="telephone-number">Telephone Number
                                <span><?php echo $data['errors']['telephone_number_error'] ?></span>
                            </label>
                            <input type="text"
                                   name="telephone-number"
                                   id=""
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
                                <option value="both"
                                    <?php echo $data['medium'] === 'both' ? 'selected' : '' ?>>Both</option>
                            </select>
                        </div>
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
                        <p>Select location</p>
                        <div id="map" class="map"></div>
                        <div id="marker"
                             title="Marker"
                             style="<?php echo 'background:url(' . URLROOT . '/public/img/student/marker-64.ico)
                                     no-repeat top center;' ?>">

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
                        <input type="submit" value="Finish" class="btn btn-search">
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js'
    ]
); ?>