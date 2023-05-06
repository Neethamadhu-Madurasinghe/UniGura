<?php if (empty($data)) : ?>
    <div class="result-not-found">
        <img src="<?php echo URLROOT; ?>/public/img/admin/resultNotFound.png" alt=""><br>
        <h1>Result Not Found</h1>
        <p>We couldn't find any result for your search.</p>
        <p>Try searching again.</p>
    </div>
<?php endif; ?>


<?php foreach ($data as $aTutor) : ?>
    <div class='card'>
        <div class="mode-hide-show">
            <?php if ($aTutor->contactDetails->mode == 'online') : ?>
                <i class="fa-solid fa-wifi"></i>
            <?php endif; ?>
            <?php if ($aTutor->contactDetails->mode == 'physical') : ?>
                <i class="fa fa-solid fa-location-arrow"></i>
            <?php endif; ?>
            <?php if ($aTutor->contactDetails->mode == 'both') : ?>
                <i class="fa-solid fa-wifi"></i>
                <i class="fa fa-solid fa-location-arrow"></i>
            <?php endif; ?>

            <?php if ($aTutor->contactDetails->is_banned == '1') : ?>
                <i class="fa-solid fa-lock"></i>
            <?php endif; ?>
            <?php if ($aTutor->contactDetails->is_banned == '0') : ?>
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
            <img src="<?php echo URLROOT; ?>/public/img/admin/profile.png" alt="">
        </div>

        <div class="card-blur-effect">
            <div class='view-profile'>
                <a href="viewTutorProfile"><button class="view-profile-btn">View Profile</button></a>
            </div>
        </div>


        <div class='name'>
            <h2><?php echo $aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name; ?></h2>
        </div>


        <div class='selection-menu'>
            <div class='menu-1' id='menu-1'>
                <h3>About</h3>
            </div>

            <div class='menu-2' id='menu-2'>
                <h3>Qualification</h3>
            </div>

            <div class='menu-3' id='menu-3'>
                <h3>Contact</h3>
            </div>
        </div>

        <div class='selection-info'>
            <div class='info-1' id='info-1'>
                <small><i class="fa-solid fa-address-card"></i> - <?php echo $aTutor->description; ?></small>
            </div>

            <div class='info-2' id='info-2'>
                <small><i class="fa-solid fa-graduation-cap"></i> <?php echo $aTutor->education_qualification; ?></small><br>
                <small><i class="fa-solid fa-download"></i> - National Identity Card Copy</small><br>
                <small><i class="fa-solid fa-download"></i> - University Entrance Letter</small><br>
                <small><i class="fa-solid fa-download"></i> - Advanced Level Result</small>
            </div>

            <div class='info-3' id='info-3'>
                <small><i class="fa-solid fa-phone"></i> - <?php echo $aTutor->contactDetails->phone_number; ?></small><br>
                <small><i class="fa-solid fa-house"></i> - <?php echo $aTutor->contactDetails->address_line1 . ' / ' . $aTutor->contactDetails->address_line2; ?></small><br>
                <small><i class="fa-solid fa-location-dot"></i> - <?php echo $aTutor->contactDetails->city; ?></small><br>
                <small><i class="fa-solid fa-venus-mars"></i> - <?php echo $aTutor->contactDetails->gender; ?></small>
            </div>
        </div>
    </div>
<?php endforeach; ?>