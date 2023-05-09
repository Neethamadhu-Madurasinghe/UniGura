<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/notification.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/notification.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="notification" id="notificationCount">
        <?php foreach ($data as $notification) : ?>

            <div class="one-notification">
                <div class="notification-header">
                    <a href="<?php echo $notification->link ?>">
                        <div class="notification-info">
                            <div class="notification-title">
                                <h3><?php echo $notification->title ?></h3>
                                <h5><?php echo explode(' ', $notification->created_at)[0] ?> | <?php echo explode(' ', $notification->created_at)[1] ?></h5>
                            </div>
                        </div>
                    </a>
                    <div class="notification-close">
                        <a href="deleteNotification?notificationID=<?php echo $notification->id ?>"><i class="fa-solid fa-circle-xmark notification-close-btn"></i></a>
                    </div>
                </div>
                <a href="<?php echo $notification->link ?>">
                    <div class="notification-description">
                        <p><?php echo $notification->description ?></p>
                    </div>
                </a>
            </div>

        <?php endforeach; ?>
    </div>

</section>


</body>

</html>