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
                    <div class="delete-hide-show">
                        <div class="hide-show">
                            <div class="btn"></div>
                            <button type="button" class="toggle-btn show">Show</button>
                            <button type="button" class="toggle-btn hide">Hide</button>
                        </div>
                        <div class="delete">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </div>

                    <div class='profile-picture'>
                        <img src='../tutor/OIP.jpeg' alt='''>
                    </div>

                    <div class="card-blur-effect">
                        <div class=' view-profile'>
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

        <div class="total-student">
            <!-- <h1>15</h1> -->
        </div>

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
                    <input type="checkbox" id="maths" name="subject" value="maths">
                    <label for="maths">Maths</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="science" name="subject" value="science">
                    <label for="science">Science</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="english" name="subject" value="english">
                    <label for="english">English</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="history" name="subject" value="history">
                    <label for="history">History</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="geography" name="subject" value="geography">
                    <label for="geography">Geography</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="art" name="subject" value="art">
                    <label for="art">Art</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="music" name="subject" value="music">
                    <label for="music">Music</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="technology" name="subject" value="technology">
                    <label for="technology">Technology</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="physical-education" name="subject" value="physical-education">
                    <label for="physical-education">Physical Education</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">All</label>
                </div>
            </div>
        </div>


        <div class="mode-filter">
            <div class="mode">
                <h1>By Mode</h1>
            </div>
            <div class="mode-select">
                <div class="checkbox-button">
                    <input type="checkbox" id="online" name="mode" value="online">
                    <label for="online">Online</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="offline" name="mode" value="offline">
                    <label for="offline">Offline</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="offline" name="mode" value="both">
                    <label for="offline">Both</label>
                </div>
            </div>
        </div>

        <div class="duration-filter">
            <div class="duration">
                <h1>By Duration</h1>
            </div>
            <div class="duration-select">
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">1st Year</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">2nd Year</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">3rd Year</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">4th Year</label>
                </div>
            </div>
        </div>

        <div class="visibility-filter">
            <div class="duration">
                <h1>By Visibility</h1>
            </div>
            <div class="visibility-select">
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">Show</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">Hide</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">Unblock</label>
                </div>
                <div class="checkbox-button">
                    <input type="checkbox" id="other" name="subject" value="all">
                    <label for="other">Block</label>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

</section>


</body>

</html>