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
require_once APPROOT . '/views/common/inc/components/IntermediateNavBar.php';

Header::render(
    'Tutor Pending',
    [
        URLROOT . '/public/css/components/intermediate-nav-bar.css?v=1.2',
        URLROOT . '/public/css/tutor/forms.css'
    ]
);

IntermediateNavBar::render($request);

?>
<div class="lightbox">
    <div class="box" style="width: 30%; margin-left: 35%;">
        <i   style="display : none" class="fa-solid fa-circle-exclamation" id="alert_icon"></i>
        <i style="display : none" class="fa-solid fa-circle-xmark" id="error_icon"></i>

        <h2 style="text-align: center;width: 100%;padding-bottom: 0px; font-weight: 400;">Waiting for Approval</h2>
        <p style="text-align: center;margin-bottom: 0px;" id="message"></p>
        <div class="form_container">
            <form>

                <div>
                    <div style="margin-top: 50px;display:flex;align-items:center; justify-content:center">
                        <div class="dropdown">
                            <div id='button'  style="display:none; text-align: center;padding-top:5px" class="yes">Re-submit</div>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>




<script>
    let root =  `<?php echo URLROOT ?>`;
    let decline = `<?php echo $data['decline'] ?>`;
    let username = `<?php echo $data['user_name'] ?>`;
    let message = document.getElementById('message');

    let button = document.getElementById('.button');
    let alert_icon = document.getElementById('alert_icon');
    let error_icon = document.getElementById('error_icon');

    if (decline == 0) {
        alert_icon.style.display = 'block';
        message.innerText = 'Thank you for submitting your details for approval. Our team will review your profile and notify you via email once it has been approved. Please keep an eye on your inbox for further instructions.';
    } else if ((decline == 1)) {
        message.innerText = "We're sorry to inform you that your profile verification has failed. Our team has sent you an email with the reasons why your profile verification failed, as well as instructions on how to complete your profile again. Please check your email and follow the instructions provided to complete your profile verification process. If you have any questions or concerns, please don't hesitate to reach out to our support team for assistance. Thank you for your understanding.";
        button.style.display = 'block';
        button.addEventListener('click',()=>{
            window.localStorage = `${root}/tutor/complete-profile`;
        })
        error_icon.style.display = 'block';
    }
</script>


<?php Footer::render(
    []
);
?>