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

        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/tutor/course.css?v=1.7'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);


?>




<div>
    <div class="part_two">
        <div class="Student">
            <h1 id='module' style="margin-bottom: 0px;text-align: center;font-weight: 400;"><?php echo $data['module'] ?></h1>
            <div style="display: grid;grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="color: #7b7f8f;text-align: right;margin-top: px;font-size: 17px;">
                    <span><i class="fa-solid fa-graduation-cap"></i></span><span id='subject'><?php print_r($data['subject']) ?></span>
                </div>
                <div style="color: #7b7f8f;text-align: left;margin-top: px;font-size: 17px;">
                    <span><i class="fa-solid fa-brands fa-chromecast"></i></span> <?php print_r($data['mode']) ?>
                </div>
            </div>
            <div class="button-container">
                <div class="button1">
                    <?php echo '<a  href= /unigura/tutor/createday?class_template_id=' . $data["id"] .  '&subject=' . $data['subject'] . '&module=' . $data['module'] . '><i class="fa-solid fa-plus"></i> Add Day</a>' ?>
                </div>
                <div class="button2">
                    <?php echo '<a  href= /unigura/tutor/dashboard><i class="fa-solid fa-home"></i> Home</a>' ?>
                </div>
            </div>

            <div class="day_box_container">
                <div class="half" id="sortable">

                    <?php
                    $days = json_decode($data['days']);

                    foreach ($days as $day) {
                        $array = (array) $day;
                        $id = (int) $array['id'];
                        $title = (string) $array['title'];
                        $position = (string) $array['position'];

                        echo "
                    <div class='day' draggable='true' id = $id>
                    <div class='day_box' style='margin-top: 0px;'>
                        <div style='display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid rgba(112, 124, 151, 0.151);padding-bottom: 5px;'>
                            <h4>$title</h4>
                        </div>
                        <div class='textbox_one' data-id = $id>
                        </div>
                    </div>
                    <div class='button_box'>
                        <div></div>
                        <div></div>
                        <button class='left add-activity' id=$id ><i class='fa-solid fa-plus'></i></button>
                        <button class='middle update-day' id = $id><i class='fa-solid fa-pen'></i></button>
                        <button class='right delete-day' id = $id><i class='fa-solid fa-trash'></i></button>
                    </div>
                </div>";
                    }
                    ?>
                </div>
            </div>

            <script>
                var draggableItems = document.querySelectorAll("#sortable .day");
                var draggingItem = null;
                var originalIndex = null;

                // Define a data object to store the position of the elements
                var positionData = {};

                // Initialize the data object with the initial position of the elements
                for (var i = 0; i < draggableItems.length; i++) {
                    positionData[draggableItems[i].id] = i + 1;
                }

                for (var i = 0; i < draggableItems.length; i++) {
                    draggableItems[i].addEventListener("dragstart", function(e) {
                        draggingItem = this;
                        originalIndex = Array.prototype.indexOf.call(this.parentNode.children, this);
                    });

                    draggableItems[i].addEventListener("dragover", function(e) {
                        e.preventDefault();
                        this.style.backgroundColor = "lightgray";
                    });

                    draggableItems[i].addEventListener("dragleave", function(e) {
                        this.style.backgroundColor = "";
                    });

                    draggableItems[i].addEventListener("drop", function(e) {
                        if (draggingItem !== this) {
                            var newIndex = Array.prototype.indexOf.call(this.parentNode.children, this);
                            var temp = this.id;
                            this.id = draggingItem.id;
                            draggingItem.id = temp;

                            var temphtml = this.innerHTML;
                            this.innerHTML = draggingItem.innerHTML;
                            draggingItem.innerHTML = temphtml;

                            draggableItems[originalIndex].style.backgroundColor = "";
                            originalIndex = newIndex;
                            console.log(originalIndex);

                            // Update the position data object with the new position of the elements
                            var tempPositionData = {};

                            for (var i = 0; i < draggableItems.length; i++) {
                                tempPositionData[draggableItems[i].id] = i + 1;
                            }
                            positionData = tempPositionData;
                            console.log(positionData);
                            sendPositon(positionData);
                        }
                        this.style.backgroundColor = "";
                    });
                }
                // Log the initial position data to the console
                console.log(positionData);

                function sendPositon(position_list) {
                    fetch('http://localhost/unigura/tutor/sendposition', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                data: position_list
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Success:');
                        })
                        .catch((error) => {
                            console.error('Have Error');
                        });
                }


                var addactivitybtns = document.querySelectorAll(".add-activity");
                var subject = document.getElementById('subject').innerText;
                var module = document.getElementById('module').innerText;

         

                addactivitybtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        window.location = "http://localhost/unigura/tutor/addactivity?id=" + this.id + "&subject=" + subject + "&module=" + module + "&course_id=" + <?php echo $data['id'] ?>;
                    })
                })


                var document_containers = document.querySelectorAll(".textbox_one");


                document_containers.forEach(container => {
                    const url = "http://localhost/unigura/tutor/getactivity?id=" + container.dataset.id;
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                for (let i = 0; i < data.length; i++) {
                                    let code = `<img class='img02' src='http://localhost/UniGura/public/img/tutor/class/icons/file.png'><a style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;' href = "http://localhost/unigura/tutor/viewactivitydoc?file=${data[i].link}">${data[i].description}</a>`;
                                    container.innerHTML += code;
                                }
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                })



                var updatedaybtns = document.querySelectorAll(".update-day");


                updatedaybtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        window.location = "http://localhost/unigura/tutor/updateday?id=" + this.id + "&subject=" + subject + "&module=" + module + "&course_id=" + <?php echo $data['id'] ?>;
                    })
                })


                var deletedaybtns = document.querySelectorAll(".delete-day");


                deletedaybtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        window.location = "http://localhost/unigura/tutor/deleteday?id=" + this.id + "&subject=" + subject + "&module=" + module + "&course_id=" + <?php echo $data['id'] ?>;
                    })
                })
            </script>
            <?php Footer::render(
                []
            ); ?>