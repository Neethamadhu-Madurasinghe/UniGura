<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
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
                        <?php if ($aStudent->mode == 'online') : ?>
                            <i class="fa-solid fa-wifi"></i>
                        <?php endif; ?>
                        <?php if ($aStudent->mode == 'physical') : ?>
                            <i class="fa fa-solid fa-location-arrow"></i>
                        <?php endif; ?>
                        <?php if ($aStudent->mode == 'both') : ?>
                            <i class="fa-solid fa-wifi"></i>
                            <i class="fa fa-solid fa-location-arrow"></i>
                        <?php endif; ?>
                        <?php if ($aStudent->is_banned == '1') : ?>
                            <i class="fa-solid fa-lock"></i>
                        <?php endif; ?>
                        <?php if ($aStudent->is_banned == '0') : ?>
                            <i class="fa-solid fa-lock-open"></i>
                        <?php endif; ?>
                    </div>
                    <div class="profile-picture">
                        <?php if ($aStudent->profile_picture === NULL) : ?>
                            <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                        <?php else : ?>
                            <img src="<?php echo URLROOT ?><?php echo $aStudent->profile_picture ?>" alt="student profile picture">
                        <?php endif; ?>
                    </div>
                    <div class="name">
                        <h2><?php echo $aStudent->first_name . ' ' . $aStudent->last_name ?></h2>
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
                    <h1>By Permission</h1>
                </div>
                <div class="visibility-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="banned" name="banned" value="block" class="block checkbox student-visibility-filter">
                        <label for="banned">&nbspBlock</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="unbanned" name="unbanned" value="unblock" class="unblock checkbox student-visibility-filter">
                        <label for="unbanned">&nbspUnblock</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



</body>

</html>