<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/student/inc/components/MainNavbar.php';


Header::render(
    'Chat',
    [
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/chat.css',
    ]
);

MainNavbar::render($request);
?>

<div class="main-area-container">
    <div class="main-area">
        <h1>Chat with Tutors</h1>
        <div class="chat-component-container">
            <div class="contact-list-container">
                <div class="contact-card contact-card-selected">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="contact-card-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                </div>
            </div>
            <div class="chat-container">
                <div class="chat-container-title">
                    <div class="chat-container-title-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img">
                    </div>
                    <div class="chat-details-container">
                        <h3>Tutor name goes here</h3>
                        <p>last message goes here</p>
                    </div>
                    <button class="cancel-btn">X</button>
                </div>

                <div class="message-box-container">

<!--                    <div class="message-i-box">-->
<!--                        <div class="message-box-image-container">-->
<!--                            <img src="--><?php //echo URLROOT . '/public/img/student/profile.png' ?><!--" alt="" class="profile-picture-img">-->
<!--                        </div>-->
<!--                        <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, molestias.</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="message-i-box">-->
<!--                        <div class="message-box-image-container">-->
<!--                            <img src="--><?php //echo URLROOT . '/public/img/student/profile.png' ?><!--" alt="" class="profile-picture-img">-->
<!--                        </div>-->
<!--                        <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, molestias.</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="message-i-box">-->
<!--                        <div class="message-box-image-container">-->
<!--                            <img src="--><?php //echo URLROOT . '/public/img/student/profile.png' ?><!--" alt="" class="profile-picture-img">-->
<!--                        </div>-->
<!--                        <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, molestias.</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="message-box">-->
<!--                        <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, molestias.</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="message-i-box">-->
<!--                        <div class="message-box-image-container">-->
<!--                            <img src="--><?php //echo URLROOT . '/public/img/student/profile.png' ?><!--" alt="" class="profile-picture-img">-->
<!--                        </div>-->
<!--                        <p class="message">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Modi magni blanditiis quas minus aliquam ut quibusdam sit voluptatum dolorum quod temporibus ad laborum deleniti minima, corrupti obcaecati ratione consequatur corporis..</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="message-box">-->
<!--                        <p class="message">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus nemo ipsam sapiente dignissimos porro magni? Sapiente facilis, quas nemo voluptates dignissimos velit! Laborum ipsa non corrupti quaerat, vero tempore delectus.</p>-->
<!--                    </div>-->




                </div>

                <div class="new-message-container">
                    <textarea rows="3" placeholder="Send a message"></textarea>
                    <button class="btn btn-send">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php Footer::render(
    [
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/chat.js',
    ]
);
?>

