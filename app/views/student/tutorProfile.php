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
require_once APPROOT . '/views/student/inc/components/TutoringClassReviewCard.php';


Header::render(
    'Find Tutuor',
    [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/student/components/error-success-popup.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/components/timetable.css',
        URLROOT . '/public/css/student/components/tutoring-class-reivew-card.css',
        URLROOT . '/public/css/student/tutor-profile.css'
    ]
);

?>

<div
        class="invisible"
        id="template-data"
        data-mode="<?php echo $data['mode'] ?>"
        data-tutor="<?php echo $data['tutor_id'] ?>"
        data-template="<?php echo $data['template_id'] ?>"
        data-duration="<?php echo $data['duration'] ?>"></div>

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

<div class="layout-background invisible">

    <div class="popup-select-mode invisible">
        <h2>Select Preferred Class Method</h2>
        <div class="select-mode-container">
            <?php
                if ($data['mode_on_template'] == 'both') {
                    echo '
                        <input type="radio" name="mode" id="class-mode" value="online" checked="true">
                        <label for="class-mode">Online</label>
                        <input type="radio" name="mode" id="class-mode" value="physical">
                        <label for="class-mode">Physical</label>
                    ';
                } else if($data['mode_on_template'] == 'online') {
                    echo '
                        <input type="radio" name="mode" id="class-mode" value="online" checked="true">
                        <label for="class-mode">Online</label>
                    ';
                } else {
                    echo '
                        <input type="radio" name="mode" id="class-mode" value="physical">
                        <label for="class-mode">Physical</label>
                    ';
                }
            ?>
        </div>
        <div class="select-mode-button-container">
            <button class="btn btn-sm" id="mode-cancel">Cancel</button>
            <button class="btn btn-sm" id="mode-ok">OK</button>
        </div>
    </div>

    <div class="popup-tutor-other-class invisible">
        <h2>Other Classes</h2>
        <div class="other-class-container">

            <?php
                foreach ($data['other_classes'] as $otherClass) {
                    echo '
                        <div class="other-class-card">
                            <div class="icon-container">
                                <object data="assests/Paper_Plus.svg" type=""></object>
                            </div>
                            <a class="other-class-link" href="/student/tutor-profile?template_id=' . $otherClass['id']  . '">
                                <p>'
                                    . $otherClass['subject_name']
                                    . ' - '
                                    . $otherClass['module_name']
                                    . ' (' . $otherClass['mode_display'] . ')' .
                                '</p>
                            </a>
                        </div>
                    ';
                }

            ?>

        </div>

        <button class="btn btn-cancel" id="other-class-cancel">Cancel</button>
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

</div>

<?php MainNavbar::render($request); ?>

<div class="main-area-container">
    <div class="main-area">

        <div class="top-section">

            <div class="tutor-profile-pic-container">
                <img src="<?php echo URLROOT . $data['profile_picture']?>" alt="">
            </div>

            <div class="tutor-details-container">
                <div class="tutor-details-heading-container">
                    <h1><?php echo $data['module_name'] . " " . $data['class_type'] ?> <small>By</small></h1>
                    <h1><?php echo $data['name'] ?></h1>
                </div>
                <div class="toast-container">
                    <div class="toast"><?php echo $data['education_qualification']; ?></div>
                    <div class="toast"><?php echo $data['city']; ?></div>
                    <div class="toast"><?php echo $data['duration'] . " hours per session"; ?></div>
                    <div class="toast"><?php echo $data['number_of_days'] . " Days"; ?></div>
                    <div class="toast"><?php echo "Total " .
                            $data['number_of_days'] * $data['session_rate'] .
                            " LKR"; ?>
                    </div>
                </div>
                <div class="price-box">
                    <h2><?php echo $data['session_rate']?> LKR</h2>
                    <h4>Per Hour</h4>
                </div>
            </div>

            <div class="buttons-container">
                <button class="btn btn-tutor-main" id="tutor-request-send">Send Tutor Request</button>
                <button class="btn btn-tutor-main "><a href="http://40.115.0.66/student/chat" style="text-decoration: none; color:white">Message Tutor</a></button>
                <button class="btn btn-tutor-main" id="report-tutor-button">Report</button>
                <button class="btn btn-tutor-main" id="other-classes-button">Other Classes</button>
            </div>
        </div>

        <div class="middle-section">
            <p><?php echo $data['description']?></p>

            <div class="pop-time-table">
                <h1>Select time slots</h1>

                <div class="time-table-container">
                    <table id="time-table">
                        <caption class="invisible"></caption>
                        <th></th>
                        <!-- Time slot data goes here -->
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="bottom-main-area">
    <div class="bottom-section-title-header">
        <h1>Reviews</h1>
        <div>
            <i class="fa-solid fa-star"></i>
            <h2><?php echo $data['current_rating'] ?></h2>
        </div>
    </div>

    <?php
        foreach ($data['reviews'] as $review) {
            TutoringClassReviewCard::render($review);
        }
    ?>

</div>

<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/student/tutor-profile.js',
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/profile-timetable-handler.js',
        URLROOT . '/public/js/student/other-classes-handler.js',
        URLROOT . '/public/js/student/tutor-report-handler.js',
        URLROOT . '/public/js/student/tutor-request-handler.js'
    ]
);
?>

