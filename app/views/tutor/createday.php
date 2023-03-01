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
        URLROOT . '/public/css/tutor/forms.css?v=1.7'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
    <div class="box">
        <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Add Day</h2>
        <button class="close"><i class="fa fa-times"></i></button>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="grid-plane">
                <input style="display:none" type="text" name="id" value='<?php echo $data['id'] ?>'>
                <input style="display:none" type="text" name="position" value='<?php echo $data['position'] ?>'>
                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Session Fee">Heading</label><br>
                            <span><?php echo $data['errors']['title_error'] ?></span>
                        </div>
                        <input type="text" name="title" value='<?php echo $data['title'] ?>'>
                    </div>
                </div>
                <button type="submit">Create</button>
            </form>
        </div>
    </div>
</div>

    <?php Footer::render(
        []
    ); ?>