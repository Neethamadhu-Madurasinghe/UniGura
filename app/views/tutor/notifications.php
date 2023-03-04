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
    'Tutor Notifications',
    [
        URLROOT . '/public/css/tutor/base.css?v=1.1',
        URLROOT . '/public/css/tutor/style.css?v=1.7'
    ]
);

MainNavbar::render($request);
?>
     
     <div class="New_Student_Request">
          <h2>Notifications</h2>
          <div class="msg_container_one">
          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>

          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>

          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>

          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>

          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>

          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>

          <div class="msg_box_one">
               <div class="header">
                    <h4>New Student Request</h4>
                    <button class="close"><i class="fa fa-times"></i></button>
               </div>
               <div class="content">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;">Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo </p>
                    <button class="msg_box button">View Details</button>
               </div>
          </div>


          

          </div>

     </div>
     




<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js'
    ]
);
?>

