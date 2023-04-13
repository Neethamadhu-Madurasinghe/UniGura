<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/newSubject.css">
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

            <?php if (isset($data[2])) : ?>
                <?php if ($data[2] == 'Duplicate entry') : ?>
                    <div class="popup" id="popup">
                        <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
                        <h2>Duplicate Entry!</h2>
                        <h4>This subject name already exists.</h4>
                        <button type="button" id="closePopup">OK</button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


            <?php if (isset($data[3])) : ?>
                <?php if ($data[3] == 'Duplicate entry') : ?>
                    <div class="popup" id="popup">
                        <img src="<?php echo URLROOT ?>/public/img/admin/duplicate-entry-warning.png" alt="">
                        <h2>Duplicate Entry!</h2>
                        <h4>This module name already exists.</h4>
                        <button type="button" id="closePopup">OK</button>
                    </div>
                <?php endif; ?>
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
                                    <a href="#" class="edit_icon_js"><i class="fa fa-light fa-edit"></i> Edit</a>
                                    <div class='save-cancel'>
                                        <button type='submit'><i class='fa fa-light fa-save'></i> Save</button>
                                        <a href='#' class='cancel_btn_js'><i class='fa fa-light fa-times'></i> Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class='module'>
                            <div class='drop_down_part'>
                                <div class='insert_module'>
                                    <!-- <form action='../includes/newModuleAdd.inc.php' method='POST'> -->
                                    <input type='text' name='moduleName' placeholder='Type the Module Name...' class='typeModule'>
                                    <input type='hidden' name='subject_id' class='subjectId' value='" . $row1->id . "'>
                                    <button type='submit' class='addModule'><i class='fas fa-plus'></i></button>
                                    <!-- // echo " -->
                                    <!-- </form>"; -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


</section>


</body>

</html>