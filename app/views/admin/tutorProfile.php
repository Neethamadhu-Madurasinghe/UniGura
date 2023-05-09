<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/tutorProfile.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/tutorProfile.js"></script>


<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>



    <div class="tutor-profile-page">
        <div class="top-details-box">
            <div class="tutor-details">
                <div class="profile-picture">
                    <?php if ($data['tutorDetails']->profile_picture === NULL) : ?>
                        <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                    <?php else : ?>
                        <img src="<?php echo URLROOT ?><?php echo $data['tutorDetails']->profile_picture ?>" alt="tutor profile picture">
                    <?php endif; ?>
                </div>
                <div class="name-actions">
                    <div class="name">
                        <h1><?php echo $data['tutorDetails']->first_name . ' ' . $data['tutorDetails']->last_name; ?></h1>
                    </div>
                    <div class="actions">

                        <?php if ($data['tutorDetails']->is_hidden == 1) : ?>
                            <div class="button" title="Show" style="background-color: #ff8a0544;">
                                <a href="showTutor?tutorID=<?php echo $data['tutorDetails']->id; ?>" title="Show"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/show.png"></a>
                            </div>
                        <?php else : ?>
                            <div class="button" title="Show" style="cursor:not-allowed;">
                                <a href="#" title="Show"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/show.png" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>

                        <?php if ($data['tutorDetails']->is_hidden == 0) : ?>
                            <div class="button" style="background-color: #ff8a0544;">
                                <a href="hideTutor?tutorID=<?php echo $data['tutorDetails']->id; ?>" title="Hide"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/hide.png"></a>
                            </div>
                        <?php else : ?>
                            <div class="button" title="Hide" style="cursor:not-allowed;">
                                <a href="#" title="Hide"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/hide.png" id="tutor-hide-btn" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>

                        <?php if ($data['tutorDetails']->is_banned == 0) : ?>
                            <div class="button" style="background-color: #ff8a0544;">
                                <a href="blockTutor?tutorID=<?php echo $data['tutorDetails']->id; ?>" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png"></a>
                            </div>
                        <?php else : ?>
                            <div class="button" style="cursor:not-allowed;">
                                <a href="#" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>

                        <?php if ($data['tutorDetails']->is_banned == 1) : ?>
                            <div class="button" style="background-color: #ff8a0544;">
                                <a href="unblockTutor?tutorID=<?php echo $data['tutorDetails']->id; ?>" title="Unblock"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/unblock.png"></a>
                            </div>
                        <?php else : ?>
                            <div class="button" style="cursor:not-allowed;">
                                <a href="#" title="Unblock"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/unblock.png" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="class-summary">
                <div class="total-class">
                    <p><?php echo $data['tutorDetails']->description ?></p>
                </div>
                <div class="pending-amount">
                    <h1>Educational Qualifications</h1>
                    <div class="qualification-files">
                        <div class="qualification">
                            <a href="viewFiles?file=<?php echo $data['tutorDetails']->id_copy ?>" target="_blank"><i class="fa-solid fa-file-lines"></i> &nbspNational Identity Card Copy</a>
                        </div>
                        <div class="qualification">
                            <a href="viewFiles?file=<?php echo $data['tutorDetails']->university_entrance_letter ?>" target="_blank"><i class="fa-solid fa-file-lines"></i> &nbspUniversity Entrance Letter</a>
                        </div>
                        <div class="qualification">
                            <a href="viewFiles?file=<?php echo $data['tutorDetails']->advanced_level_result ?>" target="_blank"><i class="fa-solid fa-file-lines"></i> &nbspAdvanced Level Result</a>
                        </div>
                        <div class="qualification">
                            <i class="fa-solid fa-user-graduate"></i> &nbsp<?php echo $data['tutorDetails']->education_qualification ?>
                        </div>
                        <div class="qualification">
                            <i class="fa-solid fa-graduation-cap"></i> <?php echo $data['tutorDetails']->university ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--===================================== Tutor AVAILABLE TIME SLOTS========================= -->

        <div class="pop-time-table">
            <!-- <h1>Select time slots</h1> -->

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

                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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

                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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
                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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
                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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
                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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
                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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
                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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
                        <?php foreach ($data['allTimeSlots'] as $timeSlot) : ?>
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



        <div class="3-filed-section">
            <div class="filed-selection-btn">
                <div>
                    <button class="info-btn"><i class="fa-solid fa-circle-info"></i> Student Info</button>
                </div>
                <div>
                    <button class="active-class-btn"><i class="fa-solid fa-rotate fa-spin-pulse"></i> Active Class</button>
                </div>
                <div>
                    <button class="finished-class-btn"><i class="fa fa-regular fa-circle-check"></i> Finished Class</button>
                </div>
            </div>
        </div>


        <div class="tutor-info">
            <div class="section-1">
                <div class="first-name">
                    <h1>First Name: </h1>
                    <h2><?php echo $data['tutorDetails']->first_name; ?></h2>
                </div>
                <div class="address-line-1">
                    <h1>Address Line 1: </h1>
                    <h2><?php echo $data['tutorDetails']->address_line1 ?></h2>
                </div>
                <div class="city">
                    <h1>City: </h1>
                    <h2><?php echo $data['tutorDetails']->city; ?></h2>
                </div>
                <div class="tel-number">
                    <h1>Tel Number: </h1>
                    <h2><?php echo $data['tutorDetails']->phone_number; ?></h2>
                </div>
            </div>

            <div class="section-2">
                <div class="last-name">
                    <h1>Last Name: </h1>
                    <h2><?php echo $data['tutorDetails']->last_name; ?></h2>
                </div>
                <div class="address-line-2">
                    <h1>Address Line 2: </h1>
                    <h2><?php echo $data['tutorDetails']->address_line2 ?></h2>
                </div>
                <div class="gender">
                    <h1>Gender : </h1>
                    <h2><?php echo $data['tutorDetails']->gender; ?></h2>
                </div>
                <div class="preferred-class-mode">
                    <h1>Preferred Class Mode: </h1>
                    <h2><?php echo $data['tutorDetails']->mode; ?></h2>
                </div>
            </div>
        </div>



        <div class="active-classes">

            <?php if ($data['numberOfActiveClasses'] === 0) : ?>
                <div class="result-not-found">
                    <img src="<?php echo URLROOT; ?>/public/img/admin/nodata.png" alt=""><br>
                    <h1>No active classes.</h1>
                </div>
            <?php endif; ?>

            <?php foreach ($data['allClasses'] as $aClassDay) : ?>
                <?php if ($aClassDay->completion_status === 0) : ?>
                    <div class="one-class">
                        <div class="student-profile">
                            <img src="<?php echo URLROOT ?><?php echo $aClassDay->student->profile_picture ?>" alt="student profile picture">
                        </div>
                        <div class="class-details">
                            <div class="student-name">
                                <h1>student: </h1>
                                <h2><?php echo $aClassDay->tutor_first_name . ' ' . $aClassDay->tutor_last_name ?></h2>
                            </div>
                            <div class="subject">
                                <h1>Subject: </h1>
                                <h2><?php echo $aClassDay->subjectName ?></h2>
                            </div>
                            <div class="lessson">
                                <h1>Lesson: </h1>
                                <h2><?php echo $aClassDay->moduleName ?></h2>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>


        <div class="finished-classes">

            <?php if ($data['numberOfCompletedClasses'] == 0) : ?>
                <div class="result-not-found">
                    <img src="<?php echo URLROOT; ?>/public/img/admin/nodata.png" alt=""><br>
                    <h1>No finished classes.</h1>
                </div>
            <?php endif; ?>


            <?php foreach ($data['allClasses'] as $aClassDay) : ?>
                <?php if ($aClassDay->completion_status === 1) : ?>
                    <div class="one-class">
                        <div class="student-profile">
                            <img src="<?php echo URLROOT ?><?php echo $aClassDay->student->profile_picture ?>" alt="student profile picture">
                        </div>
                        <div class="class-details">
                            <div class="student-name">
                                <h1>student: </h1>
                                <h2><?php echo $aClassDay->tutor_first_name . ' ' . $aClassDay->tutor_last_name ?></h2>
                            </div>
                            <div class="subject">
                                <h1>Subject: </h1>
                                <h2><?php echo $aClassDay->subjectName ?></h2>
                            </div>
                            <div class="lessson">
                                <h1>Lesson: </h1>
                                <h2><?php echo $aClassDay->moduleName ?></h2>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</section>


</body>

</html>