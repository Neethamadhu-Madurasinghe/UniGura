<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/complaintView.css">
    <title>Document</title>
</head>

<body>

    <?php

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        ?>

    <div class="back-btn">
        <button id="student-complaint-back-btn"><i class="fa-regular fa-circle-left"></i> <span>Back</span></button>
    </div>

    <div class="complain-check">
        <form action="www.google.com" method="POST">
            <label for="checking">
                <?php if ($data['oneStudentComplaint']->is_inquired == 0) { ?>
                    <input type="checkbox" name="checking" checked> Checking Complaint Status
                <?php } else { ?>
                    <input type="checkbox" name="checking"> Checking Complaint Status
                <?php } ?>
            </label>

            <div class="submit-status-btn">
                <button type="submit" name="submit-status-btn">Submit Status</button>
            </div>

        </form>
    </div>


    <div class="tutor-name">
        <h1>Tutor Name</h1>
        <h3><?php echo $data['oneStudentComplaint']->tutor->first_name . ' ' . $data['oneStudentComplaint']->tutor->last_name ?></h3>
    </div>

    <div class="student-name">
        <h1>Student Name</h1>
        <h3><?php echo $data['oneStudentComplaint']->student->first_name . ' ' . $data['oneStudentComplaint']->student->last_name ?></h3>
    </div>

    <div class="report-reason">
        <h1>Report Reason</h1>
        <h3><?php echo $data['oneStudentComplaint']->reportReason->description ?></h3>
    </div>

    <div class="description">
        <h1>Description</h1>
        <h3><?php echo $data['oneStudentComplaint']->description ?></h3>
    </div>

    <div class="tutor-review-section">
        <h1>Tutor Reviews</h1>
        <div class="tutor-review">

            <?php foreach ($data['otherStudentComplaints'] as $complain) : ?>
                <div class="one-tutor-review">
                    <div class="tutor-review-header">
                        <div class="tutor-review-info">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>

                            <div class="tutor-review-title">
                                <h3><?php echo $complain->tutor->first_name . ' ' . $complain->tutor->last_name ?></h3>
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

</body>

</html>