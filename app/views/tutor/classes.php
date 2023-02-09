
<?php 


/**
 * @var $data
 * @var $request
 */




require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/tutor/inc/components/MainNavbar.php';

Header::render(
    'Tutor Classes',
    [
        URLROOT . '/public/css/tutor/base.css?v=1.8',
        URLROOT . '/public/css/tutor/style.css?v=1.9'
    ]
);
MainNavbar::render($request);
?>

<div class="classes">
    <div class="notification">
        <div class="New_Student_Request">
            <h2>Active Classes</h2>
            <div class="msg_container_one">
                <div class="msg_box_one">
                    <header>
                        <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                        <h4 style="margin-top: 5%;">Sachithra Kavinda</h4>
                    </header>
                    <div class="textbox_one">
                    <img src="<?php echo URLROOT ?>/public/img/tutor/class/icons/BookBookmark.png">
                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Mechanics Theory</p>
                        <img src="<?php echo URLROOT ?>/public/img/tutor/class/icons/cast.png">
                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Online</p>
                    </div>
                    <button class="msg_box button">View Details</button>
                </div>
                <div class="msg_box_one">
                    <header>
                        <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                        <h4 style="margin-top: 5%;">Viraj</h4>
                    </header>
                    <div class="textbox_one">
                        <img src="<?php echo URLROOT ?>/public/img/tutor/class/icons/BookBookmark.png">
                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Mechanics Theory</p>
                        <img src="<?php echo URLROOT ?>/public/img/tutor/class/icons/cast.png">
                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Online</p>
                    </div>
                    <button class="msg_box button">View Details</button>
                </div>
                <div class="msg_box_one">
                    <header>
                    <img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg">
                        <h4 style="margin-top: 5%;">Sachithra Kavinda</h4>
                    </header>
                    <div class="textbox_one">
                    <img src="<?php echo URLROOT ?>/public/img/tutor/class/icons/BookBookmark.png">
                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Mechanics Theory</p>
                        <img src="<?php echo URLROOT ?>/public/img/tutor/class/icons/cast.png">
                        <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Online</p>
                    </div>
                    <button class="msg_box button">View Details</button>
                </div>
            </div>

        </div>
        <div class="part_two">
         <div class="Student">
               <div style="display: grid;grid-template-columns: 1fr 1fr;">
               <h2 style="margin-bottom: 20px;">Sachithra Kavinda</h2>
               <h3 style="color: rgba(112, 124, 151, 1);text-align: right;margin-top: 13px;font-size: 17px;">Started on 22June 2022</h3>
               </div>
               <img style="position: absolute;right: 150px;width: 10%;"  src="<?php echo URLROOT ?>/public/img/tutor/class/images/progres.png">
               <div class="textbox_two">
                    <img class="img03"  src="<?php echo URLROOT ?>/public/img/tutor/class/icons/BookBookmark.png" style>
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Mechanics Theory</p>
                    <img class="img04" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/cast.png">
                    <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Online</p>
                    </div>
                    <div>
                         <button class="msg_box button">report</button>
                         <button class="msg_box button">Chat</button>
                    </div>
                    
               <div class="day_box_container">
               <div class="half">
                    
                    <div class="day_box" style="margin-top: 0px;">
                         <div  style="display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid rgba(112, 124, 151, 0.151);padding-bottom: 5px;">
                         <h4 >Day 01 - Newton Law</h4>
                         <label class="container">
                              <input type="checkbox" checked="checked">
                              <span class="checkmark"></span>
                         </label>

                    </div>
                         <div class="textbox_one">
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Question</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Upload answers</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/share-arrow.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Try to Answer all the Question</p>
                              </div>
                         <p style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;">Paid</p>
                    </div>
                    <div class="day_box" style="margin-top: 0px;">
                         <div  style="display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid  rgba(112, 124, 151, 0.151) ;padding-bottom: 5px;">
                         <h4 >Day 02 - Newton Law</h4>
                         <label class="container">
                              <input type="checkbox" checked="checked">
                              <span class="checkmark"></span>
                         </label>

                    </div>
                         <div class="textbox_one">
                         <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Question</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/share-arrow.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Upload answers</p>
                              <img class="img02" >
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Try to Answer all the Question</p>
                              </div>
                         <p style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;">Payment Due</p>
                    </div>
                    <div class="day_box" style="margin-top: 0px;">
                         <div  style="display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid  rgba(112, 124, 151, 0.151) ;padding-bottom: 5px;">
                         <h4 >Day 03 - Newton Law</h4>
                         <i class="fa fa-eye-slash" style="font-size:19px;color: rgba(112, 124, 151, 0.678);" title="Hide"></i>

                    </div>
                    <div class="textbox_one">
                         <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Question</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/share-arrow.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Upload answers</p>
                              <img class="img02" >
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Try to Answer all the Question</p>
                              </div>
                         <p style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;"></p>
                    </div>
                    <div class="day_box" style="margin-top: 0px;">
                         <div  style="display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid  rgba(112, 124, 151, 0.151) ;padding-bottom: 5px;">
                         <h4 >Day 04 - Newton Law</h4>
                         <i class="fa fa-eye-slash" style="font-size:19px;color: rgba(112, 124, 151, 0.678);" title="Hide"></i>

                    </div>
                    <div class="textbox_one">
                         <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Question</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/share-arrow.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Upload answers</p>
                              <img class="img02" >
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Try to Answer all the Question</p>
                              </div>
                         <p style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;"></p>
                    </div>
                    <div class="day_box" style="margin-top: 0px;">
                         <div  style="display: grid;grid-template-columns: 10fr 1fr;border-bottom:2px solid  rgba(112, 124, 151, 0.151) ;padding-bottom: 5px;">
                         <h4 >Day 05 - Newton Law</h4>
                         <i class="fa fa-eye-slash" style="font-size:19px;color: rgba(112, 124, 151, 0.678);" title="Hide"></i>


                    </div>
                    <div class="textbox_one">
                         <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Tute</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/file.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Question</p>
                              <img class="img02" src="<?php echo URLROOT ?>/public/img/tutor/class/icons/share-arrow.png">
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Upload answers</p>
                              <img class="img02" >
                              <p style="color: rgba(112, 124, 151, 1) ; margin-top: 8px;text-align: justify;margin-bottom: 0px;">Try to Answer all the Question</p>
                              </div>
                         <p style="text-align: right;font-size: 17px;font-weight: 600;color:#f7721adc; margin-top: 5px;"></p>
                    </div>
                    
                    </div>
               </div>
          </div>  
     </div>
    </div>
</div>



<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
    ]
);

?>