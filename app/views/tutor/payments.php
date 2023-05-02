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
          URLROOT . '/public/css/tutor/style.css?v=2.6'
     ]
);

MainNavbar::render($request);
?>



<div class="Payments" style="height: 680px;">
     <div class="history">
          <div class="Payments_header">
               <h2>Payment History</h2>
               <div class="dropdown">
                    <select id="dropbtn" class="dropdown-content dropbtn">
                         <option value="last-week">Last Week</option>
                         <option value="last-month">Last Month</option>
                         <option value="last-year">Last Year</option>
                    </select>
               </div>

          </div>
          <div class="Payments_box">

          </div>
     </div>
     <div class="right_section">
          <div class="piechart">
               <h3>Payment Status</h3>
               <div class="grid">
                    <div class="part01">
                         <div id="monthly-pending" class="pen">
                              Pending : Rs.20000.00
                         </div>

                         <div id="monthly-earings" class="Rec"> Received : Rs.25000.00
                         </div>

                    </div>
                    <div></div>
                    <div class="container">
                         <span id="earing_percentage" class="circle">40%</span>
                         <canvas width="200" height="200"></canvas>
                    </div>
               </div>
          </div>

          <div class="chart-box">
               <h3>Monthly Earnings</h3>

               <div class="chart-container">
                    <ul id="chart">

                         <li>
                              <div class="count" id="jan_count"></div>
                              <span id="jan" style="height:5%;" title="Jan"></span>
                         </li>
                         <li>
                              <div class="count"  id="feb_count"></div>
                              <span id="feb" style="height:40%" title="Feb"></span>
                         </li>
                         <li>
                              <div class="count" id="mar_count"></div>
                              <span id="mar" style="height:100%" title="Mar"></span>
                         </li>
                         <li>
                              <div class="count" id="apr_count"></div>
                              <span id="apr" style="height:15%" title="Apr"></span>
                         </li>
                         <li>
                              <div class="count" id="may_count"></div>
                              <span id="may" style="height:35%" title="May"></span>
                         </li>
                         <li>
                              <div class="count" id="jun_count"></div>
                              <span id="jun" style="height:95%" title="Jun"></span>
                         </li>

                         <li>
                              <div class="count" id="jul_count"></div>
                              <span id="jul" style="height:22%" title="Jul"></span>
                         </li>
                         <li>
                              <div class="count" id="aug_count"></div>
                              <span id="aug" style="height:35%" title="Aug"></span>
                         </li>
                         <li>
                              <div class="count" id="sep_count"></div>
                              <span id="sep" style="height:45%" title="Sep"></span>
                         </li>
                         <li>
                              <div class="count" id="oct_count"></div>
                              <span id="oct" style="height:80%" title="Oct"></span>
                         </li>
                         <li>
                              <div class="count" id="nov_count"></div>
                              <span id="nov" style="height:25%" title="Nov"></span>
                         </li>
                         <li>
                              <div class="count" id="dec_count"></div>
                              <span id="dec" style="height:14%" title="Dec"></span>
                         </li>
                    </ul>
               </div>
          </div>
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
     let amounts = <?php echo $data['amounts'] ?>;
     let monthly_earns = <?php echo $data['monthlyearns'] ?>;


     let root = '<?php echo URLROOT ?>';

     let payment_container = document.querySelector('.Payments_box');


     list_payment(payments);
     let pending = amounts[0].Pending;
     let earning = amounts[0].Earns;

     document.getElementById('monthly-pending').innerHTML = `Pending : Rs. ${pending}`;
     document.getElementById('monthly-earings').innerHTML = `Earnings : Rs. ${earning}`;

     let earings_percentage = Math.floor(earning*100/(pending+earning));
     document.getElementById('earing_percentage').innerHTML = `${earings_percentage}%`





     function list_payment(payments) {
          let table = document.createElement('table');
          for (const element of payments) {
               let payment_status;
               if (element.payment_status == 0) {
                    payment_status = "PENDING";
               } else if (element.payment_status == 1) {
                    payment_status = "RECIVED";
               } else {
                    payment_status = "PAID-OFF";
               }

               console.log(element);
               
               let year = element.Date.slice(0,4);
               console.log(element.Date)
               let month = element.Date.toString().slice(5, 7);
               let day = element.Date.toString().slice(8, 10);
               let month_text = new Date(Date.UTC(2023, parseInt(month) - 1, 1)).toLocaleString('default', {
                    month: 'short'
               });
           

               let tr = document.createElement('tr');
               let cell1 = document.createElement('td');
               let cell2 = document.createElement('td');
               let cell3 = document.createElement('td');
               let cell4 = document.createElement('td');
               let cell5 = document.createElement('td');

               cell1.innerHTML = `<img src="${root}/${element.profile_picture}">`;
               cell2.innerHTML = `${element.first_name} ${element.last_name}</span>
                         <p>${element.module}</p>
                    `;
               cell3.innerHTML = `${element.rate}`;
               cell4.innerHTML = `<span   class='p_status ${payment_status.toLowerCase()}' >${payment_status}</span>`;
               cell5.innerHTML = `<i style="color:#7c7c8f9c ;font-size: 18px;" class="fas fa-calendar-alt"></i><span> ${month_text} ${day} ${year}</span>`;

    

               tr.appendChild(cell1);
               tr.appendChild(cell2);
               tr.appendChild(cell3);
               tr.appendChild(cell4);
               tr.appendChild(cell5);
               table.appendChild(tr);
          }
          payment_container.appendChild(table);
     
     }

     //pie chart
     let ctx = document.querySelector("canvas").getContext("2d");

     const results = [{
               mood: "Recived",
               total: earning,
               shade: "#ffa600"
          },
          {
               mood: "Pending",
               total: pending,
               shade: "#bdbbb84d"
          },
     ];

     let sum = 0;
     let totalNumberOfPeople = results.reduce((sum, {
          total
     }) => sum + total, 0);
     let currentAngle = 0;

     for (let moodValue of results) {
          //calculating the angle the slice (portion) will take in the chart
          let portionAngle = (moodValue.total / totalNumberOfPeople) * 2 * Math.PI;
          //drawing an arc and a line to the center to differentiate the slice from the rest
          ctx.beginPath();
          ctx.arc(100, 100, 100, currentAngle, currentAngle + portionAngle);
          currentAngle += portionAngle;
          ctx.lineTo(100, 100);
          //filling the slices with the corresponding mood's color
          ctx.fillStyle = moodValue.shade;
          ctx.fill();
     }

     


     document.addEventListener('DOMContentLoaded', function() {
          let dateRangeFilter = document.getElementById('dropbtn');
        

          dateRangeFilter.addEventListener('change', function() {
               var selectedOption = dateRangeFilter.value;
               payment_container.innerHTML = ''; //clear previous results

               console.log(selectedOption);

              // make fetch request to PHP backend with selected date range
               fetch(`${root}/tutor/payments/filterpayments`, {
                         method: 'POST',
                         body: new URLSearchParams({
                              dateRange: selectedOption
                         })
                    })
                    .then(function(response) {
                         if (!response.ok) {
                              throw new Error('Network response was not ok');
                         }
                         return response.text();
                    })
                    .then(function(responseText) {
                         // display results in data container
                         list_payment(JSON.parse(responseText));
                     
                    })
                    .catch(function(error) {
                         console.error('Error retrieving data:', error);

                    });
           });
     });


     //Monthly earnings
     let monthly_payment_obj  = monthly_earns[0];
     let maxVal = Math.max(...Object.values(monthly_payment_obj));
     console.log(monthly_payment_obj);

     document.getElementById('jan').style.height = `${Math.floor(monthly_payment_obj.JAN*100/maxVal)}%`
     document.getElementById('jan_count').innerText = monthly_payment_obj.JAN;


     document.getElementById('feb').style.height = `${Math.floor(monthly_payment_obj.FEB*100/maxVal)}%`
     document.getElementById('feb_count').innerText = monthly_payment_obj.FEB;


     document.getElementById('mar').style.height = `${Math.floor(monthly_payment_obj.MAR*100/maxVal)}%`
     document.getElementById('mar_count').innerText = monthly_payment_obj.MAR;


     document.getElementById('apr').style.height = `${Math.floor(monthly_payment_obj.APR*100/maxVal)}%`
     document.getElementById('apr_count').innerText = monthly_payment_obj.APR;


     document.getElementById('may').style.height = `${Math.floor(monthly_payment_obj.MAY*100/maxVal)}%`
     document.getElementById('may_count').innerText = monthly_payment_obj.MAY;


     document.getElementById('jun').style.height = `${Math.floor(monthly_payment_obj.JUN*100/maxVal)}%`
     document.getElementById('jun_count').innerText = monthly_payment_obj.JUN;


     document.getElementById('jul').style.height = `${Math.floor(monthly_payment_obj.JUL*100/maxVal)}%`
     document.getElementById('jul_count').innerText = monthly_payment_obj.JUL;


     document.getElementById('aug').style.height = `${Math.floor(monthly_payment_obj.AUG*100/maxVal)}%`
     document.getElementById('aug_count').innerText = monthly_payment_obj.AUG;

     document.getElementById('sep').style.height = `${Math.floor(monthly_payment_obj.SEP*100/maxVal)}%`
     document.getElementById('sep_count').innerText = monthly_payment_obj.SEP;


     document.getElementById('oct').style.height = `${Math.floor(monthly_payment_obj.OCT*100/maxVal)}%`
     document.getElementById('oct_count').innerText = monthly_payment_obj.OCT;



     document.getElementById('nov').style.height = `${Math.floor(monthly_payment_obj.NOV*100/maxVal)}%`
     document.getElementById('nov_count').innerText = monthly_payment_obj.NOV;

     document.getElementById('dec').style.height = `${Math.floor(monthly_payment_obj.DECE*100/maxVal)}%`
     document.getElementById('dec_count').innerText = monthly_payment_obj.DECE;






</script>




<?php Footer::render(
     [
          URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'
     ]
);
?>