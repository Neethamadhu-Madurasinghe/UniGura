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
          URLROOT . '/public/css/tutor/forms.css?v=1.5'
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
                                   <option value="1">Submission</option>
                                   <option value="2">Text</option>
                              </select>
                         </div>
                         <div class="dropdown">
                              <div Class="Uploadbox">
                                   <div>
                                        <input name="id" id='id' type="hidden">
                                        <input name="subject" id='subject' type="hidden">
                                        <input name="module" id='module' type="hidden">
                                        <input name="c_id" id='cid' type="hidden">

                                        <input style="width : 100% " name='description' type="text" required>
                                        <input type="file" id="activity-doc" name="activity-doc" required style="opacity: 0; width: 0; height: 0;"  />
                                   </div>
                                   <label for="activity-doc" class="upload_label">Upload</label>
                              </div>
                         </div>

                    </div>
                    <button>Create</button>
               </form>

          </div>


          <script>
               let root = '<?php echo URLROOT ?>';
               let data_string = '<?php echo json_encode($data) ?>';
               
               
               
          </script>

          <?php Footer::render(
               [ URLROOT . '/public/js/tutor/addactivitytemplate.js']
          ); ?>