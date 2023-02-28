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
        URLROOT . '/public/css/tutor/base.css?v=2.1',
        URLROOT . '/public/css/tutor/style.css?v=2.3'
    ]
);

MainNavbar::render($request);
?>


<div class="Payments">
          <div class="Payments_header">
               <h2>Payment History</h2>
               <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn" style="display: grid;grid-template-columns: 5fr 1fr;">Today<i class="fa fa-caret-down" style="font-size:16px; text-align: right;"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                      <a href="#">Today</a>
                      <a href="#">Yesterday</a>
                      <a href="#">Last 7 days</a>
                      <a href="#">Last 30 days</a>
                      <a href="#">This month</a>
                    </div>
                  </div>
          
          </div>
          <div class="Payments_box">
               <table>
                              <tr>
                                   <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.900/=</td>
                                   <td><span style="border: 1px solid #ff8f0e;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #ff8f0e;font-size: 14PX;">PAIDOFF</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                              </tr>
                              <tr>
                              <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.900/=</td>
                                   <td><span style="border: 1px solid #08ad029c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #08ad029c;font-size: 14PX;">RECEIVED</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                              </tr>
                              <tr>
                                   <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.900/=</td>
                                   <td><span style="border: 1px solid #7c7c8f9c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #7c7c8f9c;font-size: 14PX;">PENDING</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                                   </tr>
                              <tr>
                                   <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.900/=</td>
                                   <td><span style="border: 1px solid #7c7c8f9c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #7c7c8f9c;font-size: 14PX;">PENDING</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                              </tr>
                              <tr>
                                   <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.800/=</td>
                                   <td><span style="border: 1px solid #ff8f0e;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #ff8f0e;font-size: 14PX;">PAIDOFF</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                              </tr>
                              <tr>
                                   <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.900/=</td>
                                   <td><span style="border: 1px solid #7c7c8f9c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #7c7c8f9c;font-size: 14PX;">PENDING</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                              </tr>
                              <tr>
                                   <td><img src="<?php echo URLROOT ?>/public/img/tutor/class/images/user.jpg" ></td>
                                   <td>Dasun Shanaka</span><p>Organic</p></td>
                                   <td>Rs.800/=</td>
                                   <td><span style="border: 1px solid #ff8f0e;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #ff8f0e;font-size: 14PX;">PAIDOFF</span></td>
                                   <td><i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> FEB 10 2023</span></td>
                            </tr>  
                  </table>
          </div>
     </div>

     <script> 
          /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
     </script>

   


<?php Footer::render(
    [
     URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
    ]
);
?>