<?php if (empty($data)) : ?>
    <div class="result-not-found">
        <img src="<?php echo URLROOT; ?>/public/img/admin/notSearchResult.png" alt=""><br>
        <h1>Result Not Found.</h1>
        <p>We couldn't find any result for your search.</p>
        <p>Try searching again.</p>
    </div>
<?php endif; ?>


<?php foreach ($data as $aTutor) : ?>
    <?php if ($aTutor->is_approved === 1) : ?>
        <div class='card'>
            <div class="mode-hide-show">
                <?php if ($aTutor->mode == 'online') : ?>
                    <i class="fa-solid fa-wifi"></i>
                <?php endif; ?>
                <?php if ($aTutor->mode == 'physical') : ?>
                    <i class="fa fa-solid fa-location-arrow"></i>
                <?php endif; ?>
                <?php if ($aTutor->mode == 'both') : ?>
                    <i class="fa-solid fa-wifi"></i>
                    <i class="fa fa-solid fa-location-arrow"></i>
                <?php endif; ?>

                <?php if ($aTutor->is_banned == '1') : ?>
                    <i class="fa-solid fa-lock"></i>
                <?php endif; ?>
                <?php if ($aTutor->is_banned == '0') : ?>
                    <i class="fa-solid fa-lock-open"></i>
                <?php endif; ?>

                <?php if ($aTutor->is_hidden == '1') : ?>
                    <i class="fa-solid fa-eye-slash"></i>
                <?php endif; ?>
                <?php if ($aTutor->is_hidden == '0') : ?>
                    <i class="fa-solid fa-eye"></i>
                <?php endif; ?>
            </div>

            <div class='profile-picture'>
                <img src="<?php echo URLROOT ?><?php echo $aTutor->profile_picture ?>" alt="tutor profile picture">
            </div>

            <div class='name'>
                <h2><?php echo $aTutor->first_name . ' ' . $aTutor->last_name; ?></h2>
            </div>
            <div class='view-profile'>
                <a href="viewTutorProfile?tutorID=<?php echo $aTutor->user_id ?>"><button class="view-profile-btn">View Profile</button></a>
            </div>

        </div>
    <?php endif; ?>

<?php endforeach; ?>