<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/student_complaint.js"></script>




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


    <div class="student-complaint-table" id="student-complaint-table">
        <div class="table-header">
            <h3>Student's complaints</h3>
            <div class="search-filter">
                <div class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search by Student Name..." id="search-student-name">
                    <button class="search-btn" id="search-student-name-btn">Search</button>
                </div>
                <div class="filter-box">
                    <i class='bx bx-filter-alt'></i>
                    <select name="student-complaint-filter" id="student-complaint-filter">
                        <option value="not_choose" selected disabled hidden>Choose here</option>
                        <option value="all">All</option>
                        <option value="solved">Solved</option>
                        <option value="not_resolve">Not Resolve</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="class-details-table">
            <table>
                <thead>
                    <tr>
                        <th>complaint's Title</th>
                        <th>Student</th>
                        <th>Tutor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="student-complain">
                    <?php foreach ($data['allStudentComplaints'] as $studentComplaint) { ?>
                        <tr>
                            <td><?php echo $studentComplaint->reportReason->description; ?></td>
                            <td><?php echo $studentComplaint->student->first_name . " " . $studentComplaint->student->last_name ?></td>
                            <td><?php echo $studentComplaint->tutor->first_name . " " . $studentComplaint->tutor->last_name ?></td>

                            <input type="hidden" class="complaint-id" value="<?php echo $studentComplaint->id; ?>">

                            <?php if ($studentComplaint->is_inquired == 0) { ?>
                                <td>
                                    <div class="solved-status">
                                        <img src="<?php echo URLROOT ?>/public/img/admin/green-dot.png" alt="">
                                        <h6>Solved</h6>
                                    </div>
                                </td>
                            <?php } else if ($studentComplaint->is_inquired == 1) { ?>
                                <td>
                                    <div class="not-resolve-status">
                                        <img src="<?php echo URLROOT ?>/public/img/admin/red-dot.png" alt="">
                                        <h6>Not Resolve</h6>
                                    </div>
                                </td>
                            <?php } ?>

                            <td class="action">
                                <a href="viewComplaint?studentComplaintId=<?php echo $studentComplaint->id; ?>"><button class="view-student-complaint">View</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


</body>

</html>