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
                <?php if ($aTutor->is_approved === 1) : ?>
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

                        <div class='name'>
                            <h2><?php echo $aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name; ?></h2>
                        </div>
                        <div class="info">
                            <h5>Phone: </h5>
                            <h5>Exam Year:</h5>
                        </div>

                        <div class='view-profile'>
                            <a href="viewTutorProfile?tutorID=<?php echo $aTutor->user_id ?>"><button class="view-profile-btn">View Profile</button></a>
                        </div>

                    </div>
                <?php endif; ?>

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