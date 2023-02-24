

<?php if (empty($data['allClasses'])) : ?>
    <div class="result-not-found">
        <img src="<?php echo URLROOT; ?>/public/img/admin/resultNotFound.png" alt=""><br>
        <h1>Result Not Found</h1>
        <p>We couldn't find any result for your search.</p>
        <p>Try searching again.</p>
    </div>
<?php endif; ?>


<?php foreach ($data['allClasses'] as $x) { ?>
    <div class="one-class">
        <div class="tutor">
            <div class="profile-img">
                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
            </div>
            <div class="name">
                <h1>Tutor Name</h1>
                <h1><?php echo $x->tutor->first_name . ' ' . $x->tutor->last_name ?></h1>
            </div>
        </div>
        <div class="student">
            <div class="name">
                <h1>Student Name</h1>
                <h1><?php echo $x->student->first_name . ' ' . $x->student->last_name ?></h1>
            </div>
            <div class="profile-img">
                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
            </div>
        </div>
        <div class="class-details">
            <div class="subject">
                <h1>Subject: <?php echo $x->subject->name ?></h1>
            </div>
            <div class="module">
                <h1>Module: <?php echo $x->module->name ?></h1>
            </div>
            <div class="day">
                <h1>Day: <?php echo $x->classDay->title ?></h1>
            </div>
        </div>
    </div>
<?php } ?>