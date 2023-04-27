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


    <section class="table">
        <section class="table-header">
            <h1>STUDENT'S COMPLAINTS</h1>
            <div class="search">
                <i class="fas fa-regular fa-search"></i>
                <input type="text" placeholder="Search by Student Name..." id="search-student-name">
            </div>
            <div class="filter">
                <div class="filter-icon">
                    <i class="fas fa-regular fa-filter"></i>
                </div>
                <select name="student-complaint-filter" id="student-complaint-filter">
                    <option value="not_choose" selected disabled hidden>Choose here</option>
                    <option value="all">All</option>
                    <option value="solved">Solved</option>
                    <option value="not_resolve">Not Resolve</option>
                </select>
            </div>
        </section>
        <section class="table-body">
            <table>
                <thead>
                    <tr>
                        <th>Complaint's Title</th>
                        <th>Student</th>
                        <th>Tutor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="student-complain">

                <?php if ($data['totalNumOfStudentComplaints'] == 0) : ?>
                        <td class="noDataDisplay">There are no student complaints to display</td>
                    <?php endif; ?>

                    <?php foreach ($data['allStudentComplaints'] as $studentComplaint) { ?>
                        <tr>
                            <td><?php echo $studentComplaint->reportReason->description; ?></td>
                            <td><?php echo $studentComplaint->student->first_name . " " . $studentComplaint->student->last_name ?></td>
                            <td><?php echo $studentComplaint->tutor->first_name . " " . $studentComplaint->tutor->last_name ?></td>

                            <input type="hidden" class="complaint-id" value="<?php echo $studentComplaint->id; ?>">

                            <?php if ($studentComplaint->is_inquired == 1) { ?>
                                <td>
                                    <div class="solved-status">
                                        <img src="<?php echo URLROOT ?>/public/img/admin/green-dot.png" alt="">
                                        <h6>Solved</h6>
                                    </div>
                                </td>
                            <?php } else if ($studentComplaint->is_inquired == 0) { ?>
                                <td>
                                    <div class="not-resolve-status">
                                        <img src="<?php echo URLROOT ?>/public/img/admin/red-dot.png" alt="">
                                        <h6>Not Resolve</h6>
                                    </div>
                                </td>
                            <?php } ?>

                            <td class="action">
                                <a href="viewStudentComplaint?studentComplaintId=<?php echo $studentComplaint->id; ?>"><button class="view-student-complaint">View</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </section>
        <div class="pagination">
            <div class="first">
                <button><a href="studentComplaint?currentPageNum=1"><i class="fas fa-regular fa-backward-fast"></i> First</a></button>
            </div>
            <div class="previous">
                <button><a href="studentComplaint?currentPageNum=<?php echo $data['previousPageNum']; ?>"><i class="fas fa-regular fa-backward-step"></i> Previous</a></button>
            </div>
            <div class="page-count">
                <h3>Page <?php echo $data['currentPageNum']; ?> of <?php echo $data['lastPageNum']; ?></h3>
            </div>
            <div class="next">
                <button><a href="studentComplaint?currentPageNum=<?php echo $data['nextPageNum']; ?>">Next <i class="fas fa-regular fa-forward-step"></i></a></button>
            </div>
            <div class="last">
                <button><a href="studentComplaint?currentPageNum=<?php echo $data['lastPageNum']; ?>">Last <i class="fas fa-regular fa-forward-fast"></i></a></button>
            </div>
        </div>
    </section>
</section>


</body>

</html>