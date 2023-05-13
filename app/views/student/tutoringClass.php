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
require_once APPROOT . '/views/student/inc/components/TutoringClassDay.php';


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
        data-classid="<?php echo $data['id'] ?>"
        data-tutor="<?php echo $data['tutor_id'] ?>"
        data-duration="<?php echo $data['duration'] ?>"
        data-template="<?php echo $data['class_template_id'] ?>"
        ></div>

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
        <h1>Rescheduling Class</h1>

        <div class="time-table-container">
            <table id="time-table">
                <caption class="invisible"></caption>
                <th></th>
                <!-- Time slot data goes here -->
            </table>
        </div>

        <div class="popup-button-container">
            <button class="btn btn-search" id="time-table-cancel">Cancel</button>
            <button class="btn btn-search" id="reschedule-send">Reschedule</button>
        </div>

    </div>


    <div class="popup-feedback-form hidden">
        <h1>Post a review</h1>
        <div class="feedback-star-container">
            <img id="star-1" class="star" src="<?php echo URLROOT . '/public/img/student/big.png' ?>" alt="" srcset="">
            <img id="star-2" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
            <img id="star-3" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
            <img id="star-4" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
            <img id="star-5" class="star" src="<?php echo URLROOT . '/public/img/student/star_inactive.png' ?>" alt="" srcset="">
        </div>
        <div class="comments-container">
            <p>Leave a comment (Optional):</p>
            <textarea name="" id="feedback-input" cols="30" rows="10"></textarea>
        </div>

        <div class="submit-btn-container">
            <button class="btn" id="feedback-cancel">Cancel</button>
            <button class="btn" id="feedback-ok">Submit</button>
        </div>
    </div>

    <div class="popup-send-message invisible">
        <p id="success-message">Send a message</p>
        <textarea id="msg-input"></textarea>
        <div class="send-msg-btn-container">
            <button class="btn btn-msg" id="msg-cancel">Cancel</button>
            <button class="btn btn-msg" id="msg-send">OK</button>
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

    <div class="popup-tutor-details invisible">
        <div class="popup-img-container">
            <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>">
        </div>
        <div class="popup-tutor-detail-container">
            <h1>Your name</h1>
            <h2>City</h2>
            <h2>Rating: 10</h2>
            <button class="btn" id="tutor-detail-close-btn">Close</button>
        </div>
    </div>

</div>


<?php MainNavbar::render($request); ?>

<div class="main-area-container">
    <div class="main-area">
        <h1 class="main-title"><?php echo $data['subject_name'] ?> <?php echo $data['module_name'] . ' - ' . ucwords($data['class_type']) ?></h1>
        <h3 class="sub-title">By <?php echo $data['tutor_name'] ?></h3>
        <h3 class="tutor-name">Date and time: <?php echo $data['date'] . ' @ ' . $data['time'] . ' (' . ($data['mode'] == 'physical' ? 'Physical' : 'Online') . ')' ?></h3>

        <div class="progress-bar-container">
            <h2>Completed <?php echo ($data['day_count'] !== 0 ? round($data['incomplete_day_count'] * 100/$data['day_count']) : 0) . '%' ?></h2>
            <div class="progress-bar-outer">
                <div class="progress-bar-inner" style="width: <?php echo ($data['day_count'] !== 0 ? $data['incomplete_day_count'] * 100/$data['day_count'] : 0) . '%' ?>"></div>
            </div>
        </div>

        <div class="message-tutor-button-container">
            <button class="btn quick-message-btn" >Message Tutor</button>
            <button class="btn" id="tutor-detail-btn">See tutor details</button>
        </div>


        <div class="class-card-container">
            <?php if (empty($data['days'])): ?>
                <div class="no-days-message-container">
                    <h2>Currently you have no days or activities available. <a href="<?php echo ' ' . URLROOT . '/student/chat' ?>"> Please contact you tutor</a></h2>
                </div>
            <?php else: ?>
                <?php
                    foreach ($data['days'] as $day) {
                        TutoringClassDay::render($day, $data);
                    }
                ?>
            <?php endif ?>

        </div>


        <div class="bottom-button-container">
            <button class="btn" id="reschedule">Reschedule</button>
            <button class="btn" id="feedback">Give Feedback</button>
            <button class="btn" id="report-tutor-button">Report Tutor</button>
        </div>

    </div>
</div>

<?php Footer::render(
    [
        'https://www.payhere.lk/lib/payhere.js',
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/tutor-profile.js',
        URLROOT . '/public/js/student/tutoring-class.js',
        URLROOT . '/public/js/student/tutoring-class-upload-assignment.js',
        URLROOT . '/public/js/student/tutor-report-handler.js',
        URLROOT . '/public/js/student/tutor-feedback.js',
        URLROOT . '/public/js/student/reschedule-handler.js',
        URLROOT . '/public/js/student/send-quick-message.js',
        URLROOT . '/public/js/student/payment.js',
        URLROOT . '/public/js/student/tutor-profile-popup.js'
    ]
);
?>

