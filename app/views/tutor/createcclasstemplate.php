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
        URLROOT . '/public/css/tutor/forms.css?v=1.1'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>


<div class="lightbox">
    <div class="box" style="top: 10%;">
        <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Create Course</h2>
        <button class="close"><i class="fa fa-times"></i></button>
        <span class="erorr"><?php echo $data['errors']['class_template_duplipate_error'] ?></span>
        <div class="form_container">
            <form action="" method="POST" enctype='multipart/form-data'>
                <div class="dropdown" style="margin-top: 0px;">
                    <div class="dropdown_name">
                        <label for="Subject">Subject</label>
                    </div>
                    <select name="subject" id="subject">
                        <?php
                        foreach ($data['subjects'] as $subject) {
                            echo '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="dropdown">
                    <div class="dropdown_name">
                        <label for="Lesson">Lesson</label>
                    </div>
                    <select name="module" class="tutor-filter filter-md" id="module">
                        <?php
                        foreach ($data['modules'] as $module) {
                            echo '<option value="' . $module['id'] . '">' . $module['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="dropdown">
                    <div class="dropdown_name">
                        <label for="Medium">Medium</label>
                    </div>
                    <select name="medium" id="medium">
                        <option value="Sinhala">Sinhala</option>
                        <option value="English">English</option>
                        <option value="Tamil">Tamil</option>
                    </select>
                </div>
                <div class="grid">
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
                            <option value="2">2 hours</option>
                            <option value="4">4 hours</option>
                            <option value="6">6 hours</option>
                        </select>
                    </div>

                </div>

                <div class="grid">
                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Mode">Mode</label>
                        </div>
                        <select name="mode" id="mode">
                            <option value="Physical">Physical</option>
                            <option value="Online">Online</option>
                            <option value="Both">Both</option>
                        </select>
                    </div>

                    <div class="dropdown">
                        <div class="dropdown_name">
                            <label for="Type">Type</label>
                        </div>
                        <select name="class_type" id="type">
                            <option value="Theory">Theory</option>
                            <option value="Revision">Revision</option>
                            <option value="Paper Class">Paper</option>
                        </select>
                    </div>

                </div>
                <input type="submit" value="Create" class="button">

            </form>

        </div>
        </form>


    </div>
    <script>
        const subjectUI = document.getElementById('subject');
        let moduleUI = document.getElementById('module');

        subjectUI.addEventListener('change', async (e) => {
            const respond = await fetch(`http://40.115.0.66/unigura/tutor/dashboard/api/modules?subject_id=${subjectUI.value}`);

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

        var closebtn = document.querySelector(".close");

        closebtn.addEventListener('click', function() {
            window.location = "http://40.115.0.66/unigura/tutor/dashboard";
        })

    </script>



    <?php Footer::render(
        []
    ); ?>