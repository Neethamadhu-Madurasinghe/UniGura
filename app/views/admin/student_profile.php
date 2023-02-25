<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/studentProfile.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/studentProfile.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="top-details-box">
        <div class="student-details">
            <div class="profile-picture">
                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
            </div>
            <div class="name-actions">
                <div class="name">
                    <h1>Viraj Sandakelum<span>(Student)</span></h1><br>
                </div>
                <div class="actions">

                    <?php if ($data[0]->studentDetails->is_banned == 0) : ?>
                        <div class="button" title="Block">
                            <a href="blockStudent?studentID=<?php echo $data[0]->user_id; ?>" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png"></a>
                        </div>
                    <?php else : ?>
                        <div class="button" title="Block" style="cursor:not-allowed;">
                            <a href="#" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png" style="cursor:not-allowed;"></a>
                        </div>
                    <?php endif; ?>


                    <?php if ($data[0]->studentDetails->is_banned == 1) : ?>
                        <div class="button" title="Unblock" ">
                            <a href="unblockStudent?studentID=<?php echo $data[0]->user_id; ?>" title="Unblock"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/unblock.png"></a>
                        </div>
                    <?php else : ?>
                        <div class="button" title="Unblock" style="cursor:not-allowed;">
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

    <div class="3-filed-section">
        <div class="filed-selection-btn">
            <div class="info-btn">
                <button>Student Info</button>
            </div>
            <div class="active-class-btn">
                <button>Active Class</button>
            </div>
            <div class="finished-class-btn">
                <button>Finished Class</button>
            </div>
        </div>
    </div>


    <div class="student-info">
        <div class="section-1">
            <div class="first-name">
                <h1>First Name: </h1>
                <h2><?php echo $data[0]->studentDetails->first_name ?></h2>
            </div>
            <div class="letter-box-number">
                <h1>Letter Box Number: </h1>
                <h2><?php echo $data[0]->studentDetails->letter_box_number ?></h2>
            </div>
            <div class="city">
                <h1>City: </h1>
                <h2><?php echo $data[0]->studentDetails->city ?></h2>
            </div>
            <div class="tel-number">
                <h1>Tel Number: </h1>
                <h2><?php echo $data[0]->studentDetails->phone_number ?></h2>
            </div>
            <div class="joined-date">
                <h1>Joined Date: </h1>
                <h2><?php echo $data[0]->studentDetails->joined_date ?></h2>
            </div>
        </div>

        <div class="section-2">
            <div class="last-name">
                <h1>Last Name: </h1>
                <h2><?php echo $data[0]->studentDetails->last_name ?></h2>
            </div>
            <div class="street">
                <h1>Street: </h1>
                <h2><?php echo $data[0]->studentDetails->street ?></h2>
            </div>
            <div class="year-of-exam">
                <h1>Year of Exam: </h1>
                <h2><?php echo $data[0]->year_of_exam ?></h2>
            </div>
            <div class="gender">
                <h1>Gender : </h1>
                <h2><?php echo $data[0]->studentDetails->gender ?></h2>
            </div>
            <div class="preferred-class-mode">
                <h1>Preferred Class Mode: </h1>
                <h2><?php echo $data[0]->studentDetails->mode ?></h2>
            </div>
        </div>
    </div>



    <div class="active-classes">

        <?php foreach ($data[0]->allClassDays as $aClassDay) : ?>
            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2><?php echo $aClassDay->tutorDetails->first_name . ' ' . $aClassDay->tutorDetails->last_name ?></h2>
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
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2><?php echo $aClassDay->tutorDetails->first_name . ' ' . $aClassDay->tutorDetails->last_name ?></h2>
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

</section>



</body>

</html>