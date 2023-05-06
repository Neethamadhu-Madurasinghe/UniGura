<tbody id="tutor-complaint">
    <?php if (empty($data['allTutorComplaints'])) : ?>
        <td class="noDataDisplay">There are no tutor complaints to display</td>
    <?php endif; ?>

    <?php foreach ($data['allTutorComplaints'] as $tutorComplaint) { ?>
        <tr>
            <td><?php echo $tutorComplaint->reportReason->description; ?></td>
            <td><?php echo $tutorComplaint->tutor->first_name . " " . $tutorComplaint->tutor->last_name ?></td>
            <td><?php echo $tutorComplaint->student->first_name . " " . $tutorComplaint->student->last_name ?></td>

            <input type="hidden" class="complaint-id" value="<?php echo $tutorComplaint->id; ?>">

            <?php if ($tutorComplaint->is_inquired == 1) { ?>
                <td>
                    <div class="complete-status">
                        <img src="<?php echo URLROOT ?>/public/img/admin/green-dot.png" alt="">
                        <h6>Solved</h6>
                    </div>
                </td>
            <?php } else if ($tutorComplaint->is_inquired == 0) { ?>
                <td>
                    <div class="Not Resolve-status">
                        <img src="<?php echo URLROOT ?>/public/img/admin/red-dot.png" alt="">
                        <h6>Not Resolve</h6>
                    </div>
                </td>
            <?php } ?>

            <td class="action">
                <a href="viewTutorComplaint?tutorComplaintId=<?php echo $tutorComplaint->id; ?>"><button class="view-tutor-complaint">View</button></a>
            </td>
        </tr>
    <?php } ?>
</tbody>
</table>