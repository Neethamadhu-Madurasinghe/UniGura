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
    'Find Tutuor',
    [
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/tutoring-class.css'
    ]
);

?>

<div class="layout-background hidden">

    <div class="popup-request-send-success hidden">
        <object data="assests/success.svg" type=""></object>
        <p>Reshedule Request has been Sent Successfully</p>
        <button class="btn btn-search">OK</button>
    </div>

    <div class="pop-time-table hidden">
        <h1>Request a Resheduling</h1>

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

    <div class="popup-report hidden">
        <h1>Report a Problem</h1>
        <form action="">
            <div class="report-reason-container">
                <div class="reason-container">
                    <input type="checkbox" name="" id=""><p>Tutor does not conduct class anymore</p>
                </div>
                <div class="reason-container">
                    <input type="checkbox" name="" id=""><p>Content is not as good as marketed</p>
                </div>
                <div class="reason-container">
                    <input type="checkbox" name="" id=""><p>Harrestment</p>
                </div>
                <div class="reason-container">
                    <input type="checkbox" name="" id=""><p>Problamatic profile picture</p>
                </div>
            </div>
            <div class="comments-container">
                <p>Leave a comment (Optional):</p>
                <textarea name="" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="report-submit-btn-container">
                <button class="btn"  id="report-cancel">Cancel</button>
                <button class="btn">Submit</button>
            </div>
        </form>

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
        <h1 class="main-title">Mechanics Theory</h1>
        <h2 class="sub-title">Physics</h2>
        <h3 class="tutor-name">John Joe</h3>

        <div class="progress-bar-container">
            <h2>Progress</h2>
            <div class="progress-bar-outer">
                <div class="progress-bar-inner"></div>
            </div>
        </div>

        <div class="message-tutor-button-container">
            <button class="btn">Message Tutor</button>
        </div>


        <div class="class-card-container">

            <div class="class-card">
                <div class="class-card-top-section">
                    <h2>Day 1 - Newton Laws</h2>
                    <input type="checkbox" name="" id="">
                </div>

                <div class="class-card-bottom-section">
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Questionsr</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
            </div>

            <div class="class-card">
                <div class="class-card-top-section">
                    <h2>Day 1 - Newton Laws</h2>
                    <input type="checkbox" name="" id="">
                </div>

                <div class="class-card-bottom-section">
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Questionsr</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
            </div>


            <div class="class-card">
                <div class="class-card-top-section">
                    <h2>Day 1 - Newton Laws</h2>
                    <input type="checkbox" name="" id="">
                </div>

                <div class="class-card-bottom-section">
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Questionsr</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Questionsr</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
            </div>

            <div class="class-card">
                <div class="class-card-top-section">
                    <h2>Day 1 - Newton Laws</h2>
                    <input type="checkbox" name="" id="">
                </div>

                <div class="class-card-bottom-section">
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Questionsr</p>
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="activity-row">
                        <p>Newton Laws Tutor</p>
                        <input type="checkbox" name="" id="">
                    </div>
                </div>
            </div>

        </div>


        <div class="bottom-button-container">
            <button class="btn" id="reshedule">Request Reschdule</button>
            <button class="btn" id="feeback">Give Feedback</button>
            <button class="btn" id="report">Report</button>
        </div>

    </div>
</div>

<?php Footer::render(
    [
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/tutoring-class.js',
    ]
);
?>

