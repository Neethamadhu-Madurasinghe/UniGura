<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/complaint_setting.js"></script>

<div class="blur-filter" id="blur-filter"></div>



<?php
echo '<pre>';
print_r($data);
echo '</pre>';
?>

<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <?php if ($data['errors']['student_reason'] === 'Please enter a valid reason') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Invalid Reason!</h2>
            <h4>Please enter a reason length between 3 to 40 characters.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>

    <?php if ($data['errors']['student_reason'] === 'Reason is already in use') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>A reason is already in use!</h2>
            <h4>Can't delete a reason that is already in use as may be student report or tutor report.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>


    <?php if ($data['errors']['student_reason'] === 'Foreign key constraint failed') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Already in used!</h2>
            <h4>A reason that is already in use cannot be deleted, either a student report or a tutor report.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>


    <?php if ($data['errors']['student_reason'] === 'Reason should have less than 40 characters') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Exceeded the character limit!</h2>
            <h4>Reason should have less than 40 characters.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>





    <?php if ($data['errors']['tutor_reason'] === 'Please enter a valid reason') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Invalid Reason!</h2>
            <h4>Please enter a reason length between 3 to 40 characters.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>

    <?php if ($data['errors']['tutor_reason'] === 'Reason is already in use') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Duplicate Reason!</h2>
            <h4>Please enter a different tutor Report Reason.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>


    <?php if ($data['errors']['tutor_reason'] === 'Foreign key constraint failed') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Already in used!</h2>
            <h4>A reason that is already in use cannot be deleted, either a student report or a tutor report.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>


    <?php if ($data['errors']['tutor_reason'] === 'Reason should have less than 40 characters') : ?>
        <div class="popup" id="popup">
            <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
            <h2>Exceeded the character limit!</h2>
            <h4>Reason should have less than 40 characters.</h4>
            <button type="button" id="closePopup">OK</button>
        </div>
    <?php endif; ?>






    <div class="menu-bar">
        <div class="menu-bar-selection-btn">
            <div class="student-complaint-btn" id="student-complaint-btn">
                <a href="studentComplaint"><button id="student-complaint">Student Complaint</button></a>
            </div>
            <div class="tutor-complaint-btn" id="tutor-complaint-btn">
                <a href="tutorComplaint"><button id="tutor-complaint">Tutor Complaint</button></a>
            </div>
            <div class="complaint-setting-btn" id="complaint-setting-btn">
                <a href="complaintSetting"><button id="complaint-setting">Complaint Setting</button></a>
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
                                <a href="deleteStudentComplainReason?complaintID=<?php echo $reason->id ?>" class="delete_icon"><i class="fa fa-regular fa-trash"></i> Delete</a>
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
                                <a href="deleteTutorComplainReason?complaintID=<?php echo $reason->id ?>" class="delete_icon"><i class="fa fa-regular fa-trash"></i> Delete</a>
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