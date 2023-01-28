<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/notification.css">
    <title>Document</title>
</head>

<body>

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
                            <!-- <h5>15 Feb, 2022 | 05:10 PM</h5> -->
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

</body>

</html>