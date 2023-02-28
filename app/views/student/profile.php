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
        URLROOT . '/public/css/student/profile.css'
    ]
);

MainNavbar::render($request);
?>

<div class="main-area-container">

    <form action="<?php echo URLROOT . '/student/change-profile-picture' ?>"
          id="image-upload-form"
          enctype = "multipart/form-data"
          method="post">
        <h1 class="main-title">My Profile</h1>
        <div class="upload-picture-container">
            <img src="<?php echo URLROOT . $request->getUserPicture() ?>" alt="" id="profile-picture">
            <input type="file" name="profile-picture" id="actual-btn" accept="image/*" hidden onchange="this.form.submit()" />
            <label for="actual-btn" id="profile-image-upload-btn">Change and Save</label>
        </div>
    </form>

    <div class="main-area">

        <div class="utility-button-container">
            <button class="btn btn-utility">Disable Account</button>
            <button class="btn btn-utility">Change password</button>
        </div>

        <form action="" method="post" id="complete-profile-form">
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
                        <label for="address-line-1">Address Line 1
                            <span><?php echo $data['errors']['address_line_1_error'] ?></span>
                        </label>
                        <input type="text"
                               name="address-line-1"
                               id=""
                               value="<?php echo $data['address_line1'] ?>">
                    </div>
                    <div class="form-field">
                        <label for="address_line_2">Address Line 2
                            <span><?php echo $data['errors']['address_line_2_error'] ?></span>
                        </label>
                        <input type="text"
                               name="address-line-2"
                               id=""
                               value="<?php echo $data['address_line2'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="city">City <span><?php echo $data['errors']['city_error'] ?></span></label>
                        <input type="text" name="city" id="" value="<?php echo $data['city'] ?>">
                    </div>
                    <div class="form-field">
                        <label for="district">District<span><?php echo $data['errors']['district_error'] ?></span></label>
                        <select name="district" id="">
                            <option value="Ampara"<?php echo $data['district'] === 'Ampara' ? 'selected' : '' ?>>Ampara</option>
                            <option value="Anuradhapura"<?php echo $data['district'] === 'Anuradhapura' ? 'selected' : '' ?>>Anuradhapura</option>
                            <option value="Badulla"<?php echo $data['district'] === 'Badulla' ? 'selected' : '' ?>>Badulla</option>
                            <option value="Batticaloa"<?php echo $data['district'] === 'Batticaloa' ? 'selected' : '' ?>>Batticaloa</option>
                            <option value="Colombo"<?php echo $data['district'] === 'Colombo' ? 'selected' : '' ?>>Colombo</option>
                            <option value="Galle"<?php echo $data['district'] === 'Galle' ? 'selected' : '' ?>>Galle</option>
                            <option value="Gampaha"<?php echo $data['district'] === 'Gampaha' ? 'selected' : '' ?>>Gampaha</option>
                            <option value="Hambantota"<?php echo $data['district'] === 'Hambantota' ? 'selected' : '' ?>>Hambantota</option>
                            <option value="Jaffna"<?php echo $data['district'] === 'Jaffna' ? 'selected' : '' ?>>Jaffna</option>
                            <option value="Kalutara"<?php echo $data['district'] === 'Kalutara' ? 'selected' : '' ?>>Kalutara</option>
                            <option value="Kandy"<?php echo $data['district'] === 'Kandy' ? 'selected' : '' ?>>Kandy</option>
                            <option value="Kegalle"<?php echo $data['district'] === 'Kegalle' ? 'selected' : '' ?>>Kegalle</option>
                            <option value="Kilinochchi"<?php echo $data['district'] === 'Kilinochchi' ? 'selected' : '' ?>>Kilinochchi</option>
                            <option value="Kurunegala"<?php echo $data['district'] === 'Kurunegala' ? 'selected' : '' ?>>Kurunegala</option>
                            <option value="Mannar"<?php echo $data['district'] === 'Mannar' ? 'selected' : '' ?>>Mannar</option>
                            <option value="Matale"<?php echo $data['district'] === 'Matale' ? 'selected' : '' ?>>Matale</option>
                            <option value="Matara"<?php echo $data['district'] === 'Matara' ? 'selected' : '' ?>>Matara</option>
                            <option value="Moneragala"<?php echo $data['district'] === 'Moneragala' ? 'selected' : '' ?>>Moneragala</option>
                            <option value="Mullaitivu"<?php echo $data['district'] === 'Mullaitivu' ? 'selected' : '' ?>>Mullaitivu</option>
                            <option value="Nuwara Eliya"<?php echo $data['district'] === 'Nuwara Eliya' ? 'selected' : '' ?>>Nuwara Eliya</option>
                            <option value="Polonnaruwa"<?php echo $data['district'] === 'Polonnaruwa' ? 'selected' : '' ?>>Polonnaruwa</option>
                            <option value="Puttalam"<?php echo $data['district'] === 'Puttalam' ? 'selected' : '' ?>>Puttalam</option>
                            <option value="Ratnapura"<?php echo $data['district'] === 'Ratnapura' ? 'selected' : '' ?>>Ratnapura</option>
                            <option value="Trincomalee"<?php echo $data['district'] === 'Trincomalee' ? 'selected' : '' ?>>Trincomalee</option>
                            <option value="Vavuniya"<?php echo $data['district'] === 'Vavuniya' ? 'selected' : '' ?>>Vavuniya</option>
                        </select>
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
                               value="<?php echo $data['phone_number'] ?>">
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
                                <?php echo $data['medium'] === 'tamil' ? 'selected' : '' ?>>Tamil</option>
                        </select>
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

        <div class="payment-history">
            <h1>Payment History</h1>
            <div class="payment-history-container">
                <table class="data-table">
                    <tr>
                        <th>Tutor</th><th>Subject</th><th>Module</th><th>Amount</th><th>Date</th>
                    </tr>
                    <tr>
                        <td>Viraj Sandakelum</td><td>Combined Maths</td><td>Trigonometry</td><td>LKR 1500</td><td>2022-01-02</td>
                    </tr>
                    <tr>
                        <td>Viraj Sandakelum</td><td>Combined Maths</td><td>Trigonometry</td><td>LKR 1500</td><td>2022-01-02</td>
                    </tr>
                    <tr>
                        <td>Viraj Sandakelum</td><td>Combined Maths</td><td>Trigonometry</td><td>LKR 1500</td><td>2022-01-02</td>
                    </tr>
                    <tr>
                        <td>Viraj Sandakelum</td><td>Combined Maths</td><td>Trigonometry</td><td>LKR 1500</td><td>2022-01-02</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="request-history">
            <h1>Pending Tutor Requests</h1>
            <div class="request-history-container">
                <table class="data-table">
                    <tr>
                        <th>Tutor</th><th>Subject</th><th>Module</th><th>Mode</th><th></th>
                    </tr>

                    <?php
                    foreach ($data['requests'] as $request) {
                        echo '<tr>
                                    <td>' . $request['first_name'] . ' ' . $request['last_name'] . '</td>
                                    <td>' . $request['subject'] . '</td><td>' . $request['module'] . '</td>
                                    <td>' . $request['mode'] . '</td>
                                    <td><button class="btn req-cancel-btn" data-id="' . $request['id'] . '">Cancel</button></td>
                            </tr>';
                        }
                    ?>

                </table>
            </div>
        </div>

    </div>
</div>

<?php Footer::render(
    [

        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js',
        URLROOT . '/public/js/student/profile.js'
    ]
);
?>

