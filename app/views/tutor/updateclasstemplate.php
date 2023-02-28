<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/tutor/inc/components/MainNavbar.php';

Header::render(
    'Tutor Dashboard',
    [
        URLROOT . '/public/css/tutor/base.css?v=1.0',
        URLROOT . '/public/css/tutor/dashboard.css?v=1.8'
    ]
);

MainNavbar::render($request);
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
        URLROOT . '/public/css/tutor/forms.css?v=1.1'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
    <div class="box" style="top: 10%;">
        <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Update Course</h2>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="grid">
                <input type="hidden"  name="id" id="" value="<?php echo $data['id'] ?>">
                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Session Fee">Session Fee</label><br>
                        </div>
                        <input type="text" name="session_rate" id="" value="<?php echo $data['session_rate'] ?>">
                        <span><?php echo $data['errors']['session_rate_error'] ?></span>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Duration">Duration per Session</label>
                        </div>

                        <select name="duration" id="duration">
                            <?php
                            $duration_array = array(2, 4, 6);
                            $selected_duration= $data['duration'];

                            echo "<option value=$selected_duration>$selected_duration Hours</option>";
                            for ($i = 0; $i < count($duration_array); $i++) {
                                if ($duration_array[$i] !== $selected_duration) {
                                    echo "<option value='$duration_array[$i]'>$duration_array[$i] Hours</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Mode">Mode</label>
                        </div>
                        <select  name="mode" id="mode">
                            <?php
                            $mode_array = array("Physical", "Online", "Both");
                            $selected_mode= $data['mode'];

                            echo "<option value=$selected_mode>$selected_mode</option>";
                            for ($i = 0; $i < count($mode_array); $i++) {
                                if ($mode_array[$i] !== $selected_mode) {
                                    echo "<option value='$mode_array[$i]'>$mode_array[$i]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" value="Update" class="button">
            </form>
        </div>
        </form>
    </div>

    <?php Footer::render(
        []
    ); ?>