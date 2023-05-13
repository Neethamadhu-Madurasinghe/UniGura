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
    'Update Day',
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
        <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Update Day</h2>
        <button class="close"><i class="fa fa-times"></i></button>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="grid-plane">
                <input type="hidden" name='id' id='id'>
                <input type="hidden" name='course_id' id='cid'>
                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Session Fee">Heading</label><br>
                            <span><?php echo $data['errors']['title_error'] ?></span>
                        </div>
                        <input type="text" name="title" id='title'>
                    </div>
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    let data_string = '<?php echo json_encode($data) ?>';
    let root = '<?php echo URLROOT ?>';
</script>

    <?php Footer::render(
        [URLROOT . '/public/js/tutor/updateday.js']
    ); ?>