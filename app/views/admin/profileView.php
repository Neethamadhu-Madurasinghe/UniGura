<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/profileView.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/profileView.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="tutor-profile">

        <h3>Change Admin Password</h3>

        <form action="#" method="POST">
            <div class="form-field">
                <label for="first-name">Current Password <span>Please enter a valid password</span></label><br>
                <input type="text" name="first-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">New Password <span>Please enter a valid password</span></label><br>
                <input type="text" name="last-name" id="">
            </div>
            <div class="form-field">
                <label for="last-name">Confirm New Password <span>Password is does't match</span></label><br>
                <input type="text" name="last-name" id="">
            </div>

            <div class="functionality">
                <div class="cancel-btn">
                    <button type="submit" class="btn btn-cancel">Cancel</button>
                </div>
                <div class="change-password">
                    <button type="submit" class="btn btn-change-password">Change Password</button>
                </div>
            </div>
        </form>

    </div>

</section>


</body>

</html>