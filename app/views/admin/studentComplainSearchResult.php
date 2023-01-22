<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">

    <title>Responsive side bar</title>
</head>

<body>


    <div class="complaint-setting" id="complaint-setting-box">
        <div class="close-btn">
            <i class="fa fa-light fa-times" id="complaints-close-btn"></i>
        </div>
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


    <div class="tutor-request-table">
        <div class="table-header">
            <h3>Tutor’s Request</h3>
            <div class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search...">
            </div>
        </div>
        <div class="class-details-table">
            <table>
                <thead>
                    <tr>
                        <th>Tutor</th>
                        <th>Contact</th>
                        <th>University</th>
                        <th style="width:100px">ID Copy</th>
                        <th style="width:100px">A/L Result Sheet</th>
                        <th style="width:90px">University Letter</th>
                        <th style="width:80px">Hightest Qualification</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <?php foreach ($data['allTutorRequest'] as $x) { ?>
                            <td><?php echo $x->tutor->first_name . ' ' . $x->tutor->last_name ?></td>
                            <td><?php echo $x->tutor->phone_number ?></td>
                            <td><?php echo $x->university ?></td>
                            <td><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></td>
                            <td><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></td>
                            <td><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></td>
                            <td><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></td>
                            <td class="action">
                                <button class="accept">Accept</button>
                                <button class="reject">Reject</button>
                            </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="student-complaint-table">
        <div class="complaints-settings-btn">
            <i class="fa fa-light fa-gear" id="complaints-settings-btn"> <span>Complaint Reason</span></i>
        </div>
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
                        <th>Student</th>
                        <th>Tutor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="student-complain">
                    <?php foreach ($data['filterResult'] as $studentComplaint) { ?>
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
                                <button class="view-student-complaint">View</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


        <div class="tutor-complaint-table">
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

                                <?php if ($tutorComplaint->tutorReport->is_inquired == 0) { ?>
                                    <td>
                                        <div class="complete-status">
                                            <img src="<?php echo URLROOT ?>/public/img/admin/green-dot.png" alt="">
                                            <h6>Solved</h6>
                                        </div>
                                    </td>
                                <?php } else if ($tutorComplaint->tutorReport->is_inquired == 1) { ?>
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

</body>

</html>