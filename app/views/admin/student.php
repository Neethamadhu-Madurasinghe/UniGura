<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/student.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/student.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="student-page">



        <div class="card-section">
            <?php foreach ($data as $aStudent) : ?>
                <div class="card">
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
                    <div class="profile-picture">
                        <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="student profile picture">
                    </div>
                    <div class="name">
                        <h2><?php echo $aStudent->student->first_name . ' ' . $aStudent->student->last_name ?></h2>
                    </div>
                    <div class="info">
                        <h5>Phone: <?php echo $aStudent->student->phone_number ?></h5>
                        <h5>Exam Year: <?php echo $aStudent->year_of_exam ?></h5>
                    </div>
                    <div class="view-profile">
                        <a href="viewStudentProfile?studentID=<?php echo $aStudent->user_id ?>"><button class="view-student-profile-btn">View Profile</button></a>
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
                        <input type="checkbox" id="offline" name="mode" value="offline" class="offline checkbox">
                        <label for="offline">&nbspOffline</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="both" name="mode" value="both" class="both checkbox">
                        <label for="both">&nbspBoth</label>
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
</section>



</body>

</html>