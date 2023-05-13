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
    'Delete Day',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/tutor/forms.css'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
    <div class="box" >
        <button class="close">
            <i class="fa fa-times"></i>
        </button>
        <i class="fa-solid fa-circle-exclamation" id="alert_icon"></i>
        <h2 id='heading' >Are You Sure?</h2>
        <p id = 'message' >You want to delete this Day</p>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name='id' id='id'>
                <input type="hidden" name='course_id' id='cid'>
                    <div class='btn_div'>
                        <button type="submit" class="yes">Yes</button>
                    </div>

            </form>

        </div>
    </div>
</div>

<script>

    let data_string = '<?php echo json_encode($data) ?>';
    let root = '<?php echo URLROOT ?>';
    
 
</script>

<?php Footer::render(
    [URLROOT . '/public/js/tutor/deleteday.js']
); ?>