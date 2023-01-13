<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/newSubject.css">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Uni-Gura Subject</title>
</head>

<body>
    <div class="div2">

        <div class="container">
            <h2>Add New Subject</h2><br><br>

            <div class="form">
                <div class="add-subject">
                    <label for="">Subject Name<span> *
                            <?php
                            if (isset($_GET['error'])) {
                                if ($_GET['error'] == "inputsEmpty") {
                                    echo "Fill the fields";
                                }
                            }
                            ?>
                        </span></label>
                    <br>
                    <input type="text" name="subjectName" placeholder="Type the Subject Name..." id="typeSubject">
                    <br><br>
                    <button type="submit" id="addSubject"><i class="fa-regular fa-plus"></i>Subject</button>
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

                    echo "<hr>";

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

</body>

</html>