<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<script defer src="<?php echo URLROOT ?>/public/js/admin/dashboard.js"></script>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="parent">
        <div class="left_sidebar">
            <div class="tutor-student-class-subject">
                <div class="tutors">
                    <h2>Tutors</h2>
                    <div class="card-info">
                        <div class="tutor-image">
                            <img src="<?php echo URLROOT ?>/public/img/admin/tutor.png" alt="">
                        </div>
                        <div class="tutors-info">
                            <div class="total">
                                <h3>Total :</h3>
                                <span>0<?php
                                        $totalTutors = 0;
                                        foreach ($data['allTutors'] as $tutor) {
                                            $totalTutors++;
                                        }
                                        echo $totalTutors;
                                        ?>
                                </span>
                            </div>
                            <div class="hide">
                                <h3>Hide :</h3>
                                <span>0<?php
                                        $hideTutors = 0;
                                        foreach ($data['allTutors'] as $tutor) {
                                            if ($tutor->is_hidden == 1) {
                                                $hideTutors++;
                                            }
                                        }
                                        echo $hideTutors;
                                        ?>
                                </span>
                            </div>
                            <div class="block">
                                <h3>Block :</h3>
                                <span>0<?php
                                        $blockTutors = 0;
                                        foreach ($data['allTutors'] as $tutor) {
                                            if ($tutor->tutorDetails->is_banned == 1) {
                                                $blockTutors++;
                                            }
                                        }
                                        echo $blockTutors;
                                        ?>
                                </span>
                            </div>
                            <div class="online">
                                <h3>Online :</h3>
                                <span>0<?php
                                        $onlineTutors = 0;
                                        foreach ($data['allTutors'] as $tutor) {
                                            if ($tutor->tutorDetails->mode == 'online') {
                                                $onlineTutors++;
                                            }
                                        }
                                        echo $onlineTutors;
                                        ?>
                                </span>
                            </div>
                            <div class="physical">
                                <h3>Physical :</h3>
                                <span>0<?php
                                        $physicalTutors = 0;
                                        foreach ($data['allTutors'] as $tutor) {
                                            if ($tutor->tutorDetails->mode == 'physical') {
                                                $physicalTutors++;
                                            }
                                        }
                                        echo $physicalTutors;
                                        ?>
                                </span>
                            </div>
                            <div class="both">
                                <h3>Both :</h3>
                                <span>0<?php
                                        $bothTutors = 0;
                                        foreach ($data['allTutors'] as $tutor) {
                                            if ($tutor->tutorDetails->mode == 'both') {
                                                $bothTutors++;
                                            }
                                        }
                                        echo $bothTutors;
                                        ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subject-module">
                    <h2>Subjects & Modules</h2>
                    <div class="card-info">
                        <div class="subject-module-image">
                            <img src="<?php echo URLROOT ?>/public/img/admin/subject.png" alt="">
                        </div>
                        <div class="subject-module-info">
                            <div class="Subject">
                                <h3>Subject :</h3>
                                <span>
                                    0<?php
                                        $totalSubjects = 0;
                                        foreach ($data['allSubjects'] as $subject) {
                                            $totalSubjects++;
                                        }
                                        echo $totalSubjects;
                                        ?>
                                </span>
                            </div>
                            <div class="module">
                                <h3>Modules :</h3>
                                <span>
                                    0<?php
                                        $totalModules = 0;
                                        foreach ($data['allModules'] as $module) {
                                            $totalModules++;
                                        }
                                        echo $totalModules;
                                        ?>
                                </span>
                            </div>
                            <div class="hide-subject">
                                <h3>Hide Subject :</h3>
                                <span>
                                    0<?php
                                        $hideSubject = 0;
                                        foreach ($data['allSubjects'] as $subject) {
                                            if ($subject->is_hidden == 1) {
                                                $hideSubject++;
                                            }
                                        }
                                        echo $hideSubject;
                                        ?>
                                </span>
                            </div>
                            <div class="hide-module">
                                <h3>Hide Module :</h3>
                                <span>
                                    0<?php
                                        $hideModule = 0;
                                        foreach ($data['allModules'] as $module) {
                                            if ($module->is_hidden == 1) {
                                                $hideModule++;
                                            }
                                        }
                                        echo $hideModule;
                                        ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="students">
                    <h2>Students</h2>
                    <div class="card-info">
                        <div class="student-image">
                            <img src="<?php echo URLROOT ?>/public/img/admin/student.png" alt="">
                        </div>
                        <div class="students-info">
                            <div class="total">
                                <h3>Total :</h3>
                                <span>
                                    0<?php
                                        $totalStudents = 0;
                                        foreach ($data['allStudents'] as $student) {
                                            $totalStudents++;
                                        }
                                        echo $totalStudents;
                                        ?>
                                </span>
                            </div>
                            <div class="block">
                                <h3>Block :</h3>
                                <span>
                                    0<?php
                                        $blockStudent = 0;
                                        foreach ($data['allStudents'] as $student) {
                                            if ($student->studentDetails->is_banned == 0) {
                                                $blockStudent++;
                                            }
                                        }
                                        echo $blockStudent;
                                        ?>
                                </span>
                            </div>
                            <div class="online">
                                <h3>Online :</h3>
                                <span>
                                    0<?php
                                        $onlineStudent = 0;
                                        foreach ($data['allStudents'] as $student) {
                                            if ($student->studentDetails->mode == 'online') {
                                                $onlineStudent++;
                                            }
                                        }
                                        echo $onlineStudent;
                                        ?>
                                </span>
                            </div>
                            <div class="physical">
                                <h3>Physical :</h3>
                                <span>
                                    0<?php
                                        $physicalStudent = 0;
                                        foreach ($data['allStudents'] as $student) {
                                            if ($student->studentDetails->mode == 'physical') {
                                                $physicalStudent++;
                                            }
                                        }
                                        echo $physicalStudent;
                                        ?>
                                </span>
                            </div>
                            <div class="both">
                                <h3>Both :</h3>
                                <span>
                                    0<?php
                                        $bothStudent = 0;
                                        foreach ($data['allStudents'] as $student) {
                                            if ($student->studentDetails->mode == 'both') {
                                                $bothStudent++;
                                            }
                                        }
                                        echo $bothStudent;
                                        ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="classes">
                    <h2>Classes</h2>
                    <div class="card-info">
                        <div class="class-image">
                            <img src="<?php echo URLROOT ?>/public/img/admin/class.png" alt="">
                        </div>
                        <div class="classes-info">
                            <div class="total">
                                <h3>Total :</h3>
                                <span>
                                    0<?php
                                        $totalClasses = 0;
                                        foreach ($data['allTutorialClasses'] as $class) {
                                            $totalClasses++;
                                        }
                                        echo $totalClasses;
                                        ?>
                                </span>
                            </div>
                            <div class="online">
                                <h3>Online :</h3>
                                <span>
                                    0<?php
                                        $onlineClasses = 0;
                                        foreach ($data['allTutorialClasses'] as $class) {
                                            if ($class->mode == 'online') {
                                                $onlineClasses++;
                                            }
                                        }
                                        echo $onlineClasses;
                                        ?>
                                </span>
                            </div>
                            <div class="physical">
                                <h3>Physical :</h3>
                                <span>
                                    0<?php
                                        $physicalClasses = 0;
                                        foreach ($data['allTutorialClasses'] as $class) {
                                            if ($class->mode == 'physical') {
                                                $physicalClasses++;
                                            }
                                        }
                                        echo $physicalClasses;
                                        ?>
                                </span>
                            </div>
                            <div class="both">
                                <h3>Both :</h3>
                                <span>
                                    0<?php
                                        $bothClasses = 0;
                                        foreach ($data['allTutorialClasses'] as $class) {
                                            if ($class->mode == 'both') {
                                                $bothClasses++;
                                            }
                                        }
                                        echo $bothClasses;
                                        ?>
                                </span>
                            </div>
                            <div class="active-class">
                                <h3>Active :</h3>
                                <span>
                                    0<?php
                                        $activeClasses = 0;
                                        foreach ($data['allTutorialClasses'] as $class) {
                                            if ($class->completion_status == '0') {
                                                $activeClasses++;
                                            }
                                        }
                                        echo $activeClasses;
                                        ?>
                                </span>
                            </div>
                            <div class="completed-class">
                                <h3>Completed :</h3>
                                <span>
                                    0<?php
                                        $activeClasses = 0;
                                        foreach ($data['allTutorialClasses'] as $class) {
                                            if ($class->completion_status == '1') {
                                                $activeClasses++;
                                            }
                                        }
                                        echo $activeClasses;
                                        ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="right_sidebar">

            <div class="payment-summary">
                <div class="total-student-payment">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/dashboard-payment.png" alt="">
                        <h2>Total Student Payment</h2>
                    </div>
                    <span>Rs.
                        <?php
                        $totalStudentPayment = 0;
                        foreach ($data['allPaymentDetails'] as $transaction) {
                            $totalStudentPayment += $transaction->amount;
                        }
                        echo $totalStudentPayment;
                        ?>.00
                    </span>
                </div>
                <div class="total-tutor-withdrawal">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/withdrawal.png" alt="">
                        <h2>Total Tutor Withdrawal</h2>
                    </div>
                    <span>Rs.
                        <?php
                        $totalTutorWithdrawal = 0;
                        foreach ($data['allPaymentDetails'] as $transaction) {
                            if ($transaction->is_withdrawed == 1) {
                                $totalTutorWithdrawal += $transaction->amount;
                            }
                        }
                        echo (90 / 100) * $totalTutorWithdrawal;
                        ?>.00
                    </span>
                </div>
                <div class="profit">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/profit.png" alt="">
                        <h2>Profit</h2>
                    </div>
                    <span>Rs.
                        <?php
                        $totalTutorWithdrawal = 0;
                        foreach ($data['allPaymentDetails'] as $transaction) {
                            if ($transaction->is_withdrawed == 1) {
                                $totalTutorWithdrawal += $transaction->amount;
                            }
                        }
                        echo (10 / 100) * $totalTutorWithdrawal;
                        ?>.00
                    </span>
                </div>
            </div>


            <div class="approval-complaint">
                <div class="new_approval">
                    <div class="title">
                        <h2>New Approval</h2>
                        <a href="tutorRequest">View All</a>
                    </div>

                    <?php if ($data['numOfTutorRequest'] == 0) : ?>
                        <div class="no_request">
                            <img src="<?php echo URLROOT ?>/public/img/admin/emptyTutorRequest.png" alt=""><br>
                            <span>Looks like haven't tutor request yet</span>
                        </div>
                    <?php endif; ?>

                    <div class="requested_list">
                        <?php foreach ($data['allTutors'] as $requestTutor) : ?>
                            <?php if ($requestTutor->is_approved == '0') : ?>
                                <div class="available-request">
                                    <div class="profile-img">
                                        <?php if ($requestTutor->tutorDetails->profile_picture === NULL) : ?>
                                            <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                                        <?php else : ?>
                                            <img src="<?php echo URLROOT ?><?php echo $requestTutor->tutorDetails->profile_picture ?>" alt="tutor profile picture">
                                        <?php endif; ?>
                                    </div>
                                    <div class="request-details">
                                        <h3><?php echo $requestTutor->tutorDetails->first_name . ' ' . $requestTutor->tutorDetails->last_name ?></h3>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="complaints">
                    <div class="title">
                        <h2>Complaints</h2>
                        <a href="studentComplaint">View All</a>
                    </div>

                    <?php if ($data['numOfStudentReport'] == 0 && $data['numOfTutorReport'] == 0) : ?>
                        <div class="no_complaint">
                            <img src="<?php echo URLROOT ?>/public/img/admin/emptyCompliants.png" alt=""><br>
                            <span>Looks like haven't complaints yet</span>
                        </div>
                    <?php endif; ?>



                    <div class="complaints_list">
                        <?php foreach ($data['allTutorReports'] as $complaint) : ?>
                            <?php if ($complaint->is_inquired == '0') : ?>
                                <div class="available-complaints">
                                    <div class="profile-img">
                                        <?php if ($complaint->tutorDetails->profile_picture === NULL) : ?>
                                            <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                                        <?php else : ?>
                                            <img src="<?php echo URLROOT ?><?php echo $complaint->tutorDetails->profile_picture ?>" alt="profile picture">
                                        <?php endif; ?>
                                    </div>
                                    <div class="complaint-details">
                                        <h3><?php echo $complaint->tutorDetails->first_name . ' ' . $complaint->tutorDetails->last_name ?></h3>
                                        <span><?php echo $complaint->description ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>


                        <?php foreach ($data['allStudentReports'] as $complaint) : ?>
                            <?php if ($complaint->is_inquired == '0') : ?>
                                <div class="available-complaints">
                                    <div class="profile-img">
                                        <?php if ($complaint->studentDetails->profile_picture === NULL) : ?>
                                            <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                                        <?php else : ?>
                                            <img src="<?php echo URLROOT ?><?php echo $complaint->studentDetails->profile_picture ?>" alt="profile picture">
                                        <?php endif; ?>
                                    </div>
                                    <div class="complaint-details">
                                        <h3><?php echo $complaint->studentDetails->first_name . ' ' . $complaint->studentDetails->last_name ?></h3>
                                        <span><?php echo $complaint->description ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>



</section>

</body>

</html>