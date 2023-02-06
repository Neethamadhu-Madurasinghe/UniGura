<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/common/inc/components/LandingPageNavBar.php';

$navbar = new LandingPageNavBar($request);

Header::render(
    'Complete Profile',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        //URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/report-problem.css',
    ]

);
?>


    <form action="" method="POST">
        <h1>Report a Problem</h1>
        <input type="radio" name="report" value="student">Student do not attend to class at time<br>
        <input type="radio" name="report" value="payments">Payments not done in time<br>
        <input type="radio" name="report" value="online">Online connectivity problems<br>
        <input type="radio" name="report" value="prank">Prank<br>
        <input type="radio" name="report" value="other">Other<br><br>

        <label for="description">Leave a Comment(Optional): </label><br><br>
        <textarea id="description" name="description" rows="5" cols="30"></textarea><br><br>

        <div class="create-btn">
            <input type="submit" id="cancel" value="Cancel">
            <input type="submit" id="submit" value="Submit">
        </div>

    </form>

<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js'
    ]
); ?>