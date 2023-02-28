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
        URLROOT . '/public/css/tutor/dashboard.css?v=1.8'
    ]
);

MainNavbar::render($request);
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';


Header::render(
    'Create Class',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/forms.css?v=1.1'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>

<div class="lightbox" >
     <div class="box" style="width: 30%; margin-left: 35%;">
          <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Add Document</h2>
          <button class="close"><i class="fa fa-times"></i></button>
          <div class="form_container">
               <form action="" id="complete-profile-form" method="POST" enctype='multipart/form-data'>
                   
               <div>  
                    <!-- <div class="dropdown">
                         <div class="dropdown_name">
                              <label for="Mode">Type</label>
                         </div>
                         <select id="Mode" name="Mode">
                              <option value="Upload Link">Upload Link</option>
                              <option value="Document">Document</option>
                              <option value="Reference">Reference</option>
                         </select>
                    </div> -->
                    <!-- <div class="dropdown">
                         <div class="dropdown_name">
                              <label for="Session Fee">Upload Link</label>
                         </div>
                         <input style="width:96%;" type="text">
                         <div>

                    </div> -->

                    <div class="dropdown" >
                         <div Class="Uploadbox">
                              <div>
                              <input  type="text">
                              <input name="id" value="<?php echo $data['id'] ?>" >
                              <input type="file" id="actual-identity-card-btn" name="id-copy" />
                              </div>
                              <button class="upload_btn">Upload</button>
                         </div>
                    </div>

               </div>
               <button>Create</button>


                    </form>
     
     </div>

    <?php Footer::render(
        []
    ); ?>