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
        // URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/create-course.css',
    ]
);
?>

<?php
// echo '<pre>';
// print_r($data);
// echo '</pre>';

?>


<form action="storeData" method="POST">
    <h1>Create Course</h1>
    <label for="subject">Subject</label><br>
    <select id="subject" name="subject">
        <?php foreach($data as $aSubject) { ?>
            <option> <?php echo $aSubject->name ?></option>
        <?php } ?>
    </select><br><br>

    <label for="lesson">Lesson</label><br>
    <select id="lesson" name="lesson">
        <option>x</option>
        <option>y</option>
        <option>z</option>
        <option>k</option>
        <option>m</option>
    </select> <br><br>

    <label for="fee">Session Fee</label><br>
    <input type="number" name="sessionfee" id="sessionfee"><br><br>

    <label for="mode">Mode</label><br>
    <select name="mode" id="mode">
        <option>Online</option>
        <option>Physical</option>
        <option>Both</option>
    </select> <br><br>

    <label for="type">Type</label><br>
    <select name="type" id="type">
        <option>Theory</option>
        <option>Revision</option>
        <option>Paper Class</option>
    </select> <br><br>

    <label for="medium">Medium</label><br>
    <select name="medium" id="medium">
        <option>Sinhala</option>
        <option>English</option>
    </select> <br><br>

    <label for="duration">Duration per Session</label><br>
    <input type="number" name="duration" id="duration"><br><br>


    <div class="create-btn">
        <input type="submit" value="Create">
    </div>

</form>
