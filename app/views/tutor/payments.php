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
          URLROOT . '/public/css/tutor/base.css?v=2.2',
          URLROOT . '/public/css/tutor/style.css?v=2.3'
     ]
);

MainNavbar::render($request);
?>


<div class="Payments" style="height: 680px;">
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

     let payments = <?php echo $data['payments'] ?>;
     let root = '<?php echo URLROOT ?>';

     let payment_container = document.querySelector('.Payments_box');
     let table = document.createElement('div');
     for (const element of payments) {
          const fruit = 'apple';
          let payment_status;
          if (element.payment_status == 0) {
               payment_status = "PENDING";
          } else if (element.payment_status == 1) {
               payment_status = "PAID";
          } else {
               payment_status = "PAID OFF";
          }

          let year = element.Date.toString().slice(0,4);
          let month = element.Date.toString().slice(4,6);
          let day = element.Date.toString().slice(6,8);
          let month_text = new Date(Date.UTC(2023, parseInt(month)- 1, 1)).toLocaleString('default', { month: 'short' });
          console.log(month_text);



          let tr = document.createElement('tr');
          let cell1 = document.createElement('td');
          let cell2 = document.createElement('td');
          let cell3 = document.createElement('td');
          let cell4 = document.createElement('td');
          let cell5 = document.createElement('td');

          cell1.innerHTML  = `<img src="${root}/${element.profile_picture}">`;
          cell2.innerHTML  = `${element.first_name} ${element.last_name}</span>
                         <p>${element.module}</p>
                    `;
          cell3 .innerHTML = `${element.rate}`;
          cell4.innerHTML  = `<span style="border: 1px solid #7c7c8f9c;border-radius: 20px;padding: 5px;padding-left: 15px;padding-right: 15px;color: #7c7c8f9c;font-size: 14PX;">${payment_status}</span>`;
          cell5.innerHTML  = `<i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> ${month_text} ${day} ${year}</span>`;

          tr.appendChild(cell1);
          tr.appendChild(cell2);
          tr.appendChild(cell3);
          tr.appendChild(cell4);
          tr.appendChild(cell5);
          table.appendChild(tr);
     }
     payment_container.appendChild(table);
     console.log(payments);
</script>




<?php Footer::render(
     [
          URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
     ]
);
?>