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
            <h1 class="main-title">My Profile</h1>
            <div class="upload-picture-container">
                <img src="<?php echo URLROOT . $request->getUserPicture() ?>" alt="" id="profile-picture">
                <input type="file" name="profile-picture" id="actual-btn" accept="image/*" hidden onchange="this.form.submit()" />
                <label for="actual-btn" id="profile-image-upload-btn">Change and Save</label>
            </div>
        </form>
    </div>
        <form action="update-profile" method="POST">
            <div class="parent">
                <div class="div1">
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
                    <div class="edudiv">
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
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '08:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>10.00-12.00</th>

                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '10:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </tr>

                                <tr>
                                    <th>12.00-14.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '12:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>14.00-16.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '14:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>16.00-18:00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '16:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>18:00-20.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '18:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>20.00-22.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '20:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>

                                <tr>
                                    <th>22.00-00.00</th>
                                    <?php foreach ($data['tutorTimeSlots'] as $timeSlot) : ?>
                                        <?php if ($timeSlot->day == 'mon' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'tue' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>



                                        <?php elseif ($timeSlot->day == 'wed' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>


                                        <?php elseif ($timeSlot->day == 'thu' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'fri' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sat' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
                                            <?php endif; ?>

                                        <?php elseif ($timeSlot->day == 'sun' && $timeSlot->time == '22:00:00') : ?>
                                            <?php if ($timeSlot->state == 0) : ?>
                                                <td class="slot slot-used"></td>
                                            <?php elseif ($timeSlot->state == 1) : ?>
                                                <td class="slot slot-free"></td>
                                            <?php elseif ($timeSlot->state == 2) : ?>
                                                <td class="slot slot-selected"></td>
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
    let tableRows = document.querySelectorAll('.slot');
    const submit = document.querySelector('#submit');

    for (var i = 0; i < tableRows.length; i++) {
        tableRows[i].addEventListener("click", function() {
            this.setAttribute("data-state", 1);
            this.classList.remove("slot-free");
            this.classList.add("slot-selected");
        });
    }


    submit.addEventListener('click', convertdata);

    function convertdata() {
        let time_slots = [];
        for (let i = 0; i < tableRows.length; i++) {
            let row = tableRows[i];
            let day = row.dataset.day;
            let time = row.dataset.time;
            let state = row.dataset.state;
            time_slots.push({
                id: i,
                day: day,
                time: time,
                state: state
            });
        }
        console.log(myArray);

        //convert the json object to a string and store it in a hidden input field

        fetch('http://localhost/unigura/tutor/tutor-time-slot-inputs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    data: time_slots
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                window.location.href = 'http://localhost/unigura/tutor/dashboard';
            })
            .catch((error) => {
                console.error('Have Error');
            });




    }
</script>

<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
    ]
);
