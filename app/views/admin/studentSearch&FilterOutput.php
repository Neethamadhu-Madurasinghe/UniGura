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

?>

<?php foreach ($data as $aStudent) : ?>
    <div class="card">
        <div class="mode-hide-show">
            <?php if ($aStudent->student->mode == 'online') : ?>
                <i class="fa-solid fa-wifi"></i>
            <?php endif; ?>
            <?php if ($aStudent->student->mode == 'physical') : ?>
                <i class="fa fa-solid fa-location-arrow"></i>
            <?php endif; ?>
            <?php if ($aStudent->student->mode == 'both') : ?>
                <i class="fa-solid fa-wifi"></i>
                <i class="fa fa-solid fa-location-arrow"></i>
            <?php endif; ?>
            <?php if ($aStudent->student->is_banned == '1') : ?>
                <i class="fa-solid fa-lock"></i>
            <?php endif; ?>
            <?php if ($aStudent->student->is_banned == '0') : ?>
                <i class="fa-solid fa-lock-open"></i>
            <?php endif; ?>
        </div>
        <div class="profile-picture">
            <img src="<?php echo URLROOT ?><?php echo $aStudent->student->profile_picture ?>" alt="student profile picture">
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