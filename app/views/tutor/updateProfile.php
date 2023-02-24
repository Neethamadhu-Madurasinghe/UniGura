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
        URLROOT . '/public/css/tutor/updateProfile.css?v=1.2'
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
                        <form action="update-profile" method="POST">
                            <div class="form-field">
                                <label for="first-name">First Name
                                    <!-- <span>Please enter a valid password</span></label><br> -->
                                    <input type="text" name="first_name" id="" value="<?php echo $data['tutorProfileDetails']->first_name ?>">
                            </div>
                            <div class="form-field">
                                <label for="last-name">Last Name
                                    <!-- <span>Please enter a valid password</span></label><br> -->
                                    <input type="text" name="last_name" id="" value="<?php echo $data['tutorProfileDetails']->last_name ?>">
                            </div>
                            <div class="form-field">
                                <label for="letter-box-number">Letter Box Number
                                    <!-- <span>Password is does't match</span></label><br> -->
                                    <input type="text" name="letter_box_number" id="" value="<?php echo $data['tutorProfileDetails']->letter_box_number ?>">
                            </div>
                            <div class="form-field">
                                <label for="phone-number">Phone Number
                                    <!-- <span>Password is does't match</span></label><br> -->
                                    <input type="text" name="phone_number" id="" value="<?php echo $data['tutorProfileDetails']->phone_number ?>">
                            </div>
                            <div class="form-field">
                                <label for="street">Street
                                    <!-- <span>Password is does't match</span></label><br> -->
                                    <input type="text" name="street" id="" value="<?php echo $data['tutorProfileDetails']->street ?>">
                            </div>
                            <div class="form-field">
                                <label for="city">City
                                    <!-- <span>Password is does't match</span></label><br> -->
                                    <input type="text" name="city" id="" value="<?php echo $data['tutorProfileDetails']->city ?>">
                            </div>

                            <div class="change-password">
                                <button type="submit" class="btn btn-change-password">Save Changes</button>
                            </div>
                        </form>

                    </div>

            </div>

            <div class="div2">
                <h2>Bank Details</h2><br>
                <div class="bankdiv" style="display:grid;grid-template-columns:1fr 1fr;">
                    <div class="form-field">
                        <label for="account-name">Account Name
                            <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                        </label>
                        <input type="text" name="account-name" id="" value="<?php echo $data['tutorBankDetails']->bank_account_owner ?>">
                    </div>
                    <div class="form-field">
                        <label for="account-number">Account Number
                            <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                        </label>
                        <input type="text" name="account-number" id="" value="<?php echo $data['tutorBankDetails']->bank_account_number ?>">
                    </div>
                    <div class="form-field">
                        <label for="bank-name">Bank Name
                            <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                        </label>
                        <input type="text" name="bank-name" id="" value="<?php echo $data['tutorBankDetails']->bank_name ?>">
                    </div>
                    <div class="form-field">
                        <label for="branch">Branch
                            <!--  <span><?php echo $data['errors']['last_name_error'] ?></span> -->
                        </label>
                        <input type="text" name="branch" id="" value="<?php echo $data['tutorBankDetails']->bank_branch ?>">
                    </div>
                </div>
            </div>





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
                                <th id="">Saturday</th>
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
<<<<<<< Updated upstream
</div>

=======
</section>
>>>>>>> Stashed changes


<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
    ]
);
