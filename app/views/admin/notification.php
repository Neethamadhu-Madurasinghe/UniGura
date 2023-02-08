<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/notification.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/notification.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="notification">
        <?php foreach ($data as $notification) : ?>

            <div class="one-notification">
                <div class="notification-header">
                    <div class="notification-info">
                        <div class="profile-img">
                            <img src="<?php echo URLROOT; ?>/public/img/admin/profile.png" alt="">
                        </div>

                        <div class="notification-title">
                            <h3><?php echo $notification->user->first_name . ' ' . $notification->user->last_name ?> | <?php echo $notification->title ?></h3>
                            <h5><?php echo explode(' ', $notification->created_at)[0] ?> | <?php echo explode(' ', $notification->created_at)[1] ?></h5>
                        </div>
                    </div>
                    <div class="notification-close">
                        <i class="fa-solid fa-circle-xmark notification-close-btn" notificationID="<?php echo $notification->id ?>"></i>
                    </div>
                </div>
                <div class="notification-description">
                    <p><?php echo $notification->description ?></p>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</section>


</body>

</html>