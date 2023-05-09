<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/complaintView.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/complaint_view.js"></script>





<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <!-- <div class="back-btn">
        <button id="student-complaint-back-btn"><i class="fa-regular fa-circle-left"></i> <span>Back</span></button>
    </div> -->

    <div class="complain-check">
        <form action="updateTutorComplainInquire" method="POST">
            <input type="hidden" name="complainStatus" id="complainStatus" value="<?php echo $data['oneTutorComplaint']->is_inquired ?>">
            <input type="hidden" name="tutorComplaintId" value="<?php echo $data['oneTutorComplaint']->id ?>">

            <input type="hidden" name="studentId" value="<?php echo $data['oneTutorComplaint']->student_id ?>">
            <input type="hidden" name="tutorId" value="<?php echo $data['oneTutorComplaint']->tutor_id ?>">

            <h4>Complaint Status (Solved or not):&nbsp;&nbsp; </h4>

            <label for="checking">
                <?php if ($data['oneTutorComplaint']->is_inquired == 1) { ?>
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
        <h3><?php echo $data['oneTutorComplaint']->tutor->first_name . ' ' . $data['oneTutorComplaint']->tutor->last_name ?></h3>
    </div>

    <div class="student-name">
        <h1>Student Name</h1>
        <h3><?php echo $data['oneTutorComplaint']->student->first_name . ' ' . $data['oneTutorComplaint']->student->last_name ?></h3>
    </div>

    <div class="report-reason">
        <h1>Report Reason</h1>
        <h3><?php echo $data['oneTutorComplaint']->reportReason->description ?></h3>
    </div>

    <div class="description">
        <h1>Description</h1>
        <h3><?php echo $data['oneTutorComplaint']->description ?></h3>
    </div>

    <div class="tutor-review-section">
        <h1>Tutor's Other Reviews</h1>
        <div class="tutor-review">

            <?php if (empty($data['otherTutorComplaints'])) : ?>
                <div class="result-not-found">
                    <img src="<?php echo URLROOT; ?>/public/img/admin/resultNotFound.png" alt=""><br>
                    <h1>Looks like there haven't been any other reviews yet for this student.</h1>
                </div>
            <?php endif; ?>

            <?php foreach ($data['otherTutorComplaints'] as $complain) : ?>
                <div class="one-tutor-review">
                    <div class="tutor-review-header">
                        <div class="tutor-review-info">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?><?php echo $complain->student->profile_picture ?>" alt="profile picture">
                            </div>
                            <div class="tutor-review-title">
                                <h3><?php echo $complain->student->first_name . ' ' . $complain->student->last_name ?></h3>
                                <h5><?php echo $complain->reportReason->description ?></h5>
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