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
     'Tutor Classes',
     [
          URLROOT . '/public/css/tutor/base.css?v=2.9',
          URLROOT . '/public/css/tutor/style.css?v=2.0',


     ]
);
MainNavbar::render($request);
?>

<div class="classes">
     <div class="Active-class">
          <div class="Active-class-container">
               <h2>Active Classes</h2>
               <div class="container_one">
                    <?php
                    $classes = json_decode($data['tutor_classes']);
                    foreach ($classes as $class) {
                         $array = (array) $class;
                         $id = (string) $array['classid'];
                         $first_name = (string) $array['first_name'];
                         $last_name = (string) $array['last_name'];
                         $mode = (string) $array['mode'];
                         $module = (string) $array['name'];
                         $class_type = (string) $array['class_type'];
                         $profile_picture = (string) $array['profile_picture'];
                         $root = URLROOT;
                         $studentID = $array['student_id'];


                         echo "
                        <div class='box_one'>
                    <header>
                        <img src= 'http://localhost/UniGura/$profile_picture'>
                        <h4 style='margin-top: 5%;'>$first_name $last_name</h4>
                    </header>
                    <div class='textbox_one'>
                    <img style='border-radius: 0%;'  src='$root/public/img/tutor/class/icons/BookBookmark.png'>
                        <p style='color: rgba(112, 124, 151, 1) ; margin-top: 0px;text-align: justify;margin-bottom: 0px;'>$module $class_type</p>
                        <img style='border-radius: 0%;'  src='$root/public/img/tutor/class/icons/cast.png'>
                        <p style='color: rgba(112, 124, 151, 1) ; margin-top: 0px;text-align: justify;margin-bottom: 0px;'>$mode</p>
                    </div>
                    <button class='msg_box button' data-id = $id >View Details</button>
                </div>
     
                          ";
                    }
                    ?>

               </div>

          </div>
          <div class="part_two">
               <div class="Student">
                    <div style="display: grid;grid-template-columns: 1fr 1fr;">
                         <h2 id='student_name' style="margin-bottom: 20px;">Sachithra Kavinda</h2>
                         <h3 style="color: rgba(112, 124, 151, 1);text-align: right;margin-top: 13px;font-size: 17px;">Started on 22June 2022</h3>
                    </div>
                    <img style="position: absolute;right: 150px;width: 10%;" src="<?php echo URLROOT ?>/public/img/tutor/class/images/progres.png">
                    <div class="textbox_two">
                         <img class="img03" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/BookBookmark.png" style>
                         <p id='module_name' style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Mechanics Theory</p>
                         <img class="img04" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/cast.png">
                         <p id='mode' style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Online</p>
                    </div>
                    <div>
                         <button class="msg_box button" id='report'>Report</button>
                         <button class="msg_box button">Chat</button>
                    </div>

                    <div class="day_box_container">
                         <div class="half">


                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<script>
     let viewbtns = document.querySelectorAll('.msg_box');




     viewbtns.forEach(btn => {
          btn.addEventListener('click', function() {
               const url = "http://localhost/unigura/tutor/getclassdetails?id=" + btn.dataset.id;
               fetch(url)
                    .then(response => response.json())
                    .then(data => {
                         let list = data['data'][0];
                         console.log(list);

                         let student_name = document.getElementById('student_name');
                         let module_name = document.getElementById('module_name');
                         let mode = document.getElementById('mode');
                         let day_container = document.querySelector('.half');
                         let reportBtn = document.querySelector('.reportBtn');

                         day_container.innerHTML = '';


                         student_name.innerHTML = list.first_name + " " + list.last_name;
                         module_name.innerHTML = list.name + list.class_type;
                         mode.innerHTML = list.mode;

                         console.log(list);

                         document.getElementById('report').addEventListener('click', () => {
                              window.location = `http://localhost/unigura/tutor/view-report?student_id=${list.student_id}`;
                         })

                         let days = data['days'];

                         console.log(data['days']);

                         for (let i = 0; i < days.length; i++) {
                              let day = days[i];

                              let status = `<i class="fa fa-eye-slash" style="font-size:19px;color: rgba(112, 124, 151, 0.678);" title="Hide"></i>`;

                              if (day.is_hidden == 0) {

                                   status = `<i class="fa fa-eye-slash" style="font-size:19px;color: rgba(112, 124, 151, 0.678);" title="Hide"></i>`;
                              } else if (day.is_hidden = 1) {
                                   status = ` <input  type="checkbox" checked="checked"><span class="checkmark"></span>`
                              } else {
                                   console.log('Error')
                              }

                              let code = ` <div class="day_box" style="margin-top: 0px;">
                                   <div style="display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid  rgba(112, 124, 151, 0.151) ;padding-bottom: 5px;">
                                        <h4>Day ${day.position} - ${day.title}</h4>
                                        <label class="container">
                                             ${status}
                                        </label>
                                        
                                   </div>
                                   <div class="textbox_one">
                                        <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>

                                        <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>

                                        <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/share-arrow.png">
                                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>

                                        <img class="img02">
                                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>

                                   </div>
                                   <p  class = "Payment"; style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;">Payment Due</p>
                              </div>`

                              day_container.innerHTML += code;
                         }

                    })
                    .catch(error => {
                         console.error(error);
                    });
          })
     })
</script>


<?php Footer::render(
     [
          URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
     ]
);
?>