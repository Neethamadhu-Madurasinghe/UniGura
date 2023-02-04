<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin/tutor.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/tutor.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="tutor-page">

        <div class="card-section">

            <?php foreach ($data as $aTutor) : ?>
                <div class='card'>
                    <div class="mode-hide-show">
                        <div class="online-physical-both">
                            <img src="<?php echo URLROOT; ?>/public/img/admin/online.png" alt="" class="online">
                            <img src="<?php echo URLROOT; ?>/public/img/admin/physical.png" alt="" class="physical">

                        </div>
                        <div class="hide-show">
                            <img src="<?php echo URLROOT; ?>/public/img/admin/block.png" alt="" class="block">
                            <img src="<?php echo URLROOT; ?>/public/img/admin/hide.png" alt="" class="hide">
                        </div>
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
                        <small><i class="fa-solid fa-download"></i> - Education Qualification</small><br>
                        <small><i class="fa-solid fa-download"></i> - National Identity Card Copy</small><br>
                        <small><i class="fa-solid fa-download"></i> - University Entrance Letter</small><br>
                        <small><i class="fa-solid fa-download"></i> - Advanced Level Result</small>
                    </div>

                    <div class='info-3' id='info-3'>
                        <small><i class="fa-solid fa-phone"></i> - <?php echo $aTutor->contactDetails->phone_number; ?></small><br>
                        <small><i class="fa-solid fa-house"></i> - <?php echo $aTutor->contactDetails->letter_box_number . '/' . $aTutor->contactDetails->street; ?></small><br>
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
                    <input type="text" placeholder="Search for Class">
                </div>
            </div>
        </div>

        <div class="filter-functions">
            <div class="search-btn">
                <button><i class="fas fa-search"></i>Find</button>
            </div>
            <div class="filter-btn">
                <button id="filter"><i class="fas fa-filter"></i>Filter</button>
            </div>
            <div class="reset-btn">
                <button id="filter-reset-btn"><i class="fas fa-redo"></i>Reset</button>
            </div>
        </div>

        <div class="subject-filter">
            <div class="subject">
                <h1>By Subject</h1>
            </div>
            <div class="subject-select">
                <div class="checkbox-button">
                    <input type="checkbox" id="maths" name="subject" value="maths" class="maths checkbox">
                    <label for="maths">&nbspMaths</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="science" name="subject" value="science" class="science checkbox">
                    <label for="science">&nbspScience</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="english" name="subject" value="english" class="english checkbox">
                    <label for="english">&nbspEnglish</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="history" name="subject" value="history" class="history checkbox">
                    <label for="history">&nbspHistory</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all" class="other checkbox">
                    <label for="other">&nbspAll</label>
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
                    <input type="checkbox" id="1stYear" name="1stYear" value="1stYear" class="1stYear checkbox">
                    <label for="1stYear">1st Year</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="2ndYear" name="2ndYear" value="2ndYear" class="2ndYear checkbox">
                    <label for="2ndYear">2nd Year</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="3rdYear" name="3rdYear" value="3rdYear" class="3rdYear checkbox">
                    <label for="3rdYear">3rd Year</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="4thYear" name="4thYear" value="4thYear" class="4thYear checkbox">
                    <label for="4thYear">4th Year</label>
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
                    <label for="other">&nbspHide</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="unblock" name="unblock" value="unblock" class="unblock checkbox">
                    <label for="unblock">&nbspUnblock</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="block" name="block" value="block" class="block checkbox">
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