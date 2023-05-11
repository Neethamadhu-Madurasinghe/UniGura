<?php if (empty($data['allClasses'])) : ?>
    <div class="result-not-found">
        <img src="<?php echo URLROOT; ?>/public/img/admin/notSearchResult.png" alt=""><br>
        <h1>Result Not Found.</h1>
        <p>We couldn't find any result for your search.</p>
        <p>Try searching again.</p>
    </div>
<?php endif; ?>



<?php foreach ($data['allClasses'] as $x) { ?>
    <div class="one-class">
        <div class="tutor">
            <div class="profile-img">
                <img src="<?php echo URLROOT ?><?php echo $x->tutor->profile_picture ?>" alt="tutor profile picture">
            </div>
            <div class="name">
                <h1><i class="fa-solid fa-person-chalkboard"></i> Tutor </h1>
                <h1><?php echo $x->tutor->first_name . ' ' . $x->tutor->last_name ?></h1>
            </div>
        </div>
        <div class="student">
            <div class="name">
                <h1><i class="fa-solid fa-user-graduate"></i> Student </h1>
                <h1><?php echo $x->student_first_name . ' ' . $x->student_last_name ?></h1>
            </div>
            <div class="profile-img">
                <img src="<?php echo URLROOT ?><?php echo $x->student_profile_picture ?>" alt="student profile picture">
            </div>
        </div>
        <div class="class-details">
            <div class="subject">
                <h1><i class="fa-regular fa-circle-dot"></i> Subject: <?php echo $x->subjectName ?></h1>
            </div>
            <div class="module">
                <h1><i class="fa-regular fa-circle-dot"></i> Module: <?php echo $x->moduleName ?></h1>
            </div>
            <div class="class_type">
                <h1><i class="fa-regular fa-circle-dot"></i> Class Type: <?php echo $x->class_type ?></h1>
            </div>
            <div class="mode">
                <h1><i class="fa-regular fa-circle-dot"></i> Mode: <?php echo $x->mode ?></h1>
            </div>
            <div class="completion_status">
                <h1><i class="fa-regular fa-circle-dot"></i> Completion Status:
                    <?php if ($x->completion_status == 0) : ?>
                        <span style="color: red;">Active</span>
                    <?php else : ?>
                        <span style="color: green;">Completed</span>
                    <?php endif; ?>
                </h1>
            </div>
            <div class="data">
                <h1><i class="fa-solid fa-calendar-days"></i> Date: <?php echo $x->date ?></h1>
            </div>
            <div class="time">
                <h1><i class="fa-regular fa-clock"></i> Time: <?php echo $x->time ?></h1>
            </div>
            <div class="duration">
                <h1><i class="fa-solid fa-hourglass-half"></i> Duration: <?php echo $x->duration ?> Hours</h1>
            </div>

            <div class="session_rate">
                <h1><i class="fa-solid fa-coins"></i> Session Rate: Rs.<?php echo $x->session_rate ?>.00</h1>
            </div>

            <div class="current_rating">
                <h1><i class="fa-solid fa-star-half-stroke"></i>Class Rate: <?php
                                                                            $fullStars = floor($x->currentRating);
                                                                            $halfStars = ceil($x->currentRating - $fullStars);
                                                                            $emptyStars = 5 - $fullStars - $halfStars;

                                                                            for ($i = 0; $i < $fullStars; $i++) {
                                                                                echo '<span class="fa fa-star checked"></span>';
                                                                            }

                                                                            for ($i = 0; $i < $halfStars; $i++) {
                                                                                echo '<span class="fa fa-star-half-o checked"></span>';
                                                                            }

                                                                            for ($i = 0; $i < $emptyStars; $i++) {
                                                                                echo '<span class="fa fa-star-o checked"></span>';
                                                                            }
                                                                            ?></h1>
            </div>
        </div>
    </div>
<?php } ?>