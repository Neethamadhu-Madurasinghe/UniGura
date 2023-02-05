<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/newSubject.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/subject.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="div2">

        <div class="container">
            <h2>Subjects & Modules</h2><br><br>

            <div class="form">
                <div class="add-subject">
                    <input type="text" name="subjectName" placeholder="Type the Subject Name..." id="typeSubject">
                    <button type="submit" id="addSubject"><i class="fa-regular fa-plus"></i></button>
                </div>
            </div>

            <div class="subject_module_area">
                <?php
                foreach ($data[0] as $row1) {
                    echo "<div class='subject_module_box'>";
                    echo "<div class='subject'>";
                    echo "<div class='subject_name'>";
                    echo "<h3>" . $row1->name . "</h3>";
                    echo "</div>";
                    echo "<div class='actions'>";
                    echo "<div class='hide_show'>";

                    if ($row1->is_hidden == 1) {
                        echo "<div class='show_btn'>";
                        echo "<a href='../includes/updateSubject.inc.php?is_hidden=0&subject_id=" . $row1->id . "'><button class='show'>Show</button></a>";
                        echo "</div>";
                    }
                    if ($row1->is_hidden == 0) {
                        echo "<div class='hide_btn'>";
                        echo "<a href='../includes/updateSubject.inc.php?is_hidden=1&&subject_id=" . $row1->id . "'><button class='hide'>Hide</button></a>";
                        echo "</div>";
                    }


                    echo "</div>";
                    echo "<div class='edit'>";
                    echo "<a href='updateSubject.php?subject_id=" . $row1->id . "'><i class='fas fa-edit'></i></a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";


                    echo "<div class='module'>";
                    echo "<div class='drop_down_part'>";
                    echo "<div class='insert_module'>";
                    // echo "<form action='../includes/newModuleAdd.inc.php' method='POST'>";
                    echo "<input type='text' name='moduleName' placeholder='Type the Module Name...' class='typeModule'>";
                    echo "<input type='hidden' name='subject_id' class='subjectId' value='" . $row1->id . "'>";
                    echo "<button type='submit' class='addModule'><i class='fas fa-plus'></i></button>";
                    // echo "</form>";
                    echo "</div>";
                    echo "<div class='show_module'>";


                    // print_r($data[1][$row1->id]);
                    foreach ($data[1][$row1->id] as $row2) {
                        echo "<div class='module_loop'>";
                        echo "<div class='module_name'>";
                        echo "<input type='text' value='" . $row2->name . "' class='module_input_filed' disabled>";
                        echo "<input type='hidden' value='" . $row2->id . "' class='module_ID_filed'>";
                        echo "<input type='hidden' value='" . $row2->is_hidden . "' class='is_hidden_filed'>";
                        echo "</div>";
                        echo "<div class='actions'>";
                        echo "<div class='hide_show'>";
                        if ($row2->is_hidden == 1) {
                            echo "<div class='show_btn'>";
                            echo "<button class='show save showHideBtn'>Show</button>";
                            // echo "<a href='#'><button class='show'>Show</button></a>";
                            echo "</div>";
                        }
                        if ($row2->is_hidden == 0) {
                            echo "<div class='hide_btn'>";
                            echo "<button class='hide save showHideBtn'>Hide</button>";
                            // echo "<a href='#'><button class='hide'>Hide</button></a>";
                            echo "</div>";
                        }

                        echo "</div>";
                        echo "<div class='edit'>";
                        echo "<a href='#'><i class='fas fa-edit editModule edit_icon_js'></i></a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>
    </div>


</section>


</body>

</html>