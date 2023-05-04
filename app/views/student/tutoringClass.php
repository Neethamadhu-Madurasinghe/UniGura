<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/student/inc/components/MainNavbar.php';
require_once APPROOT . '/views/student/inc/components/TutoringClassCard.php';


Header::render(
    'Class DashBoard',
    [
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/components/error-success-popup.css',
        URLROOT . '/public/css/student/tutoring-class.css',
        URLROOT . '/public/css/student/components/tutoring-class-day-card.css'
    ]
);

?>

<div
        class="invisible"
        id="template-data"
        data-tutor="<?php echo $data['tutor_id'] ?>"></div>

<div class="error-layout-background invisible">

    <div class="popup-error-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/cross.png' ?>" alt="" srcset="">
        <p id="error-message"></p>
        <button class="btn btn-search" id="error-ok">OK</button>
    </div>

    <div class="popup-success-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/success.png' ?>" alt="" srcset="">
        <p id="success-message"></p>
        <button class="btn btn-search" id="success-ok">OK</button>
    </div>

</div>

<div class="layout-background hidden">

    <div class="popup-request-send-success hidden">
        <object data="assests/success.svg" type=""></object>
        <p>Reschedule Request has been Sent Successfully</p>
        <button class="btn btn-search">OK</button>
    </div>

    <div class="pop-time-table hidden">
        <h1>Request a Rescheduling</h1>

        <div class="time-table-container">
            <table id="time-table">
                <tr class="time-table-titles">
                    <th>Time</th> <th>Monday</th> <th>Tuesday</th> <th>Wednesday</th> <th>Thursday</th> <th>Friday</th> <th>Satday</th> <th>Sunday</th>
                </tr>

                <tr>
                    <th>8.00-10.00</th> <td class="slot slot-used"></td> <td class="slot slot-used"></td> <td class="slot slot-free"></td> <td class="slot slot-free"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td>
                </tr>

                <tr>
                    <th>8.00-10.00</th> <td class="slot slot-used"></td> <td class="slot slot-selected"></td> <td class="slot slot-free"></td> <td class="slot slot-free"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td>
                </tr>

                <tr>
                    <th>8.00-10.00</th> <td class="slot slot-used"></td> <td class="slot slot-selected"></td> <td class="slot slot-free"></td> <td class="slot slot-free"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td>
                </tr>

                <tr>
                    <th>8.00-10.00</th> <td class="slot slot-used"></td> <td class="slot slot-selected"></td> <td class="slot slot-free"></td> <td class="slot slot-free"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td>
                </tr>

                <tr>
                    <th>8.00-10.00</th> <td class="slot slot-used"></td> <td class="slot slot-selected"></td> <td class="slot slot-free"></td> <td class="slot slot-free"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td> <td class="slot slot-used"></td>
                </tr>

                </tr>
            </table>
        </div>

        <div class="popup-button-container">
            <button class="btn btn-search" id="timetable-cancel">Cancel</button>
            <button class="btn btn-search">Request</button>
        </div>

    </div>


    <div class="popup-feedback-form hidden">
        <h1>Provide Feedback</h1>
        <div class="feedback-star-container">
            <img src="<?php echo URLROOT . '/public/img/student/big.png' ?>" alt="" srcset="">
            <img src="<?php echo URLROOT . '/public/img/student/big.png' ?>" alt="" srcset="">
            <img src="<?php echo URLROOT . '/public/img/student/big.png' ?>" alt="" srcset="">
            <img src="<?php echo URLROOT . '/public/img/student/big.png' ?>" alt="" srcset="">
            <img src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
        </div>
        <div class="comments-container">
            <p>Leave a comment (Optional):</p>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="submit-btn-container">
            <button class="btn" id="feedback-cancel">Cancel</button>
            <button class="btn">Submit</button>
        </div>
    </div>

    <div class="popup-report invisible">
        <h1>Report a Problem</h1>
        <form action="" id="tutor-report-form">
            <div class="report-reason-container">

                <?php
                foreach ($data['report_reasons'] as $report_reason) {
                    echo '
                                <div class="reason-container">
                                    <input
                                        type="radio"
                                        name="reason"
                                        id="' . $report_reason['id'] . '"
                                        value="' . $report_reason['id'] . '"
                                        >
                                        <label for="' . $report_reason['id'] . '">
                                               ' . $report_reason['description'] . '
                                        </label>
                                </div>
                            ';
                }
                ?>

            </div>
            <div class="comments-container">
                <p>Leave a comment (Optional):</p>
                <textarea name="report-comment" id="" cols="30" rows="10"></textarea>
            </div>
        </form>

        <div class="report-submit-btn-container">
            <button class="btn" id="popup-report-cancel">Cancel</button>
            <button class="btn" id="popup-report-submit">Submit</button>
        </div>

    </div>

    <div class="popup-upload-file hidden">
        <h1>Upload Document</h1>
        <form action="">
            <input type="file">
            <div class="report-submit-btn-container">
                <button class="btn">Cancel</button>
                <input type="submit" class="btn" value="Submit">
            </div>
        </form>
    </div>

</div>


<?php MainNavbar::render($request); ?>

<div class="main-area-container">
    <div class="main-area">
        <h1 class="main-title"><?php echo $data['module_name'] . ' - ' . ucwords($data['class_type']) ?></h1>
        <h2 class="sub-title"><?php echo $data['subject_name'] ?></h2>
        <h3 class="tutor-name"><?php echo $data['tutor_name'] ?></h3>

        <div class="progress-bar-container">
            <h2>Progress</h2>
            <div class="progress-bar-outer">
                <div class="progress-bar-inner" style="width: <?php echo ($data['day_count'] !== 0 ? $data['incomplete_day_count'] * 100/$data['day_count'] : 0) . '%' ?>"></div>
            </div>
        </div>

        <div class="message-tutor-button-container">
            <button class="btn">Message Tutor</button>
        </div>


        <div class="class-card-container">
            <?php if (empty($data['days'])): ?>
                <div class="no-days-message-container">
                    <h2>Currently you have no days or activities available. <a href="<?php echo ' ' . URLROOT . '/student/chat' ?>"> Please contact you tutor</a></h2>
                </div>
            <?php else: ?>
                <?php foreach ($data['days'] as $day): ?>
                <div class="class-card">
                <div class="class-card-top-section">
                    <h2>Day <?php echo $day['position'] . ' - ' . $day['title'] ?></h2>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="" class="disabled-check-box"  <?php echo $day['is_completed'] == 1 ? 'checked' : ''?> disabled >
                        <span class="checkmark disabled"></span>
                    </label>
                </div>

                <div class="class-card-bottom-section">
                    <?php if(empty($day['activities'])): ?>
                        <p class="activity-component">No visible activities</p>
                    <?php else:?>
                        <?php foreach($day['activities'] as $activity): ?>
                            <div class="activity-row">
    <!--                            Just text-->
                                <?php if ($activity['type'] == 2): ?>
                                    <p class="activity-component"><?php echo $activity['description'] ?></p>

    <!--                               File upload - this is a dynamically created form -->
                                <?php elseif ($activity['type'] == 1): ?>
                                    <form class="file-upload-form" action="" id="assignment-submit-form-<?php echo $activity['id']?>" method="POST" enctype = "multipart/form-data">
                                        <label for="file-upload-<?php echo $activity['id']?>" class="file-upload-label activity-component">
                                            <?php echo $activity['description'] ?>
                                        </label>
                                        <input id="file-upload-<?php echo $activity['id']?>" class="file-upload-input" type="file" name="assignment-file" />

                                        <label class="custom-checkbox">
                                            <input type="checkbox" name="" class="disabled-check-box"  <?php echo $activity['is_completed'] == 1 ? "checked" : ""?> disabled>
                                            <span class="checkmark disabled"></span>
                                        </label>

    <!--                                    Hidden input filed for give the activity id-->
                                        <input type="hidden" name="activity-id" value="<?php echo $activity['id'] ?>">
                                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                    </form>

    <!--                               File download-->
                                <?php elseif ($activity['type'] == 0) : ?>
                                    <a href="<?php echo URLROOT . '/load-file?file=' . $activity['link']  ?>" class="activity-component"><?php echo $activity['description'] ?></a>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="" id="" <?php echo $activity['is_completed'] == 1 ? "checked" : ""?> >
                                        <span class="checkmark"></span>
                                    </label>

                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif ?>

        </div>


        <div class="bottom-button-container">
            <button class="btn" id="reshedule">Request Reschdule</button>
            <button class="btn" id="feeback">Give Feedback</button>
            <button class="btn" id="report-tutor-button">Report</button>
        </div>

    </div>
</div>

<?php Footer::render(
    [
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/tutor-profile.js',
        URLROOT . '/public/js/student/tutoring-class.js',
        URLROOT . '/public/js/student/tutoring-class-upload-assignment.js',
        URLROOT . '/public/js/student/tutor-report-handler.js'
    ]
);
?>

