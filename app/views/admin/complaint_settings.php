<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/complaint_setting.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="menu-bar">
        <div class="menu-bar-selection-btn">
            <div class="tutor-request-btn" id="tutor-request-btn">
    
                <a href="tutorRequest"><button style="background-color: #0000;">Tutor Request</button></a>
            </div>
            <div class="student-complaint-btn" id="student-complaint-btn">
                <a href="studentComplaint"><button>Student Complaint</button></a>
            </div>
            <div class="tutor-complaint-btn" id="tutor-complaint-btn">
                <a href="tutorComplaint"><button>Tutor Complaint</button></a>
            </div>
            <div class="complaint-setting-btn" id="complaint-setting-btn">
                <a href="complaintSetting"><button>Complaint Setting</button></a>
            </div>
        </div>
    </div>

    <div class="complaint-setting" id="complaint-setting-box">
        <div class="complaint-reason">
            <div class="student-complaint-reason">
                <h1>Student Report Reasons</h1>

                <div class="add-complaint">
                    <form action="addStudentComplainReason" method="POST">
                        <input type="text" placeholder="Add the new student report reason" name="inputStudentReason">
                        <button type="submit" id="add-student-complain-reason"><i class="fa fa-light fa-plus"></i> Reason</button>
                    </form>
                </div>
                <div class="complaints-list">
                    <?php foreach ($data['studentComplaintReason'] as $reason) : ?>
                        <div class="one-complaint">
                            <form action="updateStudentComplainReason" method="POST">
                                <input type="text" value="<?php echo $reason->description ?>" disabled class='complaint_input_filed' name="inputStudentReason">
                                <input type="hidden" value="<?php echo $reason->id ?>" name="studentReasonId">
                                <a href="#" class="edit_icon_js"><i class="fa fa-light fa-edit"></i> Edit</a>
                                <div class="save-cancel">
                                    <button type="submit"><i class="fa fa-light fa-save"></i> Save</button>
                                    <a href="#" class="cancel_btn_js"><i class="fa fa-light fa-times"></i> Cancel</a>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tutor-complaint-reason">
                <h1>Tutor Report Reasons</h1>

                <div class="add-complaint">
                    <form action="addTutorComplainReason" method="POST">
                        <input type="text" placeholder="Add the new tutor report reason" name="inputTutorReason">
                        <button type="submit" id="add-tutor-complain-reason"><i class="fa fa-light fa-plus"></i> Reason</button>
                    </form>
                </div>
                <div class="complaints-list">
                    <?php foreach ($data['tutorComplaintReason'] as $reason) : ?>
                        <div class="one-complaint">
                            <form action="updateTutorComplainReason" method="POST">
                                <input type="text" value="<?php echo $reason->description ?>" disabled class='complaint_input_filed' name="inputTutorReason">
                                <input type="hidden" value="<?php echo $reason->id ?>" name="tutorReasonId">
                                <a href="#" class="edit_icon_js"><i class="fa fa-light fa-edit"></i> Edit</a>
                                <div class="save-cancel">
                                    <button type="submit"><i class="fa fa-light fa-save"></i> Save</button>
                                    <a href="#" class="cancel_btn_js"><i class="fa fa-light fa-times"></i> Cancel</a>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</section>

</body>

</html>