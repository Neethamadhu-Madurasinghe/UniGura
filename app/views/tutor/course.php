<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';


Header::render(
    'Create Class',
    [

        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/tutor/course.css?v=1.8'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);


?>




<div>
    <div class="part_two">
        <div class="Student">
            <div class="close" id='close-course'><i class="fa fa-times"></i></div>
            <h1 id='module'></h1>

            <div class="details">
                <div class="subject">
                    <span><i class="fa-solid fa-graduation-cap"></i></span>
                    <span id='subject'></span>
                </div>
                <div class="mode">
                    <span><i class="fa-solid fa-brands fa-chromecast"></i></span>
                    <span id='mode'></span>
                </div>
            </div>

            <div class="button-container">
                <div class="button1"> Add Day </div>
                <div class="button2" id='publish'></div>
            </div>

            <div class="day_box_container">
                <div class="half" id="sortable">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="popup">
    <div id="popup-content">
        <button id="close-btn" class='close'><i class="fa fa-times"></i></button>
        <div id='message'>Class Publish Success Message</div>
    </div>
</div>

<script>
    // Fetching Backend Data

    let root = '<?php echo URLROOT ?>';
    let data_string = '<?php echo json_encode($data) ?>';
</script>

<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/course.js'
    ]
); ?>