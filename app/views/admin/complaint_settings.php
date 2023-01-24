<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="menu-bar">
        <div class="menu-bar-selection-btn">
            <div class="tutor-request-btn" id="tutor-request-btn">
                <a href="tutorRequest"><button>Tutor Request</button></a>
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
                <h1>Student Reason</h1>

                <div class="add-complaint">
                    <input type="text" placeholder="Add the new student report reason" id="type-student-complain-reason">
                    <button type="submit" id="add-student-complain-reason"><i class="fa fa-light fa-plus"></i> Complaint</button>
                </div>
                <div class="complaints-list">
                    <div class="one-complaint">
                        <input type="text" value="Reason" disabled class='complaint_input_filed'>
                        <a href="#" class="edit_icon_js"><i class="fa fa-light fa-edit"></i> Edit</a>
                        <div class="save-cancel">
                            <a href="#" class="save_btn_js"><i class="fa fa-light fa-save"></i> Save</a>
                            <a href="#" class="cancel_btn_js"><i class="fa fa-light fa-times"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>

            <div class="tutor-complaint-reason">
                <h1>Tutor Reason</h1>

                <div class="add-complaint">
                    <input type="text" placeholder="Add the new tutor report reason">
                    <a href="#"><i class="fa fa-light fa-plus"></i> Complaint</a>
                </div>
                <div class="complaints-list">
                    <div class="one-complaint">
                        <input type="text" value="Reason" disabled class='complaint_input_filed'>
                        <a href="#" class="edit_icon_js"><i class="fa fa-light fa-edit"></i> Edit</a>
                        <div class="save-cancel">
                            <a href="#" class="save_btn_js"><i class="fa fa-light fa-save"></i> Save</a>
                            <a href="#" class="cancel_btn_js"><i class="fa fa-light fa-times"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                    <div class="one-complaint">
                        <h4>Reason</h4>
                        <a href="#"><i class="fa fa-light fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



</body>

</html>