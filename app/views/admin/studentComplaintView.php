<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/complaintView.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/complaint_view.js"></script>


<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="complain-check">
        <form action="updateStudentComplainInquire" method="POST">
            <input type="hidden" name="complainStatus" id="complainStatus" value="<?php echo $data['oneStudentComplaint'][0]->is_inquired ?>">
            <input type="hidden" name="studentComplaintId" value="<?php echo $data['oneStudentComplaint'][0]->studentReportID ?>">


            <input type="hidden" name="studentId" value="<?php echo $data['oneStudentComplaint'][0]->student_id ?>">
            <input type="hidden" name="tutorId" value="<?php echo $data['oneStudentComplaint'][0]->tutor_id ?>">


            <h4>Complaint Status (Solved or not):&nbsp;&nbsp; </h4>

            <label for="checking" class="checkbox-button">
                <?php if ($data['oneStudentComplaint'][0]->is_inquired == 1) { ?>
                    <input type="checkbox" name="complainStatus" checked>
                <?php } else { ?>
                    <input type="checkbox" name="complainStatus">
                <?php } ?>
            </label>

            <div class="submit-status-btn">
                <button type="submit" name="submit-status-btn" id="submit-status-btn">Submit</button>
            </div>
        </form>
    </div>


    <div class="tutor-name">
        <h1>Tutor Name</h1>
        <h3><?php echo $data['oneStudentComplaint'][0]->tutor->first_name . ' ' . $data['oneStudentComplaint'][0]->tutor->last_name ?></h3>
    </div>

    <div class="student-name">
        <h1>Student Name</h1>
        <h3><?php echo $data['oneStudentComplaint'][0]->student->first_name . ' ' . $data['oneStudentComplaint'][0]->student->last_name ?></h3>
    </div>

    <div class="report-reason">
        <h1>Report Reason</h1>
        <h3><?php echo $data['oneStudentComplaint'][0]->description ?></h3>
    </div>

    <div class="description">
        <h1>Description</h1>
        <h3><?php echo $data['oneStudentComplaint'][0]->description ?></h3>
    </div>

    <div class="tutor-review-section">
        <h1>Tutor's Other Reviews</h1>
        <div class="tutor-review">

            <?php if (empty($data['otherStudentComplaints'])) : ?>
                <div class="result-not-found">
                    <img src="<?php echo URLROOT; ?>/public/img/admin/resultNotFound.png" alt=""><br>
                    <h1>Looks like there haven't been any other reviews yet for this tutor.</h1>
                </div>
            <?php endif; ?>


            <?php foreach ($data['otherStudentComplaints'] as $complain) : ?>
                <div class="one-tutor-review">
                    <div class="tutor-review-header">
                        <div class="tutor-review-info">
                            <div class="profile-img">
                                <?php if ($complain->tutor->profile_picture === NULL) : ?>
                                    <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                                <?php else : ?>
                                    <img src="<?php echo URLROOT ?><?php echo $complain->tutor->profile_picture ?>" alt="profile picture">
                                <?php endif; ?>

                            </div>
                            <div class="tutor-review-title">
                                <h3><?php echo $complain->tutor->first_name . ' ' . $complain->tutor->last_name ?></h3>
                                <h5><?php echo $complain->ReportReason ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="tutor-review-description">
                        <p><?php echo $complain->description ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</section>



</body>

</html>