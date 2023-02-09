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
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/create-class-template.css?v=1.1'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="main-area">
    <h1 class="main-title">Add Day</h1>
    <form action="" method="POST" enctype='multipart/form-data'>
        <div class="form-main-area">
            <input style="display:none" type="text" name="id" value='<?php echo $data['id'] ?>'>
            <div class="form-field">
                <label>Title<span><?php echo $data['errors']['title_error'] ?></span></label>
                <input type="text" name="title" value='<?php echo $data['title'] ?>'>
            </div>
            <div class="form-field">
                <label>Meeting Link</label>
                <input type="url" name="meeting_link" value='<?php echo $data['meeting_link'] ?>'>
            </div>
            <div class="form-field">
                <label>Position<span><?php echo $data['errors']['position_error'] ?></label>
                <input type="text" name="position" value='<?php echo $data['position'] ?>'>
            </div>
        </div>
        <div class="btn-container">
            <input type="submit" value="create" class="btn">
        </div>
    </form>
</div>


<?php Footer::render(
    []
); ?>