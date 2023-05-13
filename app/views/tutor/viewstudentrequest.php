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
     'Student Request',
     [
          'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
          'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
          URLROOT . '/public/css/tutor/forms.css?v=1.4'
     ]
     //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
    <div class="box"></div>
</div>
          <script>
               let student_name = document.getElementById('first_name');
               let student_image = document.getElementById('image');
               let course = document.getElementById('class');
               let time_slot = document.getElementById('time');
               let type = document.getElementById('type');
               let mode = document.getElementById('mode');

               let root = '<?php echo URLROOT ?>';

               let request = <?php echo $data['tutor_request'] ?>;
               let request_obj = request[0];

               


               let request_container = document.querySelector('.box');
               let time_slots = <?php echo $data['time_slots'] ?>;

               let time_slot_ids=[];
               

               for(let i = 0 ; i < time_slots.length ; i++){
                    time_slot_ids.push(time_slots[i].time_slot_id);
               }

               console.log(time_slot_ids);

               let day;

               switch (time_slots[0].day) {
                    case 'mon':
                         day = 'Monday'
                    case 'tue':
                         day = 'Tuesday'
                         break;
                    case 'wed':
                         day = 'Wednesday'
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

               let code = `<img class="stu_img" id='image' src='${root}/${request_obj.profile_picture}'>
          <h2 id="first_name" style="text-align: center;width: 100%;padding-bottom: 0px; font-weight: 400;">${request_obj.first_name} ${request_obj.last_name}</h2>
          <button class="close" id="close_btn"><i class="fa fa-times"></i></button>
          <div class="content">

               <div class="new_req_table">
                    <i class="fa-solid fa-graduation-cap"></i><span id="class" class="text">Class : ${request_obj.subject} - ${request_obj.module}</span>
               </div>
               <div class="new_req_table">
                    <i class="fa-regular fa-calendar-days"></i><span id="time" class="text">Time : ${day} @ ${time_slots[0].time}</span>
               </div>
               <div class="new_req_table">
                    <i class="fa-solid fa-bookmark"></i><span id="type" class="text">Type : ${request_obj.class_type}</span>
               </div>
               <div class="new_req_table">
                    <i class="fa-brands fa-chromecast"></i><span id="mode" class="text">Mode : ${request_obj.mode}</span>
               </div>
          </div>
          
          <div class='location' id='map-container'>
          
          </div>
          
          <div class="form_container">
               <div>
                    <div class="grid" style="margin-top: 0px;">
                         <div class="dropdown">
                              <button class="no" id="decline_btn">Decline</button>
                         </div>
                         <form action="" method="POST" enctype='multipart/form-data'>
                              <input id="id" name="id" value=${request_obj.id} type="hidden">
                              <input id="c_id" name="c_id" value=${request_obj.class_template_id} type="hidden">
                              <input id="Imode" name="mode" value=${request_obj.mode} type="hidden">
                              <input id="student_id" name="student_id" value=${request_obj.student_id} type="hidden">
                              <input id="tutor_id" name="tutor_id" value=${request_obj.tutor_id} type="hidden">
                              <input id="date" name="date" value=${time_slots[0].day} type="hidden">
                              <input id="Itime" name="time" value=${time_slots[0].time} type="hidden">
                              <input id="duration" name="duration" value=${request_obj.duration} type="hidden">
                              <input id="rate" name="rate" value=${request_obj.rate} type="hidden">
                              <input id = "time_slot_id" name = "time_slot_id" value = ${time_slots[0].time_slot_id} type="hidden">
                              <input id = "type" name = "type" value = ${request_obj.class_type} type="hidden">
                              <input id = "medium" name = "medium" value = ${request_obj.medium} type="hidden">
                              <input id = "time_slot_list" name = "time_slot_list" value = ${time_slot_ids} type="hidden">
                              <div class="dropdown">
                                   <button type="submit" class="yes" id="approve">Approve</button>
                              </div>
                         </form>
                    </div>

               </div>


          </div>`

               request_container.innerHTML += code;



               var closebtn = document.querySelector("#close_btn");

               closebtn.addEventListener('click', function() {
                    window.location = "http://localhost/unigura/tutor/dashboard";
               })


                document.getElementById('decline_btn').addEventListener('click', function() {
                              const url = "http://localhost/unigura/tutor/requestdecline?id=" + request[0].id;

                              fetch(url)
                                   .then(response => response.text())
                                   .then(data => {
                                       console.error(data);
                                        window.location = "http://localhost/unigura/tutor/dashboard";
                                   })
                                   .catch(error => {
                                        console.error(error);
                                   });
                         })
          </script>

          <?php Footer::render(
               [
                   'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
                   URLROOT . '/public/js/tutor/request-map-component.js',
               ]
          ); ?>