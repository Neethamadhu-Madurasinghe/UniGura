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
        URLROOT . '/public/css/tutor/create-class-template.css'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>
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
                            <label for="class-type"> Type
                            </label>
                            <select name="class_type" id="type">
                                <option value="0">Theory</option>
                                <option value="1">Revision</option>
                                <option value="2">Paper</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="class-mode"> Preffered Mode </label>
                            <select name="mode" id="mode">
                                <option value="0">Physical</option>
                                <option value="1">Online</option>
                                <option value="2">Both</option>
                            </select>
                        </div>
                        <div class="form-field">
                        <label for="class-medium"> Medium </label>
                            <select name="medium" id="medium">
                                <option value="0">Sinhala</option>
                                <option value="1">English</option>
                                <option value="2">Tamil</option>
                            </select>
                        </div>
                        <div class="form-field">
                        <label for="class-duration"> Duration </label>
                            <select name="duration" id="duration">
                                <option value="0">2 hours</option>
                                <option value="1">4 hours</option>
                                <option value="2">6 hours</option>
                            </select>
                        </div>
                    </div>
                    <div id="submit-btn-container">
                        <input type="submit" value="create" class="btn">
                    </div>
                </div>




        </form>
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

    </div>



<?php Footer::render(
    []
); ?>