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
          URLROOT . '/public/css/tutor/forms.css?v=1.8'
     ]
     //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox">
     <div class="box" style="width: 30%; margin-left: 35%;">
          <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Add Document</h2>
          <button class="close"><i class="fa fa-times"></i></button>
          <div class="form_container">
               <form action="" id="complete-profile-form" method="POST" enctype='multipart/form-data'>

                    <div>
                         <div class="dropdown">
                              <div class="dropdown_name">
                                   <label for="Mode">Activity Type</label>
                              </div>
                              <select id="type" name="type">
                                   <option value="0">Tute</option>
                                   <option value="1">Submition</option>
                                   <option value="2">Text</option>
                              </select>
                         </div>
                         <div class="dropdown">
                              <div Class="Uploadbox">
                                   <div>
                                        <input name="id" value="<?php echo $data['id'] ?>" type="hidden">
                                        <input name="class_id" value="<?php echo $data['class_id'] ?>" type="hidden">
                                        <input id='title' style="width : 100% ;" name='description' type="text">
                                        <input type="file" id="activity-doc" name="activity-doc" hidden />
                                   </div>
                                   <label for="activity-doc" class="upload_label">Upload</label>
                              </div>
                         </div>
                    </div>
                    <button>Create</button>
               </form>

          </div>

          <script>
               var closebtn = document.querySelector(".close");
               let class_id = `<?php echo $data['class_id'] ?>`
               closebtn.addEventListener('click', function() {
                    window.location = `http://localhost/unigura/tutor/classes?id=${class_id}`;
               })

               const select = document.getElementById('type');
               const upload_btn = document.querySelector('.upload_label');
               const title = document.getElementById('title');

               select.addEventListener('change', () => {
                    // Get the selected value
                    const selectedValue = select.value;
                    // Show/hide the divs based on the selected value
                    if (selectedValue === '0') {
                         upload_btn.style.display = 'block';
                    } else if (selectedValue === '1') {
                         upload_btn.style.display = 'none';
                    } else if (selectedValue === '2') {
                         upload_btn.style.display = 'none';
          
                    } else {
                         
                    }
               });
          </script>

          <?php Footer::render(
               []
          ); ?>