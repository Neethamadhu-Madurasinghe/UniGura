<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
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
                <?php if ($data['studentDetails']->profile_picture === NULL) : ?>
                    <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                <?php else : ?>
                    <img src="<?php echo URLROOT ?><?php echo $data['studentDetails']->profile_picture ?>" alt="student profile picture">
                <?php endif; ?>
            </div>
            <div class="name-actions">
                <div class="name">
                    <h1><?php echo $data['studentDetails']->first_name . " " . $data['studentDetails']->last_name ?></h1>
                </div>
                <div class="actions">

                    <?php if ($data['studentDetails']->is_banned == 0) : ?>
                        <div class="button" title="Block" style="background-color: #ff8a0544;">
                            <a href="blockStudent?studentID=<?php echo $data['studentDetails']->user_id; ?>" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png"></a>
                        </div>
                    <?php endif; ?>


                    <?php if ($data['studentDetails']->is_banned == 1) : ?>
                        <div class="button" title="Unblock" style="background-color: #ff8a0544;">
                            <a href="unblockStudent?studentID=<?php echo $data['studentDetails']->user_id; ?>" title="Unblock"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/unblock.png"></a>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>
        <!-- <div class="class-summary">
            <div class="total-class">
                <h1>Total Classes</h1>
                <h2>10</h2>
            </div>
            <div class="pending-amount">
                <h1>Pending Amount</h1>
                <h2>Rs. 1000</h2>
            </div> -->
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


    <div class="student-info">
        <div class="section-1">
            <div class="first-name">
                <h1>First Name: </h1>
                <h2><?php echo $data['studentDetails']->first_name ?></h2>
            </div>
            <div class="address-line-1">
                <h1>Address Line 1: </h1>
                <h2><?php echo $data['studentDetails']->address_line1 ?></h2>
            </div>
            <div class="city">
                <h1>City: </h1>
                <h2><?php echo $data['studentDetails']->city ?></h2>
            </div>
            <div class="tel-number">
                <h1>Tel Number: </h1>
                <h2><?php echo $data['studentDetails']->phone_number ?></h2>
            </div>
            <div class="joined-date">
                <h1>Joined Date: </h1>
                <h2><?php echo $data['studentDetails']->joined_date ?></h2>
            </div>
        </div>

        <div class="section-2">
            <div class="last-name">
                <h1>Last Name: </h1>
                <h2><?php echo $data['studentDetails']->last_name ?></h2>
            </div>
            <div class="address-line-2">
                <h1>Address Line 2: </h1>
                <h2><?php echo $data['studentDetails']->address_line2 ?></h2>
            </div>
            <div class="year-of-exam">
                <h1>Year of Exam: </h1>
                <h2><?php echo $data['studentDetails']->year_of_exam ?></h2>
            </div>
            <div class="gender">
                <h1>Gender : </h1>
                <h2><?php echo $data['studentDetails']->gender ?></h2>
            </div>
            <div class="preferred-class-mode">
                <h1>Preferred Class Mode: </h1>
                <h2><?php echo $data['studentDetails']->mode ?></h2>
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
                    <div class="tutor-profile">
                        <img src="<?php echo URLROOT ?><?php echo $aClassDay->tutor->profile_picture ?>" alt="student profile picture">
                    </div>
                    <div class="class-details">
                        <div class="tutor-name">
                            <h1>Tutor: </h1>
                            <h2><?php echo $aClassDay->tutor->first_name . ' ' . $aClassDay->tutor->last_name ?></h2>
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
                    <div class="tutor-profile">
                        <img src="<?php echo URLROOT ?><?php echo $aClassDay->tutor->profile_picture ?>" alt="student profile picture">
                    </div>
                    <div class="class-details">
                        <div class="tutor-name">
                            <h1>Tutor: </h1>
                            <h2><?php echo $aClassDay->tutor->first_name . ' ' . $aClassDay->tutor->last_name ?></h2>
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

</section>



</body>

</html>