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
        URLROOT . '/public/css/tutor/base.css?v=2.8',
        URLROOT . '/public/css/tutor/dashboard.css?v=3.4'
    ]
);

MainNavbar::render($request);
?>


<section>
    <div class="container">
        <div class="left">
            <div id="usergreeting" style="background-color: #ffffff;    padding :  25px;padding-top: 0px;margin-bottom: 40px;border-radius:10px;height:210px">
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
                    <img style="border-radius: 0px;" src="<?php echo URLROOT ?>/public/img/tutor/img1.png" alt="user greet" id="image">
                </div>
            </div>

            <div class="card myclasses" id="myclasses" style="height: 270px;">
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

            <div class="card" id="pendingrequets" style="height: 280px;">
                <div id="heading">
                    <h1>Pending Requests</h1>
                </div>

                <div class="content">
                    <ul class="cards">
                        <?php

                        $classes = json_decode($data['tutor_requests']);
                        if ($classes) {
                            foreach ($classes as $class) {
                                $array = (array) $class;
                                $id = (string) $array['id'];
                                $student_first_name = (string) $array['first_name'];
                                $student_last_name = (string) $array['last_name'];
                                $module = (string) $array['module'];
                                $subject = (string) $array['subject'];
                                $mode = (string) $array['mode'];
                                $c_id = (string) $array['class_template_id'];
                                $profile_pic = (string) $array['profile_picture'];

                                echo "
                                <li class='cardss'>
                                    <div class='msg_box' style='margin-top: 0px;'>
                                        <header>
                                            <img  src= http://localhost/UniGura/$profile_pic>
                                            <div>
                                                <h4>$student_first_name  $student_last_name</h4>
                                                <p style='color: rgba(112, 124, 151, 1) ; margin-top:0px;text-align: justify;'> $module | $mode</p>
                                            </div>
                                            </header>
                                        <button class='msg_box button' id = $id>View Details</button>
                                        <h3 style = 'display:none;'>$c_id</h3>
                                    </div>
                                </li>";
                            }
                        } else {
                            echo "
                                <li class='cardss'>
                                    <div class='msg_box' style='margin-top: 0px;'>
                                        <header>
                                            <div>
                                                <h4>No Requests</h4>
                                            </div>
                                            </header>
                                    </div>
                                </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="payments" style="height: 570px; background-color: #ffffff;    padding :  25px;padding-top: 0px;margin-bottom: 40px;border-radius:10px;">
                <div id="heading">
                    <div class="Payments_header">
                        <h1>Payments</h1>
                        <div class="dropdown" style="margin-top: 20px;">
                            <p class="view_all"><a href="">View All</a></p>

                        </div>

                    </div>
                    <div class="Payments_box">
                        <table>
                            <tr>
                                <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg"></td>
                                <td>Dasun Shanaka</span>
                                    <p>Organic</p>
                                </td>
                                <td>Rs.900/=</td>
                                <td><span style="border: 1px solid #ff8f0e;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #ff8f0e;font-size: 14PX;">PAIDOFF</span></td>
                                <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg"></td>
                                <td>Dasun Shanaka</span>
                                    <p>Organic</p>
                                </td>
                                <td>Rs.900/=</td>
                                <td><span style="border: 1px solid #08ad029c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #08ad029c;font-size: 14PX;">RECEIVED</span></td>
                                <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg"></td>
                                <td>Dasun Shanaka</span>
                                    <p>Organic</p>
                                </td>
                                <td>Rs.900/=</td>
                                <td><span style="border: 1px solid #7c7c8f9c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #7c7c8f9c;font-size: 14PX;">PENDING</span></td>
                                <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg"></td>
                                <td>Dasun Shanaka</span>
                                    <p>Organic</p>
                                </td>
                                <td>Rs.900/=</td>
                                <td><span style="border: 1px solid #7c7c8f9c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #7c7c8f9c;font-size: 14PX;">PENDING</span></td>
                                <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg"></td>
                                <td>Dasun Shanaka</span>
                                    <p>Organic</p>
                                </td>
                                <td>Rs.800/=</td>
                                <td><span style="border: 1px solid #ff8f0e;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #ff8f0e;font-size: 14PX;">PAIDOFF</span></td>
                                <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                            </tr>

                        </table>

                    </div>
                </div>

            </div>
        </div>
        <div class="right">
            <div class="card" id="todayclasses" style="height: 450px;">
                <div id="heading">
                    <h1>Today Classes</h1>
                    <div class="all_message">

                        <div class="msg_box">
                            <header>
                                <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                <div class="text_box">
                                    <h4> Isuru Udana</h4>
                                    <p>2pm - 5pm</p>
                                </div>
                            </header>
                            <div style="margin-top: 10px;">
                                <div class="text_box">
                                    <p>Online 62%</p>
                                    <p>Progress Bar</p>
                                </div>
                                <button class="msg_box button">View</button>
                            </div>
                        </div>


                        <div class="msg_box">
                            <header>
                                <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                <div class="text_box">
                                    <h4> Isuru Udana</h4>
                                    <p>2pm - 5pm</p>
                                </div>
                            </header>
                            <div style="margin-top: 10px;">
                                <div class="text_box">
                                    <p>Online 62%</p>
                                    <p>Progress Bar</p>
                                </div>
                                <button class="msg_box button">View</button>
                            </div>
                        </div>

                        <div class="msg_box">
                            <header>
                                <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                <div class="text_box">
                                    <h4> Isuru Udana</h4>
                                    <p>2pm - 5pm</p>
                                </div>
                            </header>
                            <div style="margin-top: 10px;">
                                <div class="text_box">
                                    <p>Online 62%</p>
                                    <p>Progress Bar</p>
                                </div>
                                <button class="msg_box button">View</button>
                            </div>
                        </div>

                        <div class="msg_box">
                            <header>
                                <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                                <div class="text_box">
                                    <h4> Isuru Udana</h4>
                                    <p>2pm - 5pm</p>
                                </div>
                            </header>
                            <div style="margin-top: 10px;">
                                <div class="text_box">
                                    <p>Online 62%</p>
                                    <p>Progress Bar</p>
                                </div>
                                <button class="msg_box button">View</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="card" id="mycourses" style="height: 530px;">
                <div id="heading">
                    <h1>My Courses</h1>
                </div>
                <div class="all_message" id="course_cards">
                    <?php
                    $classes = json_decode($data['tutoring_class_template']);
                    foreach ($classes as $class) {
                        $array = (array) $class;
                        $subject = (string) $array['subject'];
                        $module = (string) $array['module'];
                        $mode = (string) $array['mode'];
                        $medium = (string) $array['medium'];
                        $c_id = (string) $array['course_id'];
                        $rate = (string) $array['current_rating'];
                        $count = (string) $array['class_count'];

                        echo "
                            <div class = 'main_card'>
                                <div class='msg_box' id='content'> 
                                <div class='headbox' >
                                    <div>
                                        <h2 class='subject'>$subject</h2>
                                        <p>$module</p>
                                        <h3 style = 'display:none;'>$c_id</h3>
                                    </div>
                                </div>
                                <div class='text_box3'>
                                    <p><i class='fa-solid fa-microphone'></i>  $medium </p>
                                    <p><i class='fa-brands fa-chromecast'></i> $mode </p>
                                </div>
                                <p class='Active-students' ><i class='fa-solid fa-users'></i> $count Active Students</p>                       
                            </div>
                            <div>
                                    <div class='button_box'>
                                        <button class='star'><i class='fa-solid fa-star'></i> $rate</button>
                                        <button title='View' class='closestart view' data-subject =$subject data-module = $module data-id = $c_id ><i class='fa-solid fa-expand view' data-subject =$subject data-module = $module data-id = $c_id></i></button>
                                        <button title='Edit' class='middle edit' data-id = $c_id ><i data-id = $c_id  class='fa-solid fa-pen edit'></i></button>
                                        <button title='Delete' class='closeend delete' data-id = $c_id  ><i data-id = $c_id  class='fa-solid fa-trash delete'></i></button>
                                    </div> 
                            </div>
                            </div>  
                           ";
                    }
                    ?>
                </div>

            </div>

            <div class="card" id="balancetime" style="background-color: #ffffff;    padding :  25px;padding-top: 0px;margin-bottom: 40px;border-radius:10px;height:390px">
                <div id="heading">
                    <h1>
                        Balance Time
                    </h1>
                </div>
                <div id="content">
                    <div id="piechart">
                        <div class="circle">
                            <!-- <span class="progress-value">90%</span>
                            <br>
                            <span class="text">Working</span> -->
                            <div class="percentage-box">
                                <div class="Working">
                                    <h1 id="working"></h1>
                                    <span>Working Time</span>
                                </div>
                                <div class="free">
                                    <h1 id="acting"></h1>
                                    <span>Free Time</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>
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

    const card_container = document.querySelector('#course_cards');

    card_container.addEventListener('click', (event) => {
        if (event.target.classList.contains('view')) {
            window.location = "http://localhost/unigura/tutor/viewcourse?subject=" + event.target.dataset.subject + "&module=" + event.target.dataset.module + "&id=" + event.target.dataset.id;
        }
        if (event.target.classList.contains('edit')) {
            window.location = "http://localhost/unigura/tutor/updateclasstemplate?id=" + event.target.dataset.id;
        }
        if (event.target.classList.contains('delete')) {
            window.location = "http://localhost/unigura/tutor/deleteclasstemplate?id=" + event.target.dataset.id;
        }
    });



    //Student request ridirect button--------------------

    const list = document.querySelector('.cards');

    list.addEventListener('click', (event) => {
        if (event.target.tagName === 'BUTTON') {
            window.location = "http://localhost/unigura/tutor/viewstudentrequest?id=" + event.target.id;
        }
    });

    //--------------

    let time_slots = <?php echo $data['tutor_time_slots'] ?>;
    let working_slots = time_slots[0].working_count;
    let acting_slots = time_slots[0].active_count;


    let halt_slots = 56 - (working_slots + acting_slots);

    let working_per = working_slots;
    let acting_per = acting_slots;


    document.getElementById('working').innerHTML = `${Math.floor((working_per/56)*100)}%`;
    document.getElementById('acting').innerHTML = `${Math.floor((acting_per/56)*100)}%`;

    var data = [working_slots, acting_slots, halt_slots];
    var colors = ['#FFA620', '#F7711A', '#d4d5dbb8'];

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



<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2',
        URLROOT . '/public/js/tutor/check-notification-count.js'
    ]
);
?>