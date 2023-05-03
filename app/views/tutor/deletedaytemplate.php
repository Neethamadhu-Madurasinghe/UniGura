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
        URLROOT . '/public/css/tutor/forms.css?v=1.1'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
    <div class="box" style="width: 30%; margin-left: 35%;">
        <i class="fa-solid fa-circle-exclamation" id="alert_icon"></i>
        <h2 style="text-align: center;width: 100%;padding-bottom: 0px; font-weight: 400;">Are You Sure?</h2>
        <p style="text-align: center;margin-bottom: 0px;">You want to delete this Day</p>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name='id' value="<?php echo $data['id'] ?>">
                <input type="hidden" name='course_id' value="<?php echo $data['course_id'] ?>">
                <div>
                    <div class="grid" style="margin-top: 0px;">
                        <div class="dropdown">
                            <button class="no">Cancle</button>
                        </div>

                        <div class="dropdown">
                            <button type="submit" class="yes">Delete</button>
                        </div>

                    </div>

                </div>


            </form>

        </div>
    </div>
</div>

<?php Footer::render(
    []
); ?>