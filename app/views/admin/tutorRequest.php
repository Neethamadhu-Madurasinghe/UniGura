<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/requirementComplaint.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/tutor_request.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

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
                                <td><a href="viewFiles?file=<?php echo $x->id_copy ?>"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
                                <td><a href="viewFiles?file=<?php echo $x->advanced_level_result ?>"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
                                <td><a href="viewFiles?file=<?php echo $x->university_entrance_letter ?>"><img class="qualification-img" src="<?php echo URLROOT ?>/public/img/admin/download-icon.png" alt=""></a></td>
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