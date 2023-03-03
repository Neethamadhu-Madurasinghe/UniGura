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
     'Add Activity',
     [
          'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
          'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
          URLROOT . '/public/css/tutor/forms.css?v=1.2'
     ]
     //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
     <div class="box" style="width: 30%; margin-left: 35%;">

          <img class="stu_img" id='image' src="user.jpg">
          <h2 id="first_name" style="text-align: center;width: 100%;padding-bottom: 0px; font-weight: 400;">Sachithra Kavinda</h2>
          <div class="content">

               <div class="new_req_table">
                    <i class="fa-solid fa-graduation-cap"></i><span id="class" class="text">Class : Physics - Mechanics</span>
               </div>
               <div class="new_req_table">
                    <i class="fa-regular fa-calendar-days"></i><span id="time" class="text">Time : Wendsday 18 - 20 PM</span>
               </div>
               <div class="new_req_table">
                    <i class="fa-solid fa-bookmark"></i><span id="type" class="text">Type : Revision</span>
               </div>
               <div class="new_req_table">
                    <i class="fa-brands fa-chromecast"></i><span id="mode" class="text">Mode : Online</span>
               </div>

          </div>
          <div class="form_container">
              

                    <div>
                         <div class="grid" style="margin-top: 0px;">
                              <div class="dropdown">
                                   <button class="no" id="close_btn">Decline</button>
                              </div>
                              <form action="" method="POST" enctype='multipart/form-data'>
                                   <input id="id" name="id" value="" type="hidden">
                                   <div class="dropdown">
                                        <button type="submit" class="yes" id="approve">Approve</button>
                                   </div>
                              </form>
                         </div>

                    </div>
              

          </div>

          <script>
               let student_name = document.getElementById('first_name');
               let student_image = document.getElementById('image');
               let course = document.getElementById('class');
               let time_slot = document.getElementById('time');
               let type = document.getElementById('type');
               let mode = document.getElementById('mode');
               let request = <?php echo $data['tutor_request'] ?>;
               let time_slots = <?php echo $data['time_slots'] ?>;
               let input_id = document.getElementById('id');
          
               let day;

               switch (time_slots[0].day) {
                    case 'mon':
                         day = 'Monday'
                    case 'tue':
                         day = 'Tuestday'
                         break;
                    case 'wed':
                         day = 'Wendesday'
                         break;
                    case 'thu':
                         day = 'Thursday'
                         break;
                    case 'fri':
                         day = 'Friday'
                         break;
                    case 'sat':
                         day = 'Saturday'
                         break;
                    case 'sun':
                         day = 'Sunday'
                         break;
                    default:
                         // code to execute if expression doesn't match any of the cases
               }


               student_name.innerText = request[0].first_name + ' ' + request[0].last_name;
               student_image.src = `http://localhost/UniGura/${request[0].profile_picture}`;
               course.innerText = 'Course : ' + request[0].subject + ' - ' + request[0].module;
               type.innerText = 'Type : ' + request[0].class_type;
               mode.innerText = 'Mode : ' + request[0].mode.charAt(0).toUpperCase() + request[0].mode.slice(1);;
               time_slot.innerText = 'Time : ' + day + ' ' +  time_slots[0].time.slice(0,2) + '-' + `${parseInt(time_slots[time_slots.length - 1].time.slice(0,2))+2}`;
               input_id.value = request[0].id;
               console.log(request[0]);

               var closebtn = document.querySelector("#close_btn");
            
               closebtn.addEventListener('click', function() {
               window.location = "http://localhost/unigura/tutor/dashboard";
            })
          </script>



          <?php Footer::render(
               []
          ); ?>