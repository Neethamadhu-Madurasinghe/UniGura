<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<script defer src="<?php echo URLROOT ?>/public/js/admin/class.js"></script>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/class.css">


<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="class-page">
        <div class="all-classes" id="all-classes">

            <?php foreach ($data['allClasses'] as $x) { ?>
                <div class="one-class">
                    <div class="tutor">
                        <div class="profile-img">
                            <?php if ($x->tutor->profile_picture === NULL) : ?>
                                <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                            <?php else : ?>
                                <img src="<?php echo URLROOT ?><?php echo $x->tutor->profile_picture ?>" alt="tutor profile picture">
                            <?php endif; ?>
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
                            <?php if ($x->student_profile_picture === NULL) : ?>
                                <img src="<?php echo URLROOT ?>/public/img/common/profile.png" alt="tutor profile picture">
                            <?php else : ?>
                                <img src="<?php echo URLROOT ?><?php echo $x->student_profile_picture ?>" alt="student profile picture">
                            <?php endif; ?>
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

        </div>


        <div class="filter-selection">

            <div class="fees-filter">
                <header>
                    <h1>By Fees</h1>
                    <p>Use slider or enter max fees amount</p>
                </header>
                <div class="price-input">
                    <div class="field">
                        <span>Min</span>
                        <input type="number" class="input-min" value="0" id="class-fees-input-min" disabled>
                    </div>
                    <div class="separator">-</div>
                    <div class="field">
                        <span>Max</span>
                        <input type="number" class="input-max" value="0" id="class-fees-input-max">
                    </div>
                </div>
                <div class="slider">
                    <div class="progress"></div>
                </div>
                <div class="range-input">
                    <input type="range" class="range-max" min="0" max="10000" value="0" step="100" id="class-fees-slider-max">
                </div>
            </div>

            <div class="class-rating">
                <div class="rating">
                    <h1>By Rating</h1>
                </div>
                <div class="rating-select-using-star">
                    <div class="star">
                        <input type="checkbox" id="star-5" name="rating" value="5" class="class-rating checkbox">
                        <label for="star-5" title="5 Stars And Up">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i><small> And Below</small>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-4" name="rating" value="4" class="class-rating checkbox">
                        <label for="star-4" title="4 Stars And Up">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i><small> And Below</small>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-3" name="rating" value="3" class="class-rating checkbox">
                        <label for="star-3" title="3 Stars And Up">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i><small> And Below</small>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-2" name="rating" value="2" class="class-rating checkbox">
                        <label for="star-2" title="2 Stars And Up">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i><small> And Below</small>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-1" name="rating" value="1" class="class-rating checkbox">
                        <label for="star-1" title="1 Stars And Up">
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i><small> And Below</small>
                        </label>
                    </div>

                </div>
            </div>

            <div class="mode-filter">
                <div class="mode">
                    <h1>By Completion Status</h1>
                </div>
                <div class="mode-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="online" name="mode" value="active" class="online checkbox">
                        <label for="online">&nbspActive Classes</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="physical" name="mode" value="complete" class="physical checkbox">
                        <label for="physical">&nbspComplete Classes</label>
                    </div>
                </div>
            </div>

            <div class="subject-filter">
                <div class="subject">
                    <h1>By Subject</h1>
                </div>
                <div class="subject-select">
                    <?php foreach ($data['allSubjects'] as $subjects) { ?>
                        <div class="checkbox-button">
                            <input type="checkbox" id="<?php echo $subjects->name; ?>" name="subject" value="<?php echo $subjects->name; ?>" class="<?php echo $subjects->name; ?> checkbox">
                            <label for="<?php echo $subjects->name; ?>">&nbsp<?php echo $subjects->name; ?></label>
                        </div>
                    <?php } ?>

                    <div class="checkbox-button">
                        <input type="checkbox" id="all" name="subject" value="all" class="all checkbox">
                        <label for="all">All</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

</body>

</html>