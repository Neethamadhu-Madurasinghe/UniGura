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


<section>
    <div class="container">
        <div class="right">
            <div class="card" id="usergreeting">
                <div id="details">
                    <div class="text">
                        <h1>Hello 
                            <?php print_r( $data['tutor_name']['first_name']);        
                            ?> 
                        </h1>
                        <p>Its Good to see you !</p>
                    </div>
                    <div id="createcoursebtn">
                        <a class='btn' href="dashboard/create-class-template">Create Course</a>
                    </div>

                </div>
                <div class="image">
                    <img src="<?php echo URLROOT ?>/public/img/tutor/img1.png" alt="user greet">
                </div>
            </div>
            <div class="card myclasses" id="myclasses">
                <div id="heading">
                    <h1>My Classess</h1>
                </div>
                <div class="content">
                    <div class="component">
                        <div class="heading">Completed</div>
                        <div class="count" id="complete-class-count"></div>
                        <a>View all</a>
                    </div>
                    <div class="component">
                        <div class="heading">Active</div>
                        <div class="count" id="active-class-count"></div>
                        <a>View all</a>
                    </div>
                    <div class="component">
                        <div class="heading">Blocked</div>
                        <div class="count" id="blocked-class-count"></div>
                        <a>View all</a>
                    </div>
                </div>
            </div>
            <div class="card" id="pendingrequets">
                <div id="heading">
                    <h1>Pending Request</h1>
                </div>
                <div id="content">
                <div class="class-template">
                        <?php
                        $classes = json_decode($data['tutor_requests']);

                        foreach ($classes as $class) {
                            $array = (array) $class;
                            $student_first_name = (string) $array['first_name'] ;
                            $student_last_name = (string) $array['last_name'] ;
                            $module = (string) $array['module'];
                            $subject = (string) $array['subject'];
                            $mode = (string) $array['mode'];
                            $c_id = (string) $array['class_template_id'];

                            echo "
                            <div class='class-card'> 
                                <div class='header'>
                                    <div>
                                        
                                        <p>$student_first_name  $student_last_name</p>
                                        <div>$module</div>
                                        <div>$subject</div>
                                        <div>$mode</div>
                                        <h3 style = 'display:none;'>$c_id</h3>
                                    </div>
                                    <i class='fa-solid fa-user user'></i>
                                </div>
                                <div>
                                    <p></p>
                                    <p></p>
                                </div>   
                                <div class='footer'>
                                    <div>
                                        <i class='fa-solid fa-star'></i>
                                    </div>
                                    <div>
                                        <i class='fa-regular fa-pen-to-square'></i>
                                        <i class='fa-solid fa-trash'></i>
                                        <i class='fa-solid fa-eye-slash'></i>
                                    </div>         
                                </div>                      
                            </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card" id="payments">
                <div id="heading">
                    <h1>Payments</h1>
                </div>
                <div id="content"></div>
            </div>
        </div>
        <div class="left">
            <div class="card" id="todayclasses">
                <div id="heading">
                    <h1>
                        Today Classes
                    </h1>
                </div>
                <div id="content"></div>
            </div>
            <div class="card" id="mycourses">
                <div id="heading">
                    <h1>My Courses</h1>
                </div>
                <div id="content">
                    <div class="class-template">
                        <?php
                        $classes = json_decode($data['tutoring_class_template']);

                        foreach ($classes as $class) {
                            $array = (array) $class;
                            $subject = (string) $array['subject'];
                            $module = (string) $array['module'];
                            $mode = (string) $array['mode'];
                            $medium = (string) $array['medium'];
                            $c_id = (string) $array['course_id'];

                            echo "
                            <div class='class-card'> 
                                <div class='header'>
                                    <div>
                                        <h2>$subject</h2>
                                        <p>$module</p>
                                        <div>$mode</div>
                                        <div>$medium </div>
                                        <h3 style = 'display:none;'>$c_id</h3>
                                    </div>
                                    <i class='fa-solid fa-user user'></i>
                                </div>
                                <div>
                                    <p></p>
                                    <p></p>
                                </div>   
                                <div class='footer'>
                                    <div>
                                        <i class='fa-solid fa-star'></i>
                                    </div>
                                    <div>
                                        <i class='fa-regular fa-pen-to-square'></i>
                                        <i class='fa-solid fa-trash'></i>
                                        <i class='fa-solid fa-eye-slash'></i>
                                    </div>         
                                </div>                      
                            </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card" id="balancetime">
                <div id="heading">
                    <h1>
                        Balance Time
                    </h1>
                </div>
                <div id="content"></div>
            </div>

        </div>

    </div>
    <script>
        //declaring varibles

        let active_class_count = document.querySelector('#active-class-count');
        let block_class_count = document.querySelector('#blocked-class-count');
        let complete_class_count = document.querySelector('#complete-class-count');

        //Getting active class count
        let class_counts = <?php echo $data['active_class_count'] ?>;

        active_class_count.innerHTML = class_counts['active'];
        block_class_count.innerHTML = class_counts['blocked'];
        complete_class_count.innerHTML = class_counts['complete'];



        //Getting Complete class count


        //Getting block class count

        // Get the modal - Result Model

        const cards = document.querySelectorAll(".class-card");
        cards.forEach(card => {
            console.log(card)
            card.addEventListener("click", function() {
                window.location = "http://localhost/unigura/tutor/viewcourse?subject=" + this.querySelector("h2").textContent + "&module=" + this.querySelector("p").textContent + "&id=" + this.querySelector("h3").textContent;
            });
        });
    </script>
</section>


<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js'
    ]
);
?>