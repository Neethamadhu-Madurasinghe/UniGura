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
          URLROOT . '/public/css/tutor/base.css?v=2.8',
          URLROOT . '/public/css/tutor/style.css?v=2.8',
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
                         <button class='msg_box button view-class' data-id = $id >View Details</button>
                         </div>
     
                          ";
                    }
                    ?>

               </div>

          </div>
          <div class="part_two">
               <div class="Student studnt-details-container">
                    <div style="display: grid;grid-template-columns: 1fr 1fr;">
                         <h2 id='student_name' style="margin-bottom: 20px;"></h2>
                         <h3 id='class-time' style="color: rgba(112, 124, 151, 1);text-align: right;margin-top: 13px;font-size: 17px;"></h3>
                    </div>

                    <div class="textbox_two">
                         <img class="img03" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/BookBookmark.png" style>
                         <p id='module_name' style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;"></p>
                         <img class="img04" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/cast.png">
                         <p id='mode' style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;"></p>
                    </div>
                    <div>
                         <button class="msg_box button" id='report'>Report</button>
                         <button class="msg_box button">Chat</button>
                         <button class="add_day button">Add Day</button>
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
     let viewbtns = document.querySelectorAll('.view-class');

     const urlParams = new URLSearchParams(window.location.search);

     const classid = urlParams.get('id'); 

     if(classid != null){
          showclass(classid);
          console.log('Have')
     }else{
          console.log('csss')
     }


     viewbtns.forEach(btn => {
          btn.addEventListener('click', () => showclass(btn.dataset.id))
     })


     function showclass(id){
               const url = "http://localhost/unigura/tutor/getclassdetails?id=" + id;
               fetch(url)
                    .then(response => response.json())
                    .then(data => {
                         document.querySelector('.studnt-details-container').style.display = 'block';

                         let list = data['data'][0];


                         let student_name = document.getElementById('student_name');
                         let module_name = document.getElementById('module_name');
                         let mode = document.getElementById('mode');
                         let day_container = document.querySelector('.half');
                         let reportBtn = document.querySelector('.reportBtn');
                         let classtime = document.querySelector('class-time');

                         day_container.innerHTML = '';

                         document.querySelector('.add_day').addEventListener('click', () => {
                              window.location = `http://localhost/unigura/tutor/createcustomday?id=${list.id}`
                         })

                         switch (list.date) {
                              case 'mon':
                                   document.getElementById('class-time').innerText = `Class on Monday ${list.time}`;
                                   break

                              case 'tue':
                                   document.getElementById('class-time').innerText = `Class on Tuesday ${list.time}`;
                                   break

                              case 'wed':
                                   document.getElementById('class-time').innerText = `Class on Wednesday ${list.time}`;
                                   break

                              case 'thu':
                                   document.getElementById('class-time').innerText = `Class on Thursday ${list.time}`;
                                   break

                              case 'fri':
                                   document.getElementById('class-time').innerText = `Class on Friday ${list.time}`;
                                   break

                              case 'sat':
                                   document.getElementById('class-time').innerText = `Class on Saturday ${list.time}`;
                                   break

                              case 'sun':
                                   document.getElementById('class-time').innerText = `Class on Sunday ${list.time}`;
                                   break
                         }

                         student_name.innerHTML = list.first_name + " " + list.last_name;
                         module_name.innerHTML = list.name + list.class_type;
                         mode.innerHTML = list.mode;

                         document.getElementById('report').addEventListener('click', () => {
                              window.location = `http://localhost/unigura/tutor/view-report?student_id=${list.student_id}`;
                         })

                         let days = data['days'];
                         let activities = data['activities'];

                         for (let i = 0; i < days.length; i++) {
                              let day = days[i];
                              let status;
                              let checkbox = ``;
                              //is_hidden = 1 ---> hide 0 --> show
                              if (day.is_hidden == 0) {
                                   status = `<i  data-id = ${day.dayid} class="fa fa-eye hide-btn" style="font-size:19px;color: rgba(112, 124, 151, 0.678); margin-right:10px" ></i> <i class="fa fa-eye-slash unhide-btn" data-id=${day.dayid} style="font-size:19px; color: rgba(112, 124, 151, 0.678); display:none" ></i>`;

                              } else if (day.is_hidden = 1) {
                                   status = `<i  data-id = ${day.dayid} class="fa fa-eye hide-btn" style="font-size:19px;color: rgba(112, 124, 151, 0.678); margin-right:10px; display:none" ></i> <i class="fa fa-eye-slash unhide-btn" data-id=${day.dayid} style="font-size:19px; color: rgba(112, 124, 151, 0.678);" ></i>`;
                              } else {
                                   console.log('Error')
                              }

                              let payment_status;

                              if (day.payment_status == 0 && day.is_completed == 1) {
                                   payment_status = `not paid`
                              } else if (day.payment_status == 1 && day.is_completed == 1) {
                                   payment_status = `paid`
                              } else if (day.is_completed == 0) {
                                   payment_status = ``;
                              }

                              if (day.is_completed == 1) {
                                   checkbox = `<input class = 'checkmark-input' type="checkbox" data-id=${day.dayid} checked><span class="checkmark" ></span>`;
                              } else {
                                   checkbox = `<input class='checkmark-input' type="checkbox" data-id=${day.dayid}><span class="checkmark" ></span>`;
                              }

                              let code = `<div class="day_box" style="margin-top: 0px;" id=${day.dayid}>
                                   <div style="display: grid;grid-template-columns: 8fr 1fr 1fr;border-bottom:2px solid  rgba(112, 124, 151, 0.151) ;padding-bottom: 5px;">
                                        <h4>Day ${day.position} - ${day.title}</h4>
                                        <label class="container">
                                             ${status}
                                        </label>
                                        <label class = "container">
                                             ${checkbox}
                                        </label>
                                   </div>
                                   <div class='textbox-one' id='text${day.dayid}'></div>
                                   <p  class = "Payment"; style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;">${payment_status}</p>
                                   <button class='left add-activity' data-id=${day.dayid} ><i class='fa-solid fa-plus'></i></button>
                              </div>`

                              day_container.innerHTML += code;

                              for (key in activities) {
                                   let element = activities[key];
                                   if (element.day_id == day.dayid) {
                                        if (element.type == 0) {
                                             day_container.querySelector(`#text${day.dayid}`).innerHTML += `<img class='activity-icon' src='http://localhost/UniGura/public/img/tutor/class/icons/file.png' style="width: 6%; height:6%; margin-top: 9px; border-radius : 0%" >
                                                  <a style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 1px;' href = "http://localhost/unigura/tutor/viewactivitydoc?file=${element.link}">${element.description}</a><br>`
                                        } else if (element.type == 1) {
                                             if (element.is_completed == 0) {
                                                  day_container.querySelector(`#text${day.dayid}`).innerHTML += `<img class='activity-icon' src='http://localhost/UniGura/public/img/tutor/class/icons/share-arrow.png'  style="width: 6%; height:6%; margin-top: 9px; border-radius : 0%" >
                                                  <a style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;' >${element.description}</a><br>`
                                             } else if (element.is_completed == 1) {
                                                  day_container.querySelector(`#text${day.dayid}`).innerHTML += `<img class='activity-icon' src='http://localhost/UniGura/public/img/tutor/class/icons/share-arrow.png' style="width: 6%; height:6%; margin-top: 9px; border-radius : 0%" >
                                                  <a style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 1px;' href = "http://localhost/unigura/tutor/viewactivitydoc?file=${element.link}">${element.description}</a><br>`
                                             }

                                        } else if (element.type == 2) {
                                             day_container.querySelector(`#text${day.dayid}`).innerHTML += `<img class='activity-icon' src='http://localhost/UniGura/public/img/tutor/class/icons/cast.png'  style="width: 6%; height:6%; margin-top: 9px; border-radius : 0%" >
                                                  <a style='color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;'>${element.description}</a><br>`
                                        }

                                   }
                              }

                         }


                         var addactivitybtns = document.querySelectorAll(".add-activity");
                         addactivitybtns.forEach(btn => {
                              btn.addEventListener('click', function() {
                                   window.location = `http://localhost/unigura/tutor/add-activity-inclass?id=${btn.getAttribute('data-id')}`;
                              })
                         })

                         var hidebtns = document.querySelectorAll(".hide-btn");
                         hidebtns.forEach(hidebtn => {
                              hidebtn.addEventListener('click', function() {
                                   const url = "http://localhost/unigura/tutor/markdayashide";
                                   fetch(url, {
                                             method: 'POST',
                                             body: JSON.stringify({
                                                  day_id: hidebtn.getAttribute('data-id')
                                             })
                                        })
                                        .then(function(response) {
                                             if (!response.ok) {
                                                  throw new Error('Network response was not ok');
                                             }
                                             return response.text();
                                        })
                                        .then(function(responseText) {
                                             hidebtn.nextElementSibling.style.display = 'block';
                                             hidebtn.style.display = 'none';
                                        })
                                        .catch(function(error) {
                                             console.error('Error retrieving data:', error);
                                        });
                              })
                         })


                         var unhidebtns = document.querySelectorAll(".unhide-btn");
                         unhidebtns.forEach(unhidebtn => {
                              unhidebtn.addEventListener('click', function() {
                                   const url = "http://localhost/unigura/tutor/markdayasunhide";
                                   fetch(url, {
                                             method: 'POST',
                                             body: JSON.stringify({
                                                  day_id: unhidebtn.getAttribute('data-id')
                                             })
                                        })
                                        .then(function(response) {
                                             if (!response.ok) {
                                                  throw new Error('Network response was not ok');
                                             }
                                             return response.text();
                                        })
                                        .then(function(responseText) {
                                             unhidebtn.previousElementSibling.style.display = 'block';
                                             unhidebtn.style.display = 'none';

                                        })
                                        .catch(function(error) {
                                             console.error('Error retrieving data:', error);
                                        });
                              })
                         })


                         var checkmark_inputs = document.querySelectorAll('.checkmark-input');
                         checkmark_inputs.forEach(input => {
                              input.addEventListener('change', function() {
                                   if (input.checked) {
                                        const url = "http://localhost/unigura/tutor/markdayascomplete";
                                        fetch(url, {
                                                  method: 'POST',
                                                  body: JSON.stringify({
                                                       day_id: input.getAttribute('data-id')
                                                  })
                                             })
                                             .then(function(response) {
                                                  if (!response.ok) {
                                                       throw new Error('Network response was not ok');
                                                  }
                                                  return response.text();
                                             })
                                             .then(function(responseText) {
                                                  console.log('ok');
                                             })
                                             .catch(function(error) {
                                                  console.error('Error retrieving data:', error);
                                             });
                                   }


                              })
                         })


                         var draggableItems = document.querySelectorAll(".day_box");
                         var draggingItem = null;
                         var originalIndex = null;

                         // Define a data object to store the position of the elements
                         var positionData = {};

                         // Initialize the data object with the initial position of the elements
                         for (var i = 0; i < draggableItems.length; i++) {
                              positionData[draggableItems[i].id] = i + 1;
                         }

                         for (var i = 0; i < draggableItems.length; i++) {
                              draggableItems[i].addEventListener("dragstart", function(e) {
                                   draggingItem = this;
                                   originalIndex = Array.prototype.indexOf.call(this.parentNode.children, this);
                              });

                              draggableItems[i].addEventListener("dragover", function(e) {
                                   e.preventDefault();
                                   this.style.backgroundColor = "lightgray";
                              });

                              draggableItems[i].addEventListener("dragleave", function(e) {
                                   this.style.backgroundColor = "";
                              });

                              draggableItems[i].addEventListener("drop", function(e) {
                                   if (draggingItem !== this) {
                                        var newIndex = Array.prototype.indexOf.call(this.parentNode.children, this);
                                        var temp = this.id;
                                        this.id = draggingItem.id;
                                        draggingItem.id = temp;

                                        var temphtml = this.innerHTML;
                                        this.innerHTML = draggingItem.innerHTML;
                                        draggingItem.innerHTML = temphtml;

                                        draggableItems[originalIndex].style.backgroundColor = "";
                                        originalIndex = newIndex;
                      

                                        // Update the position data object with the new position of the elements
                                        var tempPositionData = {};

                                        for (var i = 0; i < draggableItems.length; i++) {
                                             tempPositionData[draggableItems[i].id] = i + 1;
                                        }
                                        positionData = tempPositionData;
                                        console.log(positionData);
                                        sendPositon(positionData);
                                   }
                                   this.style.backgroundColor = "";
                              });
                         }



                    })
                    .catch(error => {
                         let container = document.querySelector('.studnt-details-container');
                         container.innerHTML = `<div>Requested Class Not Exists</div>`
                         document.querySelector('.studnt-details-container').style.display = 'block';
                    });
          }
     

     function sendPositon(position_list) {
          fetch('http://localhost/unigura/tutor/sendpositioninclass', {
                    method: 'POST',
                    headers: {
                         'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                         data: position_list
                    })
               })
               .then(response => response.json())
               .then(data => {
                    console.log(`success : ${data}`);
               })
               .catch((error) => {
                    console.error('Have Error');
               });
     }
</script>


<?php Footer::render(
     [
          URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
     ]
);
?>