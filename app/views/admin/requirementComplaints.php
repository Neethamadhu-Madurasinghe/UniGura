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


<?php
    echo '<pre>';
    print_r($data);
    echo '</pre>';



?>

<body>

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



    <div class="tutor-request-table" id="tutor-request-table">
        <div class="table-header">
            <h3>Tutor’s Request</h3>
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
                            <td><a href="<?php echo URLROOT; ?>/profile_pictures/16774330206500.pdf"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
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


</body>

</html>