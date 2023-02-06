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
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/tutor/course.css?v=1.2'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>
<div class="main-area">
    <div class="header">
        <h1><?php echo $data['module'] ?></h1>
        <div class="subhead">
            <p><?php echo $data['subject'] ?></p>
            <p><i class="fa-solid fa-chalkboard"></i> Online </p>
        </div>
    </div>
    <div class="body">

    </div>
    <div class="add-day">

    </div>
</div>



<?php Footer::render(
    []
); ?>