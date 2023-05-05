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
        URLROOT . '/public/css/tutor/updateProfile.css?v=1.8'
    ]
);
MainNavbar::render($request);
?>

<section>
    <div class="main-area-container">



        <div class='div5'>
            <form action="<?php echo URLROOT . '/tutor/change-profile-picture' ?>" id="image-upload-form" enctype="multipart/form-data" method="post">
                <h2 class="main-title">My Profile</h2>
                <div class="upload-picture-container">
                    <img src="<?php echo URLROOT . $request->getUserPicture() ?>" alt="" id="profile-picture">
                    <input type="file" name="profile-picture" id="actual-btn" accept="image/*" hidden onchange="this.form.submit()" />
                    <label for="actual-btn" id="profile-image-upload-btn">Change and Save</label>
                </div>
            </form>
        </div>

        <form action="update-profile" method="POST" id="updateFormData">
            <div class="parent">
                <div class="div1">
                <h2>Personal Details</h2>
                    <div class="tutor-profile">
                        <div class="form-field">
                            <label for="first-name">First Name<br>
                                <span id="first_name_error"></span>
                                <input type="text" name="first_name" id="" value="<?php echo $data['first_name'] ?>">
                            </label>
                        </div>
                        <div class="form-field">
                            <label for="last-name">Last Name<br>
                                <span id="last_name_error"></span>
                                <input type="text" name="last_name" id="" value="<?php echo $data['last_name'] ?>">
                            </label>
                        </div>
                        <div class="form-field">
                            <label for="phone-number">Phone Number<br>
                                <span id="phone_number_error"></span>
                                <input type="text" name="phone_number" id="" value="<?php echo $data['phone_number'] ?>">
                            </label>
                        </div>

                        <div class="form-field">
                            <label for="address_line1">Address Line 1<br>
                                <span id="address_line1_error"></span>
                                <input type="text" name="address_line1" id="" value="<?php echo $data['address_line_1'] ?>">
                            </label>
                        </div>
                        <div class="form-field">
                            <label for="address_line2">Address Line 2<br>
                                <span id="address_line2_error"></span>
                                <input type="text" name="address_line2" id="" value="<?php echo $data['address_line_2'] ?>">
                            </label>
                        </div>
                        <div class="form-field">
                            <label for="city">City<br>
                                <span id="city_error"></span>
                                <input type="text" name="city" id="" value="<?php echo $data['city'] ?>">
                            </label>
                        </div>
                        <div class="form-field">
                            <label for="district">District<br>
                                <select name="district">
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
                    <div class="bankdiv">
                        <div class="form-field2">
                            <label for="account-name">Account Holder Name<br>
                                <span id="account_name_error"></span>
                                <input type="text" name="bank_account_owner" id="" value="<?php echo $data['bank_account_owner'] ?>">
                            </label>
                        </div>
                        <div class="form-field2">
                            <label for="account-number">Bank Account Number<br>
                                <span id="account_number_error"></span>
                            </label>
                            <input type="text" name="bank_account_number" id="" value="<?php echo $data['bank_account_number'] ?>">
                        </div>
                        <div class="form-field2">
                            <label for="bank-name">Bank Name<br>
                                <span id="bank_name_error"></span>
                            </label>
                            <input type="text" name="bank_name" id="" value="<?php echo $data['bank_name'] ?>">
                        </div>
                        <div class="form-field2">
                            <label for="branch">Bank Branch<br>
                                <span id="branch_error"></span>
                            </label>
                            <input type="text" name="bank_branch" id="" value="<?php echo $data['bank_branch'] ?>">
                        </div>
                    </div>
                </div>


                <div class="div3">
                    <h2>Education Qualifications</h2><br>
                    <div class="edudiv">
                        <div class="form-field3">
                            <label for="Highest Education Qualification">Highest Education Qualification<br>
                                <span id="qualification_error"></span>
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
                                <span id="university_error"></span>
                            </label>
                            <input type="text" name="university" id="" value="<?php echo $data['university'] ?>">
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

                                    <th>08:00-10.00</th>

                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>" value="dd"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>10.00-12.00</th>

                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </tr>

                                <tr>
                                    <th>12.00-14.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>14.00-16.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>16.00-18:00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>18:00-20.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>20.00-22.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>22.00-00.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected" id="<?php echo $timeSlot->id ?>"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit-btn">
                <button type="submit" id="submit">Save Changes</button>
            </div>
        </form>
    </div>

</section>




<script>
    const submit = document.querySelector('#submit');
    const tableRows = document.querySelectorAll('.slot');
    const form = document.querySelector('#updateFormData');


    const first_name_error = document.querySelector('#first_name_error');
    const last_name_error = document.querySelector('#last_name_error');
    const phone_number_error = document.querySelector('#phone_number_error');
    const address_line1_error = document.querySelector('#address_line1_error');
    const address_line2_error = document.querySelector('#address_line2_error');
    const city_error = document.querySelector('#city_error');
    const account_name_error = document.querySelector('#account_name_error');
    const account_number_error = document.querySelector('#account_number_error');
    const bank_name_error = document.querySelector('#bank_name_error');
    const branch_error = document.querySelector('#branch_error');
    const qualification_error = document.querySelector('#qualification_error');
    const university_error = document.querySelector('#university_error');




    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        // for (let pair of formData.entries()) {
        //     console.log(pair[0] + ': ' + pair[1]);
        // }

        const response = fetch('http://localhost/Unigura/tutor/update-profile', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data['message'] != 'Data saved successfully') {
                    first_name_error.innerHTML = data['first_name_error'];
                    last_name_error.innerHTML = data['last_name_error'];
                    phone_number_error.innerHTML = data['phone_number_error'];
                    address_line1_error.innerHTML = data['address_line1_error'];
                    address_line2_error.innerHTML = data['address_line2_error'];
                    city_error.innerHTML = data['city_error'];
                    account_name_error.innerHTML = data['account_name_error'];
                    account_number_error.innerHTML = data['account_number_error'];
                    bank_name_error.innerHTML = data['bank_name_error'];
                    branch_error.innerHTML = data['branch_error'];
                    qualification_error.innerHTML = data['qualification_error'];
                    university_error.innerHTML = data['university_error'];
                } else {
                    first_name_error.innerHTML = '';
                    last_name_error.innerHTML = '';
                    phone_number_error.innerHTML = '';
                    address_line1_error.innerHTML = '';
                    address_line2_error.innerHTML = '';
                    city_error.innerHTML = '';
                    account_name_error.innerHTML = '';
                    account_number_error.innerHTML = '';
                    bank_name_error.innerHTML = '';
                    branch_error.innerHTML = '';
                    qualification_error.innerHTML = '';
                    university_error.innerHTML = '';
                }
            })
            .catch(error => {
                console.error(error);
            });


    });


    // ************************ time slots update ************************


    for (var i = 0; i < tableRows.length; i++) {
        tableRows[i].addEventListener("click", function() {
            console.log(this.className);
            if (this.className == "slot slot-free") { // use-slot(1) => cannot-used-slot(0)
                this.setAttribute("data-state", 0); 
                this.classList.add("slot-used");
                this.classList.remove("slot-free");
            } else if (this.className == "slot slot-used") { // slot-cannot-used
                this.setAttribute("data-state", 1);
                this.classList.remove("slot-used");
                this.classList.add("slot-free");
            }
        });
    }

    for (var i = 0; i < tableRows.length; i++) {
        console.log(tableRows[i].className);
    }


    for (var i = 0; i < tableRows.length; i++) {
        if (tableRows[i].className == "slot slot-free") {
            tableRows[i].setAttribute("data-state", 1);
        } else if (tableRows[i].className == "slot slot-used") {
            tableRows[i].setAttribute("data-state", 0);
        } else if (tableRows[i].className == "slot slot-selected") {
            tableRows[i].setAttribute("data-state", 2);
        }
    }


    submit.addEventListener('click', convertData);

    function convertData() {
        let time_slots = [];
        for (let i = 0; i < tableRows.length; i++) {
            let row = tableRows[i];
            let state = row.dataset.state;
            time_slots.push({
                state: state,
                id: row.id
            });
        }

        const data = {
            time_slots
        };

        console.log(time_slots);

        fetch('http://localhost/Unigura/tutor/update-time-slots', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>


<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
    ]
);
