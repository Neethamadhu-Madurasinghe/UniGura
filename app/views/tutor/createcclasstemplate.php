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
                            <select name="subject" class="tutor-filter filter-sm" id="subject">
                                <?php
                                foreach ($data['subjects'] as $subject) {
                                    echo '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="account-name"> Module
                            </label>
                            <select name="module" class="tutor-filter filter-md" id="module">
                                <?php
                                foreach ($data['modules'] as $module) {
                                    echo '<option value="' . $module['id'] . '">' . $module['name'] . '</option>';
                                }
                                ?>
                            </select>
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
        <script>
            const subjectUI = document.getElementById('subject');
            let moduleUI = document.getElementById('module');

            subjectUI.addEventListener('change', async (e) => {
                const respond = await fetch(`http://localhost/unigura/api/modules?subject_id=${subjectUI.value}`)
                if (respond.status == 200) {
                    const result = await respond.json();
                    if (result.modules) {
                        const optionsUI = moduleUI.getElementsByTagName("option");
                        while (optionsUI.length > 0) {
                            moduleUI.removeChild(optionsUI[0]);
                        }
                        result.modules.forEach(module => {
                            const optionUI = document.createElement("option");
                            optionUI.value = module.id; // set the value of the option
                            optionUI.text = module.name;
                            moduleUI.add(optionUI);
                        });
                        filterValues.module = moduleUI.value;
                    }
                }

            });
        </script>

    </div>
</div>



<?php Footer::render(
    []
); ?>