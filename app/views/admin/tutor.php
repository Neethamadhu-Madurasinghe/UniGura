<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin/tutor.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/tutor.js"></script>


<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="tutor-page">

        <div class="card-section" id="card-section">

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
                        <img src="<?php echo URLROOT ?><?php echo $aTutor->contactDetails->profile_picture ?>" alt="tutor profile picture">
                    </div>

                    <div class="card-blur-effect">
                        <div class='view-profile'>
                            <a href="viewTutorProfile?tutorID=<?php echo $aTutor->user_id ?>"><button class="view-profile-btn">View Profile</button></a>
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
                            <small><i class="fa-solid fa-file-lines"></i> National Identity Card Copy</small><br>
                            <small><i class="fa-solid fa-file-lines"></i> University Entrance Letter</small><br>
                            <small><i class="fa-solid fa-file-lines"></i> Advanced Level Result</small>
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

        </div>


        <div class="filter-selection">
            <div class="search">
                <div class="search-bar">
                    <div class="icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="input">
                        <input type="text" placeholder="Search for Tutor" id="searchTutor">
                    </div>
                </div>
            </div>


            <div class="mode-filter">
                <div class="mode">
                    <h1>By Mode</h1>
                </div>
                <div class="mode-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="online" name="mode" value="online" class="online checkbox">
                        <label for="online">&nbspOnline</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="physical" name="mode" value="physical" class="physical checkbox">
                        <label for="physical">&nbspPhysical</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="offline" name="mode" value="both" class="both checkbox">
                        <label for="offline">&nbspBoth</label>
                    </div>
                </div>
            </div>

            <div class="duration-filter">
                <div class="duration">
                    <h1>By Duration</h1>
                </div>
                <div class="duration-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="1stYear" name="1stYear" value="1" class="1stYear checkbox">
                        <label for="1stYear">1st Year <small> And Below</small></label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="2ndYear" name="2ndYear" value="2" class="2ndYear checkbox">
                        <label for="2ndYear">2nd Year <small> And Below</small></label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="3rdYear" name="3rdYear" value="3" class="3rdYear checkbox">
                        <label for="3rdYear">3rd Year <small> And Below</small></label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="4thYear" name="4thYear" value="4" class="4thYear checkbox">
                        <label for="4thYear">4th Year <small> And Below</small></label>
                    </div>
                </div>
            </div>

            <div class="visibility-filter">
                <div class="duration">
                    <h1>By Visibility</h1>
                </div>
                <div class="visibility-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="show" name="show" value="show" class="show checkbox">
                        <label for="show">&nbspShow</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="hide" name="hide" value="hide" class="hide checkbox">
                        <label for="hide">&nbspHide</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="unblock" name="unblock" value="unblock" class="unblock checkbox">
                        <label for="unblock">&nbspUnblock</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="block" name="block" value="block" class="block checkbox ">
                        <label for="block">&nbspBlock</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

</section>


</body>

</html>