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


    <div class="tutor-complaint-table" id="tutor-complaint-table">
        <div class="table-header">
            <h3>Tutor's complaints</h3>
            <div class="search-filter">
                <div class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search by Student Name...">
                </div>
                <div class="filter-box">
                    <i class='bx bx-filter-alt'></i>
                    <select name="filter" id="filter">
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
                        <th>Tutor</th>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data['allTutorComplaints'] as $tutorComplaint) { ?>
                        <tr>
                            <td><?php echo $tutorComplaint->reportReason->description; ?></td>
                            <td><?php echo $tutorComplaint->tutor->first_name . " " . $tutorComplaint->tutor->last_name ?></td>
                            <td><?php echo $tutorComplaint->student->first_name . " " . $tutorComplaint->student->last_name ?></td>

                            <?php if ($tutorComplaint->is_inquired == 0) { ?>
                                <td>
                                    <div class="complete-status">
                                        <img src="<?php echo URLROOT ?>/public/img/admin/green-dot.png" alt="">
                                        <h6>Solved</h6>
                                    </div>
                                </td>
                            <?php } else if ($tutorComplaint->is_inquired == 1) { ?>
                                <td>
                                    <div class="Not Resolve-status">
                                        <img src="<?php echo URLROOT ?>/public/img/admin/red-dot.png" alt="">
                                        <h6>Not Resolve</h6>
                                    </div>
                                </td>
                            <?php } ?>

                            <td class="action">
                                <input type="checkbox" name="complaint" id="complaint">
                                <button class="view-tutor-complaint">View</button>
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