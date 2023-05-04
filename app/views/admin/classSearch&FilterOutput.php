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
                <h1><?php echo $x->student_first_name . ' ' . $x->student_last_name ?></h1>
            </div>
            <div class="profile-img">
                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
            </div>
        </div>
        <div class="class-details">
            <div class="subject">
                <h1>Subject: <?php echo $x->subjectName ?></h1>
            </div>
            <div class="module">
                <h1>Module: <?php echo $x->moduleName ?></h1>
            </div>
            <div class="data">
                <h1>Date: <?php echo $x->date ?></h1>
            </div>
            <div class="time">
                <h1>Time: <?php echo $x->time ?></h1>
            </div>
            <div class="duration">
                <h1>Duration: <?php echo $x->duration ?> Hours</h1>
            </div>
            <div class="class_type">
                <h1>Class Type: <?php echo $x->class_type ?></h1>
            </div>
            <div class="mode">
                <h1>Mode: <?php echo $x->mode ?></h1>
            </div>
            <div class="session_rate">
                <h1>Session Rate: <?php echo $x->session_rate ?></h1>
            </div>
            <div class="completion_status">
                <h1>Completion Status: <?php echo $x->completion_status ?></h1>
            </div>
        </div>
    </div>
<?php } ?>