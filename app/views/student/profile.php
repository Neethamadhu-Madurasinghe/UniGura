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

    <form action="" id="image-upload-form">
        <h1 class="main-title">My Profile</h1>
        <div class="upload-picture-container">
            <img src="<?php echo URLROOT . $request->getUserPicture() ?>" alt="" id="profile-picture">
            <input type="file" id="actual-btn" accept="image/*" hidden/>
            <label for="actual-btn" id="profile-image-upload-btn">Change and Save</label>
        </div>
    </form>

    <div class="main-area">

        <div class="utility-button-container">
            <button class="btn btn-utility">Disable Account</button>
            <button class="btn btn-utility">Change password</button>
        </div>

        <form action="" id="complete-profile-form">
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
                            <option value="both"
                                <?php echo $data['medium'] === 'both' ? 'selected' : '' ?>>Both</option>
                        </select>
                    </div>
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
            <h1>Pending Tutor Reqeusts</h1>
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
                                    <td><button class="btn req-cancel-btn">Cancel</button></td>
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
        URLROOT . '/public/js/common/student-tutor-complete-profile.js'
    ]
);
?>

