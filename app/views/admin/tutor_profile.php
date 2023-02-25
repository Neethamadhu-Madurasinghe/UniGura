<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
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
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="name-actions">
                    <div class="name">
                        <h1>Viraj Sandakelum<span>(Tutor)</span></h1><br>
                    </div>
                    <div class="actions">
                        
                        <?php if($data[0]->tutorDetails->is_hidden == 1) : ?>
                            <div class="button" title="Show">
                                <a href="showTutor?tutorID=<?php echo $data[0]->id; ?>" title="Show"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/show.png"></a>
                            </div>
                        <?php else : ?>
                            <div class="button" title="Show" style="cursor:not-allowed;">
                                <a href="#" title="Show"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/show.png" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>

                        <?php if($data[0]->tutorDetails->is_hidden == 0): ?>
                            <div class="button">
                                <a href="hideTutor?tutorID=<?php echo $data[0]->id; ?>" title="Hide"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/hide.png"></a>
                            </div>
                        <?php else: ?>
                            <div class="button" title="Hide" style="cursor:not-allowed;">
                                <a href="#" title="Hide"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/hide.png" id="tutor-hide-btn" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>

                        <?php if($data[0]->is_banned == 0) : ?>
                            <div class="button">
                                <a href="blockTutor?tutorID=<?php echo $data[0]->id; ?>" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png"></a>
                            </div>
                        <?php else : ?>
                            <div class="button" style="cursor:not-allowed;">
                                <a href="#" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png" style="cursor:not-allowed;"></a>
                            </div>
                        <?php endif; ?>

                        <?php if($data[0]->is_banned == 1) : ?>
                            <div class="button">
                                <a href="unblockTutor?tutorID=<?php echo $data[0]->id; ?>" title="Unblock"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/unblock.png"></a>
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
                    <h1>Total Classes</h1>
                    <h2>10</h2>
                </div>
                <div class="pending-amount">
                    <h1>Pending Amount</h1>
                    <h2>Rs. 1000</h2>
                </div>
            </div>
        </div>



        <!--===================================== Tutor AVAILABLE TIME SLOTS========================= -->

        <div class="pop-time-table">
            <!-- <h1>Select time slots</h1> -->

            <div class="time-table-container">
                <table id="time-table">
                    <tr class="time-table-titles">
                        <th id="">Monday</th>
                        <th id="">Tuesday</th>
                        <th id="">Time</th>
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
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
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

                <div class="color-introduce">
                    <table id="time-table">
                        <tr>
                            <td class="slot slot-used">Not Available</td>
                            <td class="slot slot-free">Available</td>
                            <td class="slot slot-selected">In Work</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>



        <div class="3-filed-section">
            <div class="filed-selection-btn">
                <div class="info-btn">
                    <button>Tutor Info</button>
                </div>
                <div class="active-class-btn">
                    <button>Active Class</button>
                </div>
                <div class="finished-class-btn">
                    <button>Finished Class</button>
                </div>
            </div>
        </div>


        <div class="tutor-info">
            <div class="section-1">
                <div class="first-name">
                    <h1>First Name: </h1>
                    <h2><?php echo $data[0]->first_name; ?></h2>
                </div>
                <div class="letter-box-number">
                    <h1>Letter Box Number: </h1>
                    <h2><?php echo $data[0]->letter_box_number; ?></h2>
                </div>
                <div class="city">
                    <h1>City: </h1>
                    <h2><?php echo $data[0]->city; ?></h2>
                </div>
                <div class="tel-number">
                    <h1>Tel Number: </h1>
                    <h2><?php echo $data[0]->phone_number; ?></h2>
                </div>
                <div class="medium">
                    <h1>Medium: </h1>
                    <h2><?php echo $data[0]->medium; ?></h2>
                </div>
            </div>

            <div class="section-2">
                <div class="last-name">
                    <h1>Last Name: </h1>
                    <h2><?php echo $data[0]->last_name; ?></h2>
                </div>
                <div class="street">
                    <h1>Street: </h1>
                    <h2><?php echo $data[0]->street; ?></h2>
                </div>
                <div class="year-of-exam">
                    <h1>Year of Exam: </h1>
                    <h2><?php echo $data[0]->year_of_exam; ?></h2>
                </div>
                <div class="gender">
                    <h1>Gender : </h1>
                    <h2><?php echo $data[0]->gender; ?></h2>
                </div>
                <div class="preferred-class-mode">
                    <h1>Preferred Class Mode: </h1>
                    <h2><?php echo $data[0]->mode; ?></h2>
                </div>
            </div>
        </div>



        <div class="active-classes">

            <?php foreach ($data[0]->allClassDays as $aClassDay) : ?>
                <div class="one-class">
                    <div class="student-profile">
                        <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                    </div>
                    <div class="class-details">
                        <div class="student-name">
                            <h1>student: </h1>
                            <h2><?php echo $aClassDay->studentDetails->first_name . ' ' . $aClassDay->studentDetails->last_name ?></h2>
                        </div>
                        <div class="subject">
                            <h1>Subject: </h1>
                            <h2><?php echo $aClassDay->subject->name ?></h2>
                        </div>
                        <div class="lessson">
                            <h1>Lesson: </h1>
                            <h2><?php echo $aClassDay->module->name ?></h2>
                        </div>
                        <div class="day">
                            <h1>Day: </h1>
                            <h2><?php echo $aClassDay->title ?></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>


        <div class="finished-classes">

            <?php foreach ($data[0]->allClassDays as $aClassDay) : ?>
                <div class="one-class">
                    <div class="student-profile">
                        <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                    </div>
                    <div class="class-details">
                        <div class="student-name">
                            <h1>student: </h1>
                            <h2><?php echo $aClassDay->studentDetails->first_name . ' ' . $aClassDay->studentDetails->last_name ?></h2>
                        </div>
                        <div class="subject">
                            <h1>Subject: </h1>
                            <h2><?php echo $aClassDay->subject->name ?></h2>
                        </div>
                        <div class="lessson">
                            <h1>Lesson: </h1>
                            <h2><?php echo $aClassDay->module->name ?></h2>
                        </div>
                        <div class="day">
                            <h1>Day: </h1>
                            <h2><?php echo $aClassDay->title ?></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>


</body>

</html>