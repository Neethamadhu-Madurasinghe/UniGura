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

<div class="error-layout-background invisible">
    <div class="popup-error-message">
        <img src="<?php echo URLROOT . '/public/img/student/cross.png' ?>" alt="" srcset="">
        <p id="error-message">Request has been Sent Successfully</p>
        <button class="btn btn-search" id="error-ok">OK</button>
    </div>

    <div class="popup-success-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/success.png' ?>" alt="" srcset="">
        <p id="success-message">Request has been Sent Successfully</p>
        <button class="btn btn-search" id="success-ok">OK</button>
    </div>
</div>


<!-- END OF LAYOUT PART -->

<div class="main-area-container">
    <div class="main-area">
        <h1>Chat with Tutors</h1>
        <div class="chat-component-container">
            <div class="contact-list-container">
                <!--Contacts go here -->
            </div>
            <div class="chat-container">
                <div class="chat-container-title">
                    <div class="chat-container-title-image-container">
                        <img src="<?php echo URLROOT . '/public/img/student/profile.png' ?>" alt="" class="profile-picture-img" id="main-chat-image">
                    </div>
                    <div class="chat-details-container">
                        <h3 id="chat-title"></h3>
                        <p id="user-state"></p>
                    </div>
                    <div class="message-cancel-btn-container">
                        <button class="cancel-btn">X</button>
                    </div>
                </div>

                <div class="message-box-container">
                    <!--All messages go inside this -->
                </div>

                <div class="new-message-container">
                    <textarea rows="3" placeholder="Send a message" id="msg-box"></textarea>
                    <button class="btn btn-send">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php Footer::render(
    [
        URLROOT . '/public/js/student/student-main-nav-bar.js',
//        This JS file for show error messages
        URLROOT . '/public/js/student/tutor-profile.js',
        URLROOT . '/public/js/student/chat-connection.js',
        URLROOT . '/public/js/student/chat.js',
        URLROOT . '/public/js/student/chat-responsive.js',
    ]
);
?>

