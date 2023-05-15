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
    'Start a Chat',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        //URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/forms.css',
    ]

);

?>

<div class="lightbox">
    <div class="box" style="width: 30%; margin-left: 35%;">
        <h2 style="text-align: center;width: 100%;padding-bottom: 10px; font-weight: 400;">Start a Chat</h2>
        <button class="close"><i class="fa fa-times"></i></button>
        <div class="form_container">
            <form action="view-report" method="POST" enctype='multipart/form-data'>
                <div class="form-container"> </div>

              

                <label for="description">Message </label><br><br>
                <span id="error"></span>
                <textarea id="description" name="description" rows="5" cols="30"></textarea><br><br>

                <div class="create-btn">
                    <button type="submit" id="submit">Submit</button>
                </div>

            </form>

        </div>


        <script>
  
            let class_id = <?php echo $data['class_id'] ?>;
            let student_id = <?php echo $data['student_id'] ?>;
       
            
            document.querySelector('.close').addEventListener('click', () => {
                window.location = `http://localhost/unigura/tutor/classes?id=${class_id}`;
            });

            const messageSendBtn = document.getElementById("submit");
            const messageInputField = document.getElementById("description");
            const errorMessage = document.getElementById("error");
            let chosenTutorId;


            // Send
            messageSendBtn.addEventListener("click", async (e) => {
                e.preventDefault();
                const message = messageInputField.value.trim();

                if(message.length <= 0) {
                    errorMessage.textContent = "Please enter a valid message";
                    setInterval(() => errorMessage.textContent = "", 1000)
                }else {
                    const result = await fetch('http://localhost/unigura/api/chat/send-single-message', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"

                        },
                        body: JSON.stringify({
                            message,
                            receiver: student_id
                        })
                    });

                    const status = result.status;


                    if(status === 200) {
                        window.location = `http://localhost/unigura/tutor/classes?id=${class_id}`;
                    } else if(status === 401) {
                        const data = await result.text();
                        errorMessage.textContent = "Please login to send message";
                        setInterval(() => {
                            errorMessage.textContent = ""
                            document.location.href = '../logout';
                        }, 1000)
                    } else {
                        errorMessage.textContent = "Something went wrong, please try again";
                        setInterval(() => errorMessage.textContent = "", 1000)
                        const data = await result.text();
                        console.log(data);
                    }
                }
            });
        </script>


        <?php Footer::render(
            [

                URLROOT . '/public/js/tutor/tutor-main.js?v=1.2'

            ]
        ); ?>