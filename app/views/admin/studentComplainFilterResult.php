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

</body>

</html>