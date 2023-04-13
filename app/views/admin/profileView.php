<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/profileView.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/profileView.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <?php
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    ?>



    <div class="tutor-profile">

        <h3>Change Admin's Password</h3>

        <form action="updatePassword" method="POST">
            <div class="form-field">
                <label for="first-name">Current Password
                    <?php if ($data['incorrectPassword'] == 'incorrectPassword') : ?>
                        <span>Please enter a valid password</span></label><br>
            <?php endif; ?>
            <input type="text" name="currentPassword" id="">
            </div>
            <div class="form-field">
                <label for="last-name">New Password
                    <?php if ($data['passwordNotMatch'] == 'passwordNotMatch') : ?>
                        <span>Please enter a valid password</span></label><br>
            <?php endif; ?>
            <input type="text" name="newPassword" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Confirm New Password
                    <?php if ($data['incorrectPassword'] == 'incorrectPassword') : ?>
                        <span>Please enter a valid password</span></label><br>
            <?php endif; ?>
            <input type="text" name="confirmPassword" id="">
            </div>

            <div class="functionality">
                <div class="cancel-btn">
                    <button type="submit" class="btn btn-cancel">Cancel</button>
                </div>
                <div class="change-password">
                    <button type="submit" class="btn btn-change-password">Save</button>
                </div>
            </div>
        </form>

    </div>

</section>


</body>

</html>