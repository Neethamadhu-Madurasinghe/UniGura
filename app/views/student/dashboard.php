<?php
/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/student/inc/components/MainNavbar.php';
require_once APPROOT . '/views/student/inc/components/TutoringClassCard.php';


Header::render(
    'Dashboard',
    [
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/dashboard.css',
        URLROOT . '/public/css/student/components/tutoring-class-card.css'
    ]
);

MainNavbar::render($request);
?>

    <div class="main-area-container">
        <div class="main-area">
            <h1>My classes</h1>
            <div class="main-container">

                <div class="filter-container">
                    <h2>Filters</h2>

                    <form action="" id="home-filter" method="GET">
                        <select id="sort-subject" name="sort-subject" class="home-filters"">
                            <option value="all" style="display: none;" selected>Subject</option>
                            <option value="all">All</option>
                            <?php
                                foreach ($data['subjects'] as $subject) {
                                    $selected = $data['class-sort-by-subject'] == $subject['id'] ? 'selected' : '';
                                   echo '
                                   <option
                                   value="' . $subject["id"] . '"' . ' ' .
                                   $selected . '>'
                                    . $subject["name"] . '</option>';
                                }
                            ?>
                        </select>

                        <select id="sort-completion" name="sort-completion" class="home-filters">
                            <option value="all" style="display: none;" selected>Completion Status</option>
                            <option value="all">All</option>
                            <option value="completed">Completed</option>
                            <option value="not-completed">Not Completed</option>
                        </select>

                        <select id="sort-payment" name="sort-payment" class="home-filters">
                            <option value="all" style="display: none;" selected>Payment Status</option>
                            <option value="all">All</option>
                            <option value="payment-due">Payment Due</option>
                            <option value="payment-not-due">Paid</option>
                        </select>

                    </form>
                </div>

                <div class="class-container">
                    <div class="class-card-container">
                        <div class="no-class-message-container">
                            <h1>Currently you have taken 0 tutoring classes</h1>
                            <h3>Add a class by clicking below button</h3>
                        </div>
                    </div>
                    <div class="add-new-class-button-container">
                        <a href="<?php echo URLROOT . '/student/find-tutor'?>">
                            <img src="<?php echo URLROOT . '/public/img/student/plus 1.png'?>" alt="">
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php Footer::render(
    [

        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/student-dashboard.js'
    ]
);
?>

