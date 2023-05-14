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
    'landing page',
    [

        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/common/landingpage.css'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);


?>

<div class="home">
          <div class="bar">
               <div class="logo">
                    Unigura
               </div>

               <div class="topnav">
                    <a class="active" href="http://localhost/UniGura/login">Find Tutors</a>
                    <a href="http://localhost/UniGura/login">Become a Tutor</a>
                    <a href="#about">About us</a>
               </div>
          </div>

               <div class="header" src="bg.png">
                    <div class="content">
                         <div class="text">
                              <h1>Prepare to Alevels confidently <br>by subjects with best<br><span>Undergratuates</span></h1>
                              <button>Get Started</button>
                         </div>
                         <div><img  src="<?php echo URLROOT ?>/public/img/common/landingpage/cover.png" alt=""></div>
                    </div>
  
               </div>

               <div class="summery">
                    <div class="grid_3">
                         <div>
                              <div class="value">500+</div>
                              <div class="name">Undergratuate Tutors</div>
                         </div>
                         <div>
                              <div class="value">50+</div>
                              <div class="name">Subjects Taught</div>
                         </div>
                         <div>
                              <div class="value">50000+</div>
                              <div class="name">Enroll Students</div>
                         </div>
                    </div>
               </div>

               <div class="subjects">
                    <div class="grid_4">
                         <div class="box">
                              <img src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/pulley.png">
                              <div>
                                   <div class="value">Physics</div>
                                   <div class="name">450 Teachers</div>
                              </div>
                         </div>
                         <div class="box">
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/chemical.png">
                              <div>
                                   <div class="value">Chemistry</div>
                                   <div class="name">250 Teachers</div>
                                   </div>
                              </div>
                         <div class="box">
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/algebra.png">
                              <div>
                              <div class="value">Pure Mathematics</div>
                              <div class="name">150 Teachers</div>
                                   </div>
                         </div>
                         <div class="box">
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/pulley.png">
                              <div>
                              <div class="value">Applied Mathematics</div>
                              <div class="name">120 Teachers</div>
                         </div>
                         </div>
                         <div class="box">
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/atom (2).png">
                              <div>
                              <div class="value">Accounting</div>
                              <div class="name">160 Teachers</div>
                         </div>
                         </div>
                         <div class="box">
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/presentation.png">
                              <div>
                              <div class="value">Bussiness Studies</div>
                              <div class="name">120 Teachers</div>
                         </div>
                         </div>
                    </div>
               </div>

               <div class="features">
                    <h1>Speed up your exam preparation with Unigura</h1>

                    <div class="box">
                         <div>
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/award.png">
                              <div class="main">Experienced tutors</div>
                              <div class="sub">Learn to get best result from who obtained best resutls.</div>
                         </div>

                         <div>
                              <img src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/protect.png">
                              <div class="main">Verified profiles</div>
                              <div class="sub">We carefully check and confirm each tutor's profile</div>
                         </div>

                         <div>
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/money-bag.png">
                              <div class="main">Affordable prices</div>
                              <div class="sub">Choose an experienced Undergratuate that fits your budget</div>
                         </div>

                         <div>
                              <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/login (1).png">
                              <div class="main">Learn anytime</div>
                              <div class="sub">Take online classes and physical classes at the perfect time for your busy schedule</div>
                         </div>
                    </div>


               </div>
               <div class="skills">
                    <div class="inside">
                    <h1>Focus on your weak lessons</h1>
                    <h3>Prepare to achieve best in your exam with Undergratuate tutors</h3>
                    
                    <div>
                    <div class="box">
                         <img class="cover"  src="<?php echo URLROOT ?>/public/img/common/landingpage/cover2.png">
                         <div>
                              <div class="icon">
                                   <div class="back">
                                        <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/bookmark.png">
                                   </div>
                                   <div class="text">
                                        <div class="main">Immerse yourself in a new culture</div>
                                        <div class="sub">Connect with Undergratuates around your location</div>
                                   </div>
                              </div>

                         <div class="icon">
                              <div class="back">
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/thunder.png">
                              </div>
                              <div class="text">
                                   <div class="main">Succeed in your Exam</div>
                                   <div class="sub">Learn only lessons you need or weak at in a rapid way </div>
                              </div>
                         </div>

                         <div class="icon">
                              <div class="back">
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/history.png">
                              </div>
                              <div class="text">
                                   <div class="main">Get expert help when you need it</div>
                                   <div class="sub">Learn to solve any problem in any lesson with lesson time</div>
                              </div>
                         </div>

                         <div class="icon">
                              <div class="back">
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/icon/location.png">
                              </div>
                              <div class="text">
                                   <div class="main">prepare naturally, always</div>
                                   <div class="sub">Make a good impression and build trust in any subject</div>
                              </div>
                         </div>
                         

                         </div>
                    </div>
                    </div>
                    </div>


               </div>

               <div class="how">
                    <div class="inside">
                    <h1>How Unigura works</h1>
                    <h3>Learn online with the Island Top Rankers</h3>
                    
                    <div>
                    <div class="box">
                         <div>
                              <div class="icon">
                                   <div class="back">
                                        1
                                   </div>
                                   <div class="text">
                                        <div class="main">Find the best tutor</div>
                                        <div class="sub">Choose from over 1000 online and physical tutors. Use filters and reviews to narrow your search and find the perfect fit. You can find a Undergratuate nearby your location</div>
                                   </div>
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/how/5.png">
                              </div>

                              <div class="icon">
                                   <div class="back">
                                        2
                                   </div>
                                   <div class="text">
                                        <div class="main">Take sessions at your free time</div>
                                        <div class="sub">Find the perfect time for your busy schedule. reschedule Available</div>
                                   </div>
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/how/2.png">
                              </div>

                              <div class="icon">
                                   <div class="back">
                                        3
                                   </div>
                                   <div class="text">
                                        <div class="main">Get benifit of our LMS</div>
                                        <div class="sub">When it’s lesson time, connect with your tutor through our comprehensive LMS. Activity Management,Chat,Payment Portal all available at unigura</div>
                                   </div>
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/how/3.png">
                              </div>

                              <div class="icon">
                                   <div class="back">
                                        4
                                   </div>
                                   <div class="text">
                                        <div class="main">Keep improving the areas you week at</div>
                                        <div class="sub">Keep track of your learning progress. Improve your problem solving skills with our tutors
                                        </div>
                                   </div>
                                   <img  src="<?php echo URLROOT ?>/public/img/common/landingpage/how/6.png">
                              </div>

                         

                         </div>
                    </div>
                    </div>
                    </div>


               </div>
     </div>





<script>
    // Fetching Backend Data

    let root = '<?php echo URLROOT ?>';
    let data_string = '<?php echo json_encode($data) ?>';
</script>

<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/course.js'
    ]
); ?>