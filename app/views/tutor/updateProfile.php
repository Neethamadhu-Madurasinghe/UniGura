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
    'update profile',
    [
        URLROOT . '/public/css/tutor/base.css?v=1.8',
        URLROOT . '/public/css/tutor/style.css?v=1.9',
        URLROOT . '/public/css/tutor/updateProfile.css'
    ]
);
MainNavbar::render($request);
?>

<section>
<div class="main-area-container">

    <div class="parent">
        <div class="div1">
            <form action="update-profile" id="complete-profile-form" method="POST" enctype='multipart/form-data'>
                <div class="upload-picture-container">
                    <h1 class="main-title">My Profile</h1>
                    <img src="<?php echo URLROOT; ?>/public/img/tutor/profile.png" alt="" id="profile-picture">
                    <input type="file" id="actual-btn" name="profile-picture" accept="image/*" hidden />
                    <label for="actual-btn" id="profile-image-upload-btn">Upload Profile Picture</label>
                </div>
                <div class="tutor-profile">
                    <form action="updatePassword" method="POST">
                        <div class="form-field">
                            <label for="first-name">First Name
                                <!-- <span>Please enter a valid password</span></label><br> -->
                                <input type="text" name="currentPassword" id="">
                        </div>
                        <div class="form-field">
                            <label for="last-name">Last Name
                                <!-- <span>Please enter a valid password</span></label><br> -->
                                <input type="text" name="newPassword" id="">
                        </div>
                        <div class="form-field">
                            <label for="last-name">Subject
                                <!-- <span>Password is does't match</span></label><br> -->
                                <input type="text" name="confirmPassword" id="">
                        </div>
                        <div class="form-field">
                            <label for="last-name">Phone Number
                                <!-- <span>Password is does't match</span></label><br> -->
                                <input type="text" name="confirmPassword" id="">
                        </div>
                        <div class="form-field">
                            <label for="last-name">District
                                <!-- <span>Password is does't match</span></label><br> -->
                                <input type="text" name="confirmPassword" id="">
                        </div>
                        <div class="form-field">
                            <label for="last-name">City
                                <!-- <span>Password is does't match</span></label><br> -->
                                <input type="text" name="confirmPassword" id="">
                        </div>

                        <div class="change-password">
                            <button type="submit" class="btn btn-change-password">Save Changes</button>
                        </div>
                    </form>

                </div>

        </div>


        <div class="div2">
            <h2>Bank Details</h2><br>
            <div class="form-field">
                <label for="last-name">Account Name
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Account Number
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Bank Name
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Branch
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
        </div>


        <div class="div3">
            <h2>Class Details</h2><br>
            <div class="form-field">
                <label for="last-name">Preferred class mode
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Medium
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Mode
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Location
                    <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                </label>
                <input type="text" name="last-name" id="">
            </div>
        </div>

        <!--===================================== Tutor AVAILABLE TIME SLOTS========================= -->
        <div class="div4">
            <h2>Update Your Available Time Slots</h2><br>

            <div class="pop-time-table">
                <div class="time-table-container">
                    <table id="time-table">
                        <tr class="time-table-titles">
                            <th id="">Time</th>
                            <th id="">Monday</th>
                            <th id="">Tuesday</th>
                            <th id="">Wednesday</th>
                            <th id="">Thursday</th>
                            <th id="">Friday</th>
                            <th id="">Satday</th>
                            <th id="">Sunday</th>
                        </tr>

                        <tr>
                            <th>8.00-10.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>10.00-12.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>12.00-14.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>14.00-16.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>16.00-18.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>18.00-20.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>20.00-22.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        <tr>
                            <th>22.00-00.00</th>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-selected"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-free"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                            <td class="slot slot-used"></td>
                        </tr>

                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</section>


<?php Footer::render(
     [
          URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
     ]
);