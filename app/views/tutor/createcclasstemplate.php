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
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/complete-profile.css',
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="main-area-container">
    <div class="main-area">
        <h1 class="main-title">Create Course</h1>
        <form action="" id="complete-profile-form" method="POST" enctype='multipart/form-data'>
            <div class="form first">
                <div class="form-main-area">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="subject-id">Subject
                            </label>
                            <input type="text" name="subject-id" id="" value="<?php echo $data['subject_id'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="module-id">Module
                            </label>
                            <input type="text" name="module_id" id="" value="<?php echo $data['module_id'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label for="account-name"> Rate
                            </label>
                            <input type="text" name="session_rate" id="" value="<?php echo $data['session_rate'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="branch"> Type
                            </label>
                            <input type="text" name="class_type" id="" value="<?php echo $data['class_type'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="Mode"> Mode
                            </label>
                            <input type="text" name="mode" id="" value="<?php echo $data['mode'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="Medium"> Medium
                            </label>
                            <input type="text" name="medium" id="" value="<?php echo $data['medium'] ?>">
                        </div>
                        <div class="form-field">
                            <label for="Duration"> Duration
                            </label>
                            <input type="text" name="duration" id="" value="<?php echo $data['duration'] ?>">
                        </div>
                    </div>
                <div id="submit-btn-container">
                    <input type="submit" value="create" class="btn btn-search">
                </div>
            </div>




        </form>

    </div>
</div>



<?php Footer::render(
    [

    ]
); ?>