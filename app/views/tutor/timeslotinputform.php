<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/common/inc/components/LandingPageNavBar.php';

$navbar = new LandingPageNavBar($request);

Header::render(
    'Complete Profile',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/complete-bank.css?v=2.3'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>


<div class="pop-time-table">
    <h1>Select time slots</h1>
    <div class="time-table-container">
        <table id="time-table">
            <tr class="time-table-titles">
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Satday</th>
                <th>Sunday</th>
            </tr>
            <tr>
                <th>8.00-10.00</th>
                <td class="slot slot-free " data-day="mon" data-time="08:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="08:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="08:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="08:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="08:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="08:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="08:00:00" data-state=0></td>
            </tr>

            <tr>
                <th>10.00-12.00</th>
                <td class="slot slot-free " data-day="mon" data-time="10:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="10:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="10:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="10:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="10:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="10:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="10:00:00" data-state=0></td>
            </tr>

            <tr>
                <th>12.00-14.00</th>
                <td class="slot slot-free " data-day="mon" data-time="12:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="12:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="12:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="12:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="12:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="12:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="12:00:00" data-state=0></td>
            </tr>

            <tr>
                <th>14.00-16.00</th>
                <td class="slot slot-free " data-day="mon" data-time="14:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="14:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="14:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="14:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="14:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="14:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="14:00:00" data-state=0></td>
            </tr>

            <tr>
                <th>16.00-18.00</th>
                <td class="slot slot-free " data-day="mon" data-time="16:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="16:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="16:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="16:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="16:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="16:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="16:00:00" data-state=0></td>
            </tr>
            <tr>
                <th>18.00-20.00</th>
                <td class="slot slot-free " data-day="mon" data-time="18:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="18:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="18:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="18:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="18:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="18:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="18:00:00" data-state=0></td>
            </tr>

            <tr>
                <th>20.00-22.00</th>
                <td class="slot slot-free " data-day="mon" data-time="20:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="20:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="20:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="20:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="20:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="20:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="20:00:00" data-state=0></td>
            </tr>

            <tr>
                <th>20.00-22.00</th>
                <td class="slot slot-free " data-day="mon" data-time="22:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="tue" data-time="22:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="wed" data-time="22:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="thu" data-time="22:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="fri" data-time="22:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sat" data-time="22:00:00" data-state=0></td>
                <td class="slot slot-free " data-day="sun" data-time="22:00:00" data-state=0></td>
            </tr>


        </table>
    </div>

</div>
<div id="submit-btn-container">
    <input type="submit" id="submit" value="Finish" class="btn">
</div>


<script>
    let tableRows = document.querySelectorAll('.slot');
    const submit = document.querySelector('#submit');


    for (var i = 0; i < tableRows.length; i++) {
        tableRows[i].addEventListener("click", function() {
            this.setAttribute("data-state", 1);
            this.classList.remove("slot-free");
            this.classList.add("slot-selected");
        });
    }


    submit.addEventListener('click', convertdata);

    function convertdata() {
        let time_slots = [];
        for (let i = 0; i < tableRows.length; i++) {
            let row = tableRows[i];
            let day = row.dataset.day;
            let time = row.dataset.time;
            let state = row.dataset.state;
            time_slots.push({
                id: i,
                day: day,
                time: time,
                state: state
            });

        }
        //convert the json object to a string and store it in a hidden input field

     
        fetch('http://localhost:8080/unigura/tutor/tutor-time-slot-inputs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    data: time_slots
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                window.location.href = 'http://localhost:81/unigura/tutor/dashboard';
            })
            .catch((error) => {
                console.error('Have Error');
            });




    }
</script>
</div>
</div>




<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js'

    ]
); ?>