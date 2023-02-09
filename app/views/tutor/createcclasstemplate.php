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
        URLROOT . '/public/css/tutor/create-class-template.css?v=1.1'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>
<div class="main-area">
    <h1 class="main-title">Create Course</h1>
    <span><?php echo $data['errors']['class_template_duplipate_error'] ?></span>
    <form action="" method="POST" enctype='multipart/form-data'>
        <div class="form-main-area">
            <div class="form-field">
                <label for="subject-id">Subject</label>
                <select name="subject" id="subject">
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
            <div class="form-field">
                <label for="class-duration"> Duration </label>
                <select name="duration" id="duration">
                    <option value="2">2 hours</option>
                    <option value="4">4 hours</option>
                    <option value="6">6 hours</option>
                </select>
            </div>
            <div class="form-field">
                <label for="account-name"> Rate (Per Session)
                    <span><?php echo $data['errors']['session_rate_error'] ?></span>
                </label>
                <input type="text" name="session_rate" id="" value="<?php echo $data['session_rate'] ?>">
            </div>
            <div class="form-field">
                <label for="class-type"> Type
                </label>
                <select name="class_type" id="type">
                    <option value="Theory">Theory</option>
                    <option value="Revision">Revision</option>
                    <option value="Paper Class">Paper</option>
                </select>
            </div>
            <div class="form-field">
                <label for="class-mode"> Preferred Mode </label>
                <select name="mode" id="mode">
                    <option value="Physical">Physical</option>
                    <option value="Online">Online</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="form-field">
                <label for="class-medium"> Medium </label>
                <select name="medium" id="medium">
                    <option value="Sinhala">Sinhala</option>
                    <option value="English">English</option>
                    <option value="Tamil">Tamil</option>
                </select>
            </div>
            
        </div>
        <div class="btn-container">
            <input type="submit" value="Create" class="btn">
        </div>





    </form>


</div>
<script>
    const subjectUI = document.getElementById('subject');
    let moduleUI = document.getElementById('module');

    subjectUI.addEventListener('change', async (e) => {
        const respond = await fetch(`http://localhost/unigura/tutor/dashboard/api/modules?subject_id=${subjectUI.value}`);

        console.log('done', respond.status);
        if (respond.status == 200) {
            const result = await respond.json();
            console.log(result)
            if (result) {
                console.log('Modules ok')
                const optionsUI = moduleUI.getElementsByTagName("option");
                while (optionsUI.length > 0) {
                    moduleUI.removeChild(optionsUI[0]);
                }
                result.forEach(module => {
                    const optionUI = document.createElement("option");
                    optionUI.value = module.id; // set the value of the option
                    optionUI.text = module.name;
                    moduleUI.add(optionUI);
                });

            }
        }

    });
</script>



<?php Footer::render(
    []
); ?>