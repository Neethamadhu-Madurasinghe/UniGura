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
    'Report Problem',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        //URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/report-problem.css',
    ]

);

?>


    <form action="report-problem" method="POST">
        <h1>Report a Problem</h1>
        <input type="radio" name="report" value="Student do not attend to class at time"> Student do not attend to class at time<br>
        <input type="radio" name="report" value="Payments not done in time"> Payments not done in time<br>
        <input type="radio" name="report" value="Online connectivity problems"> Online connectivity problems<br>
        <input type="radio" name="report" value="Prank"> Prank<br>
        <input type="radio" name="report" value="Other"> Other<br><br>

        <label for="description">Leave a Comment(Optional): </label><br><br>
        <textarea id="description" name="description" rows="5" cols="30"></textarea><br><br>

        <div class="create-btn">
            <button type="submit" id="cancel"><a href="#">Cancel</a></button>
            <button type="submit" id="submit"><a href="#">Submit</a></button>
        </div>

    </form>

    <script>
        submit.addEventListener('click',function(){

        })
    </script>


 <?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
        
    ]
); ?>