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
        URLROOT . '/public/css/tutor/base.css?v=2.1',
        URLROOT . '/public/css/tutor/dashboard.css?v=2.2'
    ]
);

MainNavbar::render($request);
?>


<section>
    <div class="container">
        <div class="left">
            <div class="card" id="usergreeting">
                <div id="details">
                    <div class="text">
                        <h1 style="font-size: 30px; font-weight:700;">Hello
                            <?php print_r($data['tutor_name']['first_name']);
                            ?>
                        </h1>
                        <p>Its Good to see you !</p>
                    </div>
                    <div id="createcoursebtn">
                        <a class='btn' href="dashboard/create-class-template" style="text-decoration: none;font-size:15px;">Create Course</a>
                    </div>
                </div>
                <div class="image">
                    <img src="<?php echo URLROOT ?>/public/img/tutor/img1.png" alt="user greet" id="image">
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
                        <a class="view_all">View all</a>
                    </div>
                    <div class="component">
                        <div class="heading">Active</div>
                        <div class="count" id="active-class-count"></div>
                        <a class="view_all">View all</a>
                    </div>
                    <div class="component">
                        <div class="heading">Blocked</div>

                        <div class="count" id="blocked-class-count"></div>
                        <a class="view_all">View all</a>
                    </div>
                </div>
            </div>

            <div class="card" id="pendingrequets">
                <div id="heading">
                    <h1>Pending Requests</h1>
                </div>
                <div class="content">
                    <ul class="cards">
                        <li class="cardss">
                            <div class="msg_box" style="margin-top: 0px;">
                                <header>
                                    <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                    <h4 style="margin-top: 5%;"> Isuru Udana</h4>
                                </header>
                                <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                                <button class="msg_box button">View Details</button>
                            </div>
                        </li>
                        <li class="cardss">
                            <div class="msg_box" style="margin-top: 0px;">
                                <header>
                                    <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                    <h4 style="margin-top: 5%;"> Isuru Udana</h4>
                                </header>
                                <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                                <button class="msg_box button">View Details</button>
                            </div>
                        </li>
                        <li class="cardss">
                            <div class="msg_box" style="margin-top: 0px;">
                                <header>
                                    <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                    <h4 style="margin-top: 5%;"> Isuru Udana</h4>
                                </header>
                                <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                                <button class="msg_box button">View Details</button>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        <div class="card" id="payments">
            <div id="heading">
                <h1>Payments</h1>
            </div>
            <div id="content"></div>
        </div>
    </div>
    <div class="right">
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
            <div id="content">
                <div id="piechart">
                    <div style="display:none" id="active"><?php print_r(json_decode($data['tutor_time_slots'])[0]->active_count) ?></div>
                    <div style="display:none" id="working"><?php print_r(json_decode($data['tutor_time_slots'])[0]->working_count) ?></div>
                </div>
            </div>
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

        let working_slots = parseInt(document.getElementById('active').textContent);
        let acting_slots = parseInt(document.getElementById('working').textContent);
        let halt_slots = 56 - (working_slots + acting_slots)

        var data = [working_slots, acting_slots, 50];
        var colors = ['#ff0000', '#00ff00', '#0000ff'];

        var piechart = document.getElementById("piechart");
        var chartWidth = piechart.offsetWidth;
        var chartHeight = piechart.offsetHeight;
        var radius = Math.min(chartWidth, chartHeight) / 2;

        var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("viewBox", `0 0 ${chartWidth} ${chartHeight}`);
        piechart.appendChild(svg);

        var g = document.createElementNS("http://www.w3.org/2000/svg", "g");
        g.setAttribute("transform", `translate(${chartWidth / 2}, ${chartHeight / 2})`);
        svg.appendChild(g);

        var total = data.reduce(function(a, b) {
            return a + b;
        }, 0);
        var startAngle = 0;
        for (var i = 0; i < data.length; i++) {
            var angle = (data[i] / total) * 360;
            var endAngle = startAngle + angle;

            var largeArc = (endAngle - startAngle) > 180 ? 1 : 0;

            var x1 = radius * Math.sin(Math.PI * startAngle / 180);
            var y1 = -radius * Math.cos(Math.PI * startAngle / 180);
            var x2 = radius * Math.sin(Math.PI * endAngle / 180);
            var y2 = -radius * Math.cos(Math.PI * endAngle / 180);

            var d = `M 0 0
           L ${x1} ${y1}
           A ${radius} ${radius} 0 ${largeArc} 1 ${x2} ${y2}
           Z`;

            var path = document.createElementNS("http://www.w3.org/2000/svg", "path");
            path.setAttribute("d", d);
            path.setAttribute("fill", colors[i]);
            g.appendChild(path);

            startAngle = endAngle;
        }
    </script>
</section>


<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js'
    ]
);
?>