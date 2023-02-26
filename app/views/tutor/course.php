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
        URLROOT . '/public/css/tutor/course.css?v=1.6'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);


?>




<div>
    <div class="part_two">
        <div class="Student">
            <h1 style="margin-bottom: 0px;text-align: center;font-weight: 400;"><?php echo $data['module'] ?></h1>
            <div style="display: grid;grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="color: #7b7f8f;text-align: right;margin-top: px;font-size: 17px;">
                    <span><i class="fa-solid fa-graduation-cap"></i></span><?php print_r($data['subject']) ?>
                </div>
                <div style="color: #7b7f8f;text-align: left;margin-top: px;font-size: 17px;">
                    <span><i class="fa-solid fa-brands fa-chromecast"></i></span> <?php print_r($data['mode']) ?>
                </div>
            </div>
            <div class="button-container">
                <div class="button1">
                    <?php echo '<a  href= /unigura/tutor/createday?class_template_id=' . $data["id"] . '><i class="fa-solid fa-plus"></i> Add Day</a>' ?>
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
                        $meeting_link = (string) $array['meeting_link'];
                        $position = (string) $array['position'];

                        echo "
                    <div class='day' draggable='true' id = $id>
                    <div class='day_box' style='margin-top: 0px;'>
                        <div style='display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid rgba(112, 124, 151, 0.151);padding-bottom: 5px;'>
                            <h4>$title</h4>
                        </div>
                        <div class='textbox_one'>
                            <img class='img02' src='http://localhost/UniGura/public/img/tutor/class/icons/file.png'>
                            <p style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;'>Tute</p>
                            <img class='img02' src='http://localhost/UniGura/public/img/tutor/class/icons/file.png'>
                            <p style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;'>Question</p>
                        </div>
                    </div>
                    <div class='button_box'>
                        <div></div>
                        <div></div>
                        <button class='left'><i class='fa-solid fa-plus'></i></button>
                        <button class='middle'><i class='fa-solid fa-pen'></i></button>
                        <button class='right'><i class='fa-solid fa-trash'></i></button>
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
            </script>
            <?php Footer::render(
                []
            ); ?>