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
    'Delete Course',
    [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/tutor/forms.css?v=1.2'
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
        <p id = 'message' >You want to delete this Course</p>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name='id' id='id'>
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
    [URLROOT . '/public/js/tutor/deleteclasstemplate.js?v=1.2']
); ?>