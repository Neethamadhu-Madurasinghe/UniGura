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
                        <h1 id='tutor_name' style="font-size: 30px; font-weight:700;"></h1>
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
                        <a class="view_all completed-class">View all</a>
                    </div>
                    <div class="component">
                        <div class="heading">Active</div>
                        <div class="count" id="active-class-count"></div>
                        <a class="view_all active-class">View all</a>
                    </div>
                    <div class="component">
                        <div class="heading">Blocked</div>

                        <div class="count" id="blocked-class-count"></div>
                        <a class="view_all blocked-class">View all</a>
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
                            <p class="view_all"><a href="payments">View All</a></p>

                        </div>

                    </div>
                    <div class="Payments_box">

                    </div>
                </div>

            </div>
        </div>
        <div class="right">
            <div class="card" id="todayclasses" style="height: 450px;">
                <div id="heading">
                    <h1>Today Classes</h1>
                    <div class="all_message" id='today_classes'>

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

                        if ($medium == 0) {
                            $medium = 'Sinhala';
                        } else if ($medium == 1) {
                            $medium = 'English';
                        } else {
                            $medium = 'Tamil';
                        }

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
                        Your Teach Time Balance
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
                                    <span>Available Time</span>
                                </div>
                                <div class="free">
                                    <h1 id="acting"></h1>
                                    <span>Teach Time</span>
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
    let root = '<?php echo URLROOT ?>';
    let tutor_name_string = '<?php echo json_encode($data['tutor_name']) ?>';
    let tutor_name_obj = JSON.parse(tutor_name_string)
    let class_counts = <?php echo $data['active_class_count'] ?>;

    let tutor_classes = <?php echo $data['tutor_classes'] ?>;






    //seting tutors name

    document.getElementById('tutor_name').innerText = tutor_name_obj.first_name;

    let active_class_count = document.querySelector('#active-class-count');
    let block_class_count = document.querySelector('#blocked-class-count');
    let complete_class_count = document.querySelector('#complete-class-count');


    //Setting Class Counts Redirects
    document.querySelector('.active-class').addEventListener('click', () => {
        window.location = `${root}/tutor/classes`;
    })

    document.querySelector('.completed-class').addEventListener('click', () => {
        window.location = `${root}/tutor/classes?completion_status=1`;
    })

    document.querySelector('.blocked-class').addEventListener('click', () => {
        window.location = `${root}/tutor/classes?is_suspended=1`;
    })

    //Settking Class Counts

    active_class_count.innerHTML = class_counts['active'];
    block_class_count.innerHTML = class_counts['blocked'];
    complete_class_count.innerHTML = class_counts['complete'];



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


    document.getElementById('working').innerHTML = `${Math.floor((acting_per/56)*100)}%`;
    document.getElementById('acting').innerHTML = `${Math.floor((working_per/56)*100)}%`;

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

    let payments = <?php echo $data['payments'] ?>;
    let payment_container = document.querySelector('.Payments_box');
    list_payment(payments)

    function list_payment(payments) {
        let table = document.createElement('table');
        console.log(payments)
        for (const element of payments) {
            let payment_status;
            if (element.payment_status == 0) {
                payment_status = "PENDING";
            } else if (element.payment_status == 1) {
                payment_status = "RECIVED";
            } else {
                payment_status = "PAID-OFF";
            }

            let year = element.date.slice(0, 4);

            let month = element.date.toString().slice(5, 7);
            let day = element.date.toString().slice(8, 10);
            let month_text = new Date(Date.UTC(2023, parseInt(month) - 1, 1)).toLocaleString('default', {
                month: 'short'
            });


            let tr = document.createElement('tr');
            let cell1 = document.createElement('td');
            let cell2 = document.createElement('td');
            let cell3 = document.createElement('td');
            let cell4 = document.createElement('td');
            let cell5 = document.createElement('td');

            cell1.innerHTML = `<img src="${root}/${element.profile_picture}">`;
            cell2.innerHTML = `${element.first_name} ${element.last_name}</span>
                         <p>${element.module}</p>
                    `;
            cell3.innerHTML = `Rs.${element.session_rate}`;
            cell4.innerHTML = `<span   class='p_status ${payment_status.toLowerCase()}' >${payment_status}</span>`;
            cell5.innerHTML = `<i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> ${month_text} ${day} ${year}</span>`;



            tr.appendChild(cell1);
            tr.appendChild(cell2);
            tr.appendChild(cell3);
            tr.appendChild(cell4);
            tr.appendChild(cell5);
            table.appendChild(tr);
        }
        payment_container.appendChild(table);

    }


    //seting today classes.

    let class_container = document.getElementById('today_classes');

    class_container.addEventListener('click', (event) => {
        if (event.target.classList.contains('msg_box') && event.target.classList.contains('button')) {
            const classid = event.target.dataset.classid;
            window.location = `${root}/tutor/classes?id=${classid}`
        }
    });


    if(tutor_classes.length == 0){
        class_container.innerHTML += `
        <div class="msg_box">
            <div class="text_box">
                        <h4>Sorry !</h4>
                        <p>You dont have any class today</p> 
                   </div>
       
        </div>
 `
    }


    for (const obj of tutor_classes) {
        if (obj['profile_picture'] == '') {
            obj['profile_picture'] = 'profile.png'
        }

        const startTime = obj['time'];
        const duration = parseInt(obj['duration']); 
       
        // Convert time to Date object
        const date = new Date();
        const timeParts = startTime.split(':');

        date.setHours(parseInt(timeParts[0]));
        date.setMinutes(parseInt(timeParts[1]));

        // Calculate end time
        const endTime = new Date(date.getTime() + duration * 60 * 60 * 1000);

        // Format time as string
        const startTimeString = formatTime(date);
        const endTimeString = formatTime(endTime);

        // Format time string as "start - end" format
        const timeString = `${startTimeString} - ${endTimeString}`;
        code = ` 
        <div class="msg_box">
            <header>
                <img src="${root}/public/profile_pictures/${obj['profile_picture']}">
                    <div class="text_box">
                        <h4> ${obj['first_name']} ${obj['last_name']}</h4>
                        <p>Start at ${timeString}</p>
                            
                   </div>
                </header>
            <div style="margin-top: 10px;">
            <div class="text_box">
                <p>Mode - ${obj['mode']}</p>
                <p>Fee - ${obj['session_rate']}</p>
            </div>
            <button class="msg_box button" data-classid = ${obj['classid']}>View</button>
            </div>
        </div>
        `

        class_container.innerHTML += code;

    }

    // Function to format a Date object as a string in "HH:MM AM/PM" format
    function formatTime(date) {
        const hours = date.getHours();
        const minutes = date.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = hours % 12 || 12;
        const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
        return `${formattedHours}:${formattedMinutes} ${ampm}`;
    }
</script>



<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2',
        URLROOT . '/public/js/tutor/check-notification-count.js'
    ]
);
?>