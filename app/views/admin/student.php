<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/student.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/student.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="student-page">

        <div class="card-section" id="card-section">
            <?php foreach ($data as $aStudent) : ?>
                <div class="card">
                    <div class="mode-hide-show">
                        <div class="online-physical-both">
                            <?php if ($aStudent->student->mode == 'online') : ?>
                                <img src="<?php echo URLROOT; ?>/public/img/admin/online.png" alt="" class="online">
                            <?php endif; ?>
                            <?php if ($aStudent->student->mode == 'physical') : ?>
                                <img src="<?php echo URLROOT; ?>/public/img/admin/physical.png" alt="" class="physical">
                            <?php endif; ?>
                            <?php if ($aStudent->student->mode == 'both') : ?>
                                <img src="<?php echo URLROOT; ?>/public/img/admin/online.png" alt="" class="online">
                                <img src="<?php echo URLROOT; ?>/public/img/admin/physical.png" alt="" class="physical">
                            <?php endif; ?>

                        </div>
                        <div class="hide-show">
                            <?php if ($aStudent->student->is_banned == '1') : ?>
                                <img src="<?php echo URLROOT; ?>/public/img/admin/block.png" alt="" class="block">
                            <?php endif; ?>
                            <?php if ($aStudent->student->is_banned == '0') : ?>
                                <img src="<?php echo URLROOT; ?>/public/img/admin/hide.png" alt="" class="hide">
                            <?php endif; ?>
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

            <div class="search">
                <div class="search-bar">
                    <div class="icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="input">
                        <input type="text" placeholder="Search for Student" id="searchStudent">
                    </div>
                </div>
            </div>


            <div class="mode-filter">
                <div class="mode">
                    <h1>By Mode</h1>
                </div>
                <div class="mode-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="online" name="mode" value="online" class="online checkbox class-conduct-mode">
                        <label for="online">&nbspOnline</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="physical" name="mode" value="physical" class="physical checkbox class-conduct-mode">
                        <label for="physical">&nbspPhysical</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="both" name="mode" value="both" class="both checkbox class-conduct-mode">
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
                        <input type="checkbox" id="banned" name="banned" value="1" class="banned checkbox student-visibility-filter">
                        <label for="banned">&nbspBanned</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="unbanned" name="unbanned" value="0" class="unbanned checkbox student-visibility-filter">
                        <label for="unbanned">&nbspUnBanned</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



</body>

</html>