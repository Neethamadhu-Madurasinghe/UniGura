<tbody id="student-complain">

    <?php if(empty($data['allStudentComplaints'])) : ?>
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