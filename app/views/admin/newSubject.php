<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/subject.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/subject.js"></script>


<div class="blur-filter" id="blur-filter"></div>

<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="div2">

        <div class="container" id="container">
            <h2>Subjects & Modules</h2><br><br>

            <?php if ($data[2] == 'Duplicate entry') : ?>
                <div class="popup" id="popup">
                    <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
                    <h2>Duplicate Entry!</h2>
                    <h4>This subject name already exists.</h4>
                    <button type="button" id="closePopup">OK</button>
                </div>
            <?php elseif ($data[4] == 'minimum3Character') : ?>
                <div class="popup" id="popup">
                    <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
                    <h2>Invalid Subject Name!</h2>
                    <h4>Subject name must be at least 3 characters.</h4>
                    <button type="button" id="closePopup">OK</button>
                </div>
            <?php endif; ?>



            <?php if ($data[3] == 'Duplicate entry') : ?>
                <div class="popup" id="popup">
                    <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
                    <h2>Duplicate Entry!</h2>
                    <h4>This module name already exists.</h4>
                    <button type="button" id="closePopup">OK</button>
                </div>
            <?php elseif ($data[5] == 'minimum3Character') : ?>
                <div class="popup" id="popup">
                    <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
                    <h2>Invalid Module Name!</h2>
                    <h4>Module name must be at least 3 characters.</h4>
                    <button type="button" id="closePopup">OK</button>
                </div>
            <?php endif; ?>



            <div class="form">
                <form class="add-subject" action="addSubject" method="POST">
                    <input type="text" name="subjectName" placeholder="Type the Subject Name..." id="typeSubject">
                    <button type="submit" id="addSubject"><i class="fa-regular fa-plus"></i></button>
                </form>
            </div>


            <div class="subject_module_area">
                <?php foreach ($data[0] as $row1) : ?>
                    <div class='subject_module_box'>
                        <div class='subject'>
                            <div class='actions'>

                                <div class="hide-show">
                                    <?php if ($row1->is_hidden == 1) : ?>
                                        <a href='updateSubjectHideShow?is_hidden=0&subject_id=<?php echo $row1->id ?>'><button class='show_btn'>Show</button></a>
                                    <?php endif; ?>
                                    <?php if ($row1->is_hidden == 0) : ?>
                                        <a href='updateSubjectHideShow?is_hidden=1&subject_id=<?php echo $row1->id ?>'><button class='hide_btn'>Hide</button></a>
                                    <?php endif; ?>
                                </div>

                                <form action='updateSubject' method='POST'>
                                    <input type="text" value="<?php echo $row1->name ?>" disabled class='subject_name_filed' name="subject_name">
                                    <input type='hidden' value='<?php echo $row1->id ?>' name='subject_id'><br>
                                    <a href="#" class="editSubject"><i class="fa fa-light fa-edit"></i> Edit</a>
                                    <div class='save-cancel-subject'>
                                        <button type='submit'><i class='fa fa-light fa-save'></i> Save</button>
                                        <a href='#' class='cancel_btn_js'><i class='fa fa-light fa-times'></i> Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class='module'>
                            <div class='drop_down_part'>
                                <div class='insert_module'>
                                    <form action='addModule' method='POST'>
                                        <input type='text' name='moduleName' placeholder='Type the Module Name...' class='typeModule'>
                                        <input type='hidden' name='subject_id' class='subjectId' value="<?php echo $row1->id ?>">
                                        <button type='submit' class='addModule'><i class='fas fa-plus'></i></button>
                                    </form>
                                </div>
                                <div class='show_module'>
                                    <!-- // print_r($data[1][$row1->id]); -->
                                    <?php foreach ($data[1][$row1->id] as $row2) : ?>
                                        <div class='module_loop'>
                                            <form action="updateModule" method="POST">
                                                <div class='module_name'>
                                                    <div class="action">
                                                        <input type='text' value="<?php echo $row2->name ?>" class='module_input_filed' disabled name="module_name">
                                                        <input type='hidden' value="<?php echo $row2->id ?>" class='module_ID_filed' name='module_id'>
                                                        <a href='#'><i class='fas fa-edit editModule'></i></a>
                                                        <div class='save-cancel-module'>
                                                            <button type='submit'><i class='fa fa-light fa-save'></i></button>
                                                            <a href='#' class='cancel-module'><i class='fa fa-light fa-times'></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class='hide_show'>
                                                <?php if ($row2->is_hidden == 1) : ?>
                                                    <div class='show_btn'>
                                                        <a href='updateModuleHideShow?is_hidden=0&module_id=<?php echo $row2->id ?>'><button class='show'>Show</button></a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($row2->is_hidden == 0) : ?>
                                                    <div class='hide_btn'>
                                                        <a href='updateModuleHideShow?is_hidden=1&module_id=<?php echo $row2->id ?>'><button class='hide'>Hide</button></a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</section>
</body>

</html>