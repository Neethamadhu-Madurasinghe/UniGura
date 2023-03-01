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
        URLROOT . '/public/css/tutor/complete-profile.css?v=1.2',
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);

IntermediateNavBar::render($request);

?>

<div class="main-area-container">
    <div class="main-area">
        <h1 class="main-title">Complete Your Profile</h1>
        <form action="" id="complete-profile-form" method="POST" enctype='multipart/form-data'>
            <div class="form first">
                <div class="upload-picture-container">
                    <img src="<?php echo URLROOT . '/public/img/tutor/profile.png' ?>" alt="" id="profile-picture">
                    <input type="file" id="actual-btn" name="profile-picture" accept="image/*" hidden />
                    <label for="actual-btn" id="profile-image-upload-btn">Upload Profile Picture</label>
                </div>

                <div class="form-main-area">

                    <div class="form-row">
                        <div class="form-field">
                            <label for="first-name">First Name *
                                <span><?php echo $data['errors']['first_name_error'] ?></span>
                            </label>
                            <input type="text" name="first-name" id="" value="<?php echo $data['first_name'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="last-name">Last Name *
                                <span><?php echo $data['errors']['last_name_error'] ?></span>
                            </label>
                            <input type="text" name="last-name" id="" value="<?php echo $data['last_name'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="address-line-1">Address Line 1 *
                                <span><?php echo $data['errors']['address_line_1_error'] ?></span>
                            </label>

                            <input type="text" name="address-line-1" id="" value="<?php echo $data['address_line_1'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="address_line_2">Address Line 2
                                <span><?php echo $data['errors']['address_line_2_error'] ?></span>
                            </label>
                            <input type="text" name="address-line-2" id="" value="<?php echo $data['address_line_2'] ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="city">City * <span><?php echo $data['errors']['city_error'] ?></span></label>
                            <input type="text" name="city" id="" value="<?php echo $data['city'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="district">District * <span><?php echo $data['errors']['district_error'] ?></span></label>
                            <select name="district" id="">
                                <option value="Ampara" <?php echo $data['district'] === 'Ampara' ? 'selected' : '' ?>>Ampara</option>
                                <option value="Anuradhapura" <?php echo $data['district'] === 'Anuradhapura' ? 'selected' : '' ?>>Anuradhapura</option>
                                <option value="Badulla" <?php echo $data['district'] === 'Badulla' ? 'selected' : '' ?>>Badulla</option>
                                <option value="Batticaloa" <?php echo $data['district'] === 'Batticaloa' ? 'selected' : '' ?>>Batticaloa</option>
                                <option value="Colombo" <?php echo $data['district'] === 'Colombo' ? 'selected' : '' ?>>Colombo</option>
                                <option value="Galle" <?php echo $data['district'] === 'Galle' ? 'selected' : '' ?>>Galle</option>
                                <option value="Gampaha" <?php echo $data['district'] === 'Gampaha' ? 'selected' : '' ?>>Gampaha</option>
                                <option value="Hambantota" <?php echo $data['district'] === 'Hambantota' ? 'selected' : '' ?>>Hambantota</option>
                                <option value="Jaffna" <?php echo $data['district'] === 'Jaffna' ? 'selected' : '' ?>>Jaffna</option>
                                <option value="Kalutara" <?php echo $data['district'] === 'Kalutara' ? 'selected' : '' ?>>Kalutara</option>
                                <option value="Kandy" <?php echo $data['district'] === 'Kandy' ? 'selected' : '' ?>>Kandy</option>
                                <option value="Kegalle" <?php echo $data['district'] === 'Kegalle' ? 'selected' : '' ?>>Kegalle</option>
                                <option value="Kilinochchi" <?php echo $data['district'] === 'Kilinochchi' ? 'selected' : '' ?>>Kilinochchi</option>
                                <option value="Kurunegala" <?php echo $data['district'] === 'Kurunegala' ? 'selected' : '' ?>>Kurunegala</option>
                                <option value="Mannar" <?php echo $data['district'] === 'Mannar' ? 'selected' : '' ?>>Mannar</option>
                                <option value="Matale" <?php echo $data['district'] === 'Matale' ? 'selected' : '' ?>>Matale</option>
                                <option value="Matara" <?php echo $data['district'] === 'Matara' ? 'selected' : '' ?>>Matara</option>
                                <option value="Moneragala" <?php echo $data['district'] === 'Moneragala' ? 'selected' : '' ?>>Moneragala</option>
                                <option value="Mullaitivu" <?php echo $data['district'] === 'Mullaitivu' ? 'selected' : '' ?>>Mullaitivu</option>
                                <option value="Nuwara Eliya" <?php echo $data['district'] === 'Nuwara Eliya' ? 'selected' : '' ?>>Nuwara Eliya</option>
                                <option value="Polonnaruwa" <?php echo $data['district'] === 'Polonnaruwa' ? 'selected' : '' ?>>Polonnaruwa</option>
                                <option value="Puttalam" <?php echo $data['district'] === 'Puttalam' ? 'selected' : '' ?>>Puttalam</option>
                                <option value="Ratnapura" <?php echo $data['district'] === 'Ratnapura' ? 'selected' : '' ?>>Ratnapura</option>
                                <option value="Trincomalee" <?php echo $data['district'] === 'Trincomalee' ? 'selected' : '' ?>>Trincomalee</option>
                                <option value="Vavuniya" <?php echo $data['district'] === 'Vavuniya' ? 'selected' : '' ?>>Vavuniya</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="telephone-number">Telephone Number *
                                <span><?php echo $data['errors']['telephone_number_error'] ?></span>
                            </label>
                            <input type="text" name="telephone-number" id="" value="<?php echo $data['telephone_number'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="gender">Gender</label>
                            <select name="gender" id="">
                                <option value="not-selected" <?php echo $data['gender'] === 'not-selected' ? 'selected' : '' ?>>
                                    Not Selected
                                </option>
                                <option value="male" <?php echo $data['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?php echo $data['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="university">University *
                                <span><?php echo $data['errors']['university_error'] ?></span>
                            </label>
                            <input type="text" name="university" id="" value="<?php echo $data['university'] ?>">
                        </div>

                        <div class="form-field">
                            <label for="preferred-class-mode">Preferred Class Mode</label>
                            <select name="preferred-class-mode" id="preferred-class-mode">
                                <option value="online" <?php echo $data['preferred_class_mode'] === 'online' ? 'selected' : '' ?>>
                                    Online
                                </option>
                                <option value="physical" <?php echo $data['preferred_class_mode'] === 'physical' ? 'selected' : '' ?>>
                                    Physical
                                </option>
                                <option value="both" <?php echo $data['preferred_class_mode'] === 'both' ? 'selected' : '' ?>>
                                    Both
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="map-container" id="map-container">
                        <div class="map-container-title">
                            <p>Select your current location</p>
                            <span id="help"> ? <span class="tooltiptext">Students will see this as your location.</span></span>
                        </div>

                        <div id="map" class="map"></div>

                        <div id="marker" title="Marker" style="<?php echo 'background:url(' . URLROOT . '/public/img/student/marker-64.ico)
                                     no-repeat top center; background-size: contain;' ?>">
                        </div>
                        <input type="number" id="latitude" name="latitude" readonly value="<?php echo $data['latitude']; ?>">
                        <input type="number" id="longitude" name="longitude" readonly value="<?php echo $data['longitude']; ?>">
                    </div>

                    <input type="number" id="latitude" name="latitude" readonly value="<?php echo $data['latitude']; ?>">
                </div>
                <div class="btn-container">
                    <div class="nextBtn btn">Next</div>
                </div>
            </div>

    </div>
    <div class="form second">
        <div class="form-row">
            <div class="form-field">
                <label for="university">University
                    <span><?php echo $data['errors']['university_error'] ?></span>
                </label>
                <input type="text" name="university" id="" value="<?php echo $data['university'] ?>">
            </div>
            <div class="form-field">
                <label for="education-qualification">Highest Education Qualification</label>
                <select name="education-qualification" id="education-qualification">
                    <option value="advanced-level" <?php echo $data['education_qualification'] === 'advanced-level' ? 'selected' : '' ?>>
                        Advanced Level
                    </option>
                    <option value="bachelor-degree" <?php echo $data['education_qualification'] === 'bachelor-degree' ? 'selected' : '' ?>>
                        Bachelor Degree
                    </option>
                    <option value="masters-degree" <?php echo $data['education_qualification'] === 'masters-degree' ? 'selected' : '' ?>>
                        Masters Degree
                    </option>
                </select>
            </div>
        </div>


        <div class="form-row">
            <div class="form-field" id="description-field">
                <label for="description">Bio (1000 letters max)
                    <span><?php echo $data['errors']['description_error'] ?></span>
                </label>
                <?php echo '<textarea name="description" id="">' . $data['description'] . '</textarea>' ?>
            </div>
        </div>


        <div class="form-row upload-btn-row">
            <div class="form-field btn-field">
                <span class="upload-button-error">
                    <?php echo $data['errors']['advanced_level_result_error'] ?>
                </span>
                <input type="file" id="actual-al-result-btn" name="advanced-level-result" hidden />
                <label for="actual-al-result-btn" id="al-result-upload-btn">
                    Upload A/L Result Sheet
                </label>
            </div>
            <div class="form-field btn-field">
                <span class="upload-button-error">
                    <?php echo $data['errors']['id_copy_error'] ?>
                </span>
                <input type="file" id="actual-identity-card-btn" name="id-copy" hidden />
                <label for="actual-identity-card-btn" id="al-identity-card-btn">
                    Upload Identity Card Photo
                </label>
            </div>
            <div class="form-field btn-field">
                <span class="upload-button-error">
                    <?php echo $data['errors']['university_entrance_letter_error'] ?>
                </span>
                <input type="file" id="actual-university-entrance-letter" name="university-entrance-letter" hidden />
                <label for="actual-university-entrance-letter" id="university-entrance-letter">
                    Upload University Entrance Letter
                </label>
            </div>
        </div>


        <div class="btn-container">
            <div class="backBtn btn">Back</div>
            <input class="btn" type="submit" value="Finish">
        </div>

    </div>

    </form>



</div>
</div>

<script>
    nextBtn.addEventListener("click", () => {
        form.classList.add('secActive');
        console.log('ok')
    })

    backBtn.addEventListener("click", () => form.classList.remove('secActive'));
</script>


<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js?v=1.2',

    ]
); ?>