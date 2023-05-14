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
        URLROOT . '/public/css/tutor/dashboard.css?v=3.5'
    ]
);

MainNavbar::render($request);
?>


<section>
    <div class="container">
        <div class="left">
            <!-- User Greeting Section -->
            <div id="usergreeting" >
                <div id="details">
                    <div class="text">
                        <h1 id='tutor_name'></h1>
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
            <!-- Statistics of the Tutor classes  -->
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

            <!-- New Requests for a tutor  -->
            <div class="card" id="pendingrequets" style="height: 280px;">
                <div id="heading">
                    <h1>Pending Requests</h1>
                </div>

                <div class="content">
                    <ul class="cards" id='request_list'>

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
    let payments = <?php echo $data['payments'] ?>;
    let tutor_classes = <?php echo $data['tutor_classes'] ?>;
    let requests = <?php echo $data['tutor_requests'] ?>;
    let courses = <?php echo $data['tutoring_class_template'] ?>;


    //courses component

    let course_list = document.getElementById('course_cards');

    if (courses.length != 0) {
        for (const course of courses) {

            course_list.innerHTML += `
            <div class = 'main_card'>
            <div class='msg_box' id='content'> 
                                <div class='headbox' >
                                    <div>
                                        <h2 class='subject'>${course['subject']}</h2>
                                        <p>${course['module']}</p>
                                        <p><i class="fa-solid fa-rupee-sign"></i>  ${course['session_rate']}</p>
                                    
                                    </div>
                                </div>
                                <div class='text_box3'>
                                    <p><i class='fa-solid fa-microphone'></i> ${course['medium']}</p>
                                    <p><i class='fa-brands fa-chromecast'></i>${course['mode']}</p>
                                      
                                </div>
                                
                                <p class='Active-students' ><i class='fa-solid fa-users'></i> ${course['class_count']} Active Students</p> 
                                                    
                            </div>
                            <div>
                                    <div class='button_box' data-subject=${course['subject']} data-module= ${course['module']} data-course_id = ${course['course_id']}>
                                        <button class='star'><i class='fa-solid fa-star'></i> ${course['current_rating']}</button>
                                        <button title='View' class='closestart view' ><i class="fa-solid fa-chalkboard-user view"></i></button>
                                        <button title='Edit' class='middle edit'><i class='fa-solid fa-pen edit'></i></button>
                                        <button title='Delete' class='closeend delete'><i class='fa-solid fa-trash delete'></i></button>
                                    </div> 
                            </div>
                </div>
            `


        }
    } else {
        course_list.innerHTML = 'No Courses added yet'
    }

    //class template redirects------------------


    course_list.addEventListener('click', (event) => {
        const button_box = event.target.closest('.button_box');
        let subject = button_box.getAttribute('data-subject');
        let module = button_box.getAttribute('data-module');
        let course_id = button_box.getAttribute('data-course_id');
        console.log(button_box.getAttribute('data-subject'))

        if (event.target.classList.contains('view')) {
            window.location = `${root}/tutor/viewcourse?subject=${subject}&module=${module}&id=${course_id}`;
        }
        if (event.target.classList.contains('edit')) {
            window.location = `${root}/tutor/updateclasstemplate?id=${course_id}`;
        }
        if (event.target.classList.contains('delete')) {
            window.location = `${root}/tutor/deleteclasstemplate?id=${course_id}`;
        }
    });

    //--------------------



    // Rendering all the Requests for the tutor

    let request_list = document.getElementById('request_list');

    if (requests.length != 0) {
        let listItem;
        for (const request of requests) {
            listItem = document.createElement("li");
            listItem.setAttribute('class', 'cardss');

            listItem.innerHTML = `
            <li class='cardss'>
                                    <div class='msg_box' style='margin-top: 0px;'>
                                        <header>
                                            <img  src= ${root}/${request['profile_picture']}>
                                            <div>
                                                <h4>${request['first_name']}  ${request['last_name']}</h4>
                                                <p style='color: rgba(112, 124, 151, 1) ; margin-top:0px;text-align: justify;'> ${request['module']} | ${request['mode']}</p>
                                            </div>
                                            </header>
                                        <button class='msg_box button' id = ${request['id']} >View Details</button>
                                    </div>
                                </li>
            `

            request_list.appendChild(listItem);
        }
    } else {
        request_list.innerHTML = 'No Reuquest for you'
    }

    //Student request ridirect button--------------------



    request_list.addEventListener('click', (event) => {
        if (event.target.tagName === 'BUTTON') {
            window.location = "http://localhost/unigura/tutor/viewstudentrequest?id=" + event.target.id;
        }
    });


    //seting tutors name

    document.getElementById('tutor_name').innerText = `Hi ${tutor_name_obj.first_name}`;

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

    //Setting Class Counts

    active_class_count.innerHTML = class_counts['active'];
    block_class_count.innerHTML = class_counts['blocked'];
    complete_class_count.innerHTML = class_counts['complete'];

    //--------------

    // work time balancing graph-------------------

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


    //---------------------------------

    //Paymetnt Display---------------------------


    let payment_container = document.querySelector('.Payments_box');


    console.log(payments.length)

    if (payments.length != 0) {
        list_payment(payments)
    } else {
        payment_container.innerHTML = 'No payments'
    }

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


    //seting today classes-----------------------------------------

    let class_container = document.getElementById('today_classes');

    class_container.addEventListener('click', (event) => {
        if (event.target.classList.contains('msg_box') && event.target.classList.contains('button')) {
            const classid = event.target.dataset.classid;
            window.location = `${root}/tutor/classes?id=${classid}`
        }
    });


    if (tutor_classes.length != 0) {
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

    } else {
        class_container.innerHTML += `
       No Today Classes
 `
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

    //-------------------------------------------
</script>



<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2',
        URLROOT . '/public/js/tutor/check-notification-count.js'
    ]
);
?>