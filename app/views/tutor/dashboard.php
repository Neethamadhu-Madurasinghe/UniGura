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
        URLROOT . '/public/css/tutor/dashboard.css?v=1.3'
    ]
);

MainNavbar::render($request);
?>
    <section >
        <div class="container">
            <div class="right">
                <div class="card" id="usergreeting">
                    <div id="details">
                        <div class="text">
                            <h1>Hello Sachithra</h1>
                            <p>Its Good to see you !</p>
                        </div>
                        <div id="createcoursebtn">
                            <button>Create Course</button>
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
                            <div  class="count" id="active-class-count"></div>
                            <a>View all</a>
                        </div>
                        <div class="component">
                            <div class="heading">Blocked</div>
                            <div  class="count" id="blocked-class-count"></div>
                            <a>View all</a>
                        </div>
                    </div>
                </div>
                <div class="card" id="pendingrequets">
                    <div id="heading">
                        <h1>Pending Request</h1>
                    </div>
                    <div id="content"></div>
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
                        </h1></div>
                    <div id="content"></div>
                </div>
                <div class="card" id="mycourses">
                    <div id="heading">
                        <h1>My Courses</h1>
                    </div>
                    <div id="content"></div>
                </div>
                <div class="card" id="balancetime">
                    <div id="heading">
                        <h1>
                            Balance Time
                        </h1></div>
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
            let class_counts =<?php echo $data['active_class_count'] ?>;


            active_class_count.innerHTML = class_counts['active'];
            block_class_count.innerHTML = class_counts['blocked'];
            complete_class_count.innerHTML = class_counts['complete'];
           
            
            
            //Getting Complete class count


            //Getting block class count

        </script>
    </section>


<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js'
    ]
);
?>

