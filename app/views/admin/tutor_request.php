<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/tutor_request.js"></script>


<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    


    <!-- <div class="menu-bar">
        <div class="menu-bar-selection-btn">
            <div class="tutor-request-btn" id="tutor-request-btn">
                <a href="tutorRequest"><button id="tutor-request">Tutor Request</button></a>
            </div>
        </div>
    </div> -->

    <section class="table tutor-request-table" id="tutor-request-table">
        <section class="table-header">
            <h1>TUTOR'S REQUEST</h1>
        </section>
        <section class="table-body">
            <table>
                <thead>
                    <tr>
                        <th>Tutor</th>
                        <th>Contact</th>
                        <th>University</th>
                        <th>ID Copy</th>
                        <th>A/L Result Sheet</th>
                        <th>University Letter</th>
                        <th>Hightest Qualification</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="student-complain" class="student-complaint">

                    <?php if ($data['totalNumOfTutorRequest'] == 0) : ?>
                        <td class="noDataDisplay">There are no tutor requests to display</td>
                    <?php endif; ?>

                    <?php foreach ($data['allTutorRequest'] as $x) { ?>
                        <?php if ($x->is_approved == 0) : ?>
                            <tr>
                                <td><?php echo $x->tutor->first_name . ' ' . $x->tutor->last_name ?></td>
                                <td><?php echo $x->tutor->phone_number ?></td>
                                <td><?php echo $x->university ?></td>
                                <td><a href="/user_files/16833968445895.pdf"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
                                <td><a href="tutor_detail_files/id_copy/16833956602765.jpeg"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
                                <td><a href="<?php echo URLROOT; ?>/public/profile_pictures/16774330206500.pdf"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
                                <td><?php echo $x->education_qualification ?></td>
                                <td class="action action-tutor-request">
                                    <button class="accept"><a href="acceptTutorRequest?tutorID=<?php echo $x->tutor->id; ?>">Accept</a></button>
                                    <button class="reject"><a href="rejectTutorRequest?tutorID=<?php echo $x->tutor->id; ?>">Reject</a></button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php } ?>
                </tbody>
            </table>

        </section>

    </section>
</section>


</body>

</html>