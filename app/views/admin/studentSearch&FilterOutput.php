<?php if (empty($data)) : ?>
    <div class="result-not-found">
        <img src="<?php echo URLROOT; ?>/public/img/admin/notSearchResult.png" alt=""><br>
        <h1>Result Not Found.</h1>
        <p>We couldn't find any result for your search.</p>
        <p>Try searching again.</p>
    </div>
<?php endif; ?>


<?php
// echo '<pre>';
// print_r($data);
// echo '</pre>';

// 
?>

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
        <div class="info">
            <h5>Phone: <?php echo $aStudent->phone_number ?></h5>
            <h5>Exam Year: <?php echo $aStudent->year_of_exam ?></h5>
        </div>
        <div class="view-profile">
            <a href="viewStudentProfile?studentID=<?php echo $aStudent->user_id ?>"><button class="view-student-profile-btn">View Profile</button></a>
        </div>
    </div>
<?php endforeach; ?>