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