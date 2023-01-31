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
                        <input type="text" placeholder="Search for Class" id="search-classes">
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
                    <!-- <input type="range" class="range-min" min="0" max="10000" value="0000" step="100" id="class-fees-slider-min" disabled> -->
                    <input type="range" class="range-max" min="0" max="10000" value="0" step="100" id="class-fees-slider-max">
                </div>
            </div>

            <div class="class-rating">
                <div class="rating">
                    <h1>By Rating</h1>
                </div>
                <div class="rating-select-using-star">
                    <div class="star">
                        <input type="checkbox" id="star-5" name="rating" value="5" class="class-rating">
                        <label for="star-5" title="5 stars">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-4" name="rating" value="4" class="class-rating">
                        <label for="star-4" title="4 stars">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-3" name="rating" value="3" class="class-rating">
                        <label for="star-3" title="3 stars">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-2" name="rating" value="2" class="class-rating">
                        <label for="star-2" title="2 stars">
                            <i class="active fa fa-star"></i>
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </label>
                    </div>
                    <div class="star">
                        <input type="checkbox" id="star-1" name="rating" value="1" class="class-rating">
                        <label for="star-1" title="1 star">
                            <i class="active fa fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </label>
                    </div>

                </div>
            </div>

            <div class="mode-filter">
                <div class="mode">
                    <h1>By Mode</h1>
                </div>
                <div class="mode-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="online-mode" name="mode" value="online" class="class-conduct-mode">
                        <label for="online">Online</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="physical-mode" name="mode" value="physical" class="class-conduct-mode">
                        <label for="physical">Physical</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="both-mode" name="mode" value="both" class="class-conduct-mode">
                        <label for="both">Both</label>
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
                            <input type="checkbox" id="<?php echo $subjects->name; ?>" name="subject" value="<?php echo $subjects->name; ?>" class="class-subject">
                            <label for="<?php echo $subjects->name; ?>"><?php echo $subjects->name; ?></label>
                        </div>
                    <?php } ?>

                    <div class="checkbox-button">
                        <input type="checkbox" id="other" name="subject" value="all">
                        <label for="other">All</label>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>



</body>

</html>