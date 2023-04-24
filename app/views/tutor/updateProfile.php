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
        URLROOT . '/public/css/tutor/updateProfile.css?v=1.5'
    ]
);
MainNavbar::render($request);
?>

<section>
    <div class="main-area-container">

        <form action="update-profile" method="POST">
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
                            <div class="form-field">
                                <label for="first-name">First Name<br>
                                    <span><?php echo $data['errors']['first_name_error'] ?></span>
                                    <input type="text" name="first_name" id="" value="<?php echo $data['first_name'] ?>">
                            </div>
                            <div class="form-field">
                                <label for="last-name">Last Name<br>
                                    <span><?php echo $data['errors']['last_name_error'] ?></span>
                                    <input type="text" name="last_name" id="" value="<?php echo $data['last_name'] ?>">
                            </div>
                            <div class="form-field">
                                <label for="phone-number">Phone Number<br>
                                    <span><?php echo $data['errors']['phone_number_error'] ?></span>
                                    <input type="text" name="phone_number" id="" value="<?php echo $data['phone_number'] ?>">
                            </div>

                            <div class="form-field">
                                <label for="address_line1">Address Line 1<br>
                                    <span><?php echo $data['errors']['address_line1_error'] ?></span>
                                    <input type="text" name="address_line1" id="" value="<?php echo $data['address_line_1'] ?>">
                            </div>
                            <div class="form-field">
                                <label for="address_line2">Address Line 2<br>
                                    <span><?php echo $data['errors']['address_line2_error'] ?></span>
                                    <input type="text" name="address_line2" id="" value="<?php echo $data['address_line_2'] ?>">
                            </div>
                            <div class="form-field">
                                <label for="city">City<br>
                                    <span><?php echo $data['errors']['city_error'] ?></span>
                                    <input type="text" name="city" id="" value="<?php echo $data['city'] ?>">
                            </div>
                            <div class="form-field">
                                <label for="district">District<br>
                                    <select>
                                        <?php
                                        $district_array = array(
                                            "colombo",
                                            "gampaha",
                                            "kalutara",
                                            "kandy",
                                            "matale",
                                            "nuwaraeliya",
                                            "galle",
                                            "matara",
                                            "hambantota",
                                            "jaffna",
                                            "kilinochchi",
                                            "mannar",
                                            "vavuniya",
                                            "mulativu",
                                            "batticaloa",
                                            "ampara",
                                            "trincomalee",
                                            "kurunegala",
                                            "puttalam",
                                            "anuradhapura",
                                            "polonnaruwa",
                                            "badulla",
                                            "monaragala",
                                            "ratnapura",
                                            "kegalle"
                                        );
                                        $selected_district = $data['district'];

                                        echo "<option value=$selected_district>$selected_district </option>";
                                        for ($i = 0; $i < count($district_array); ++$i) {
                                            if ($district_array[$i] !== $selected_district) {
                                                echo "<option value = '$district_array[$i]'>$district_array[$i]</option>";
                                            }
                                        }

                                        ?>

                                    </select>

                            </div>
                        </div>

                </div>

                <div class="div2">
                    <h2>Bank Details</h2><br>
                    <div class="bankdiv" style="display:grid;grid-template-columns:1fr 1fr;">
                        <div class="form-field2">
                            <label for="account-name">Account Name<br>
                                <span><?php echo $data['errors']['account_name_error'] ?></span>
                            </label>
                            <input type="text" name="bank_account_owner" id="" value="<?php echo $data['bank_account_owner'] ?>">
                        </div>
                        <div class="form-field2">
                            <label for="account-number">Account Number<br>
                                <span><?php echo $data['errors']['account_number_error'] ?></span>
                            </label>
                            <input type="text" name="bank_account_number" id="" value="<?php echo $data['bank_account_number'] ?>">
                        </div>
                        <div class="form-field2">
                            <label for="bank-name">Bank Name<br>
                                <span><?php echo $data['errors']['bank_name_error'] ?></span>
                            </label>
                            <input type="text" name="bank_name" id="" value="<?php echo $data['bank_name'] ?>">
                        </div>
                        <div class="form-field2">
                            <label for="branch">Branch<br>
                                <span><?php echo $data['errors']['branch_error'] ?></span>
                            </label>
                            <input type="text" name="bank_branch" id="" value="<?php echo $data['bank_branch'] ?>">
                        </div>
                    </div>
                </div>

                <div class="div3">
                    <h2>Education Qualifications</h2><br>
                    <div class="edudiv" style="display:grid;grid-template-columns:1fr 1fr;">
                        <div class="form-field3">
                            <label for="Highest Education Qualification">Highest Education Qualification<br>
                                <span><?php echo $data['errors']['qualification_error'] ?></span>
                            </label>
                            <select name="education_qualification" id="education-qualification">
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
                        <div class="form-field3">
                            <label for="University">University<br>
                                <span><?php echo $data['errors']['university_error'] ?></span>
                            </label>
                            <input type="text" name="university" id="" value="<?php echo $data['university'] ?>">
                        </div>

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
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>10.00-12.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>12.00-14.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>14.00-16.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>16.00-18.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>18.00-20.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>20.00-22.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>

                            <tr>
                                <th>22.00-00.00</th>
                                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <div class="submit-btn">
        <button type="submit">Save Changes</button>
    </div>


    </form>
    </div>

</section>

<script>
    let tableRows = document.querySelectorAll('.slot');

    for (var i = 0; i < tableRows.length; i++) {
        tableRows[i].addEventListener("click", function() {
            this.classList.add("slot-selected");
        });
    }
</script>

<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
    ]
);
