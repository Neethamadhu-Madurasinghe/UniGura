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
        URLROOT . '/public/css/tutor/course.css?v=1.4'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>
<div class="main-area">
    <div class="header">
        <h1><?php echo $data['module'] ?></h1>
        <div class="subhead">
            <p><?php print_r($data['subject']) ?></p>
            <p><i class="fa-solid fa-chalkboard"></i> Online </p>
            <div id="createcoursebtn">
                <?php echo '<a  href= /unigura/tutor/createday?class_template_id=' . $data["id"] . '>Create day</a>'?>
            </div>
            <div id="createcoursebtn">
                <a class='btn' href="/unigura/tutor/dashboard">Home</a>
            </div>
        </div>
    </div>

    
    
    <div class="class-template">
        <?php
        $days = json_decode($data['days']);

        foreach ($days as $day) {
            $array = (array) $day;
            $title = (string) $array['title'];
            $meeting_link = (string) $array['meeting_link'];
            $position = (string) $array['position'];

            echo "
                            <div class='class-card'> 
                                <div class='header'>
                                    <div>
                                        <h2>Day $position -  $title</h2>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='content'>
                                        <i class='fa-solid fa-file doc'></i><p>Tute</p>
                                    </div>
                                    <div class='content'>
                                        <i class='fa-solid fa-file doc'></i><p>Tute</p>
                                    </div>
                                    <div class='content'>
                                        <i class='fa-solid fa-file doc'></i><p>Tute</p>
                                    </div>       
                                </div>   
                                <div class='footer'>
                                    <div>
                                        <i class='fa-solid fa-pencil'></i>
                                        <i class='fa-solid fa-circle-plus'></i>
                                        <i class='fa-solid fa-trash'></i>
                                    </div>         
                                </div>                      
                            </div>";
        }
        ?>
    </div>
</div>



<?php Footer::render(
    []
); ?>