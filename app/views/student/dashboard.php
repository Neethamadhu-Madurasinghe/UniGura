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
                        <select id="class-sort-by"
                                name="class-sort-by-subject"
                                class="home-filters"
                                onchange="this.form.submit()">

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

                        <select id="class-sort-by"
                                name="class-sort-by-completion"
                                class="home-filters"
                                onchange="this.form.submit()">

                            <option value="all"
                                <?php echo $data['class-sort-by-completion'] === 'all' ? 'selected' : '' ?>>
                                All
                            </option>
                            <option value="completed"
                                <?php echo $data['class-sort-by-completion'] === 'completed' ? 'selected' : '' ?>>
                                Completed
                            </option>
                            <option value="not-completed"
                                <?php echo $data['class-sort-by-completion'] === 'not-completed' ? 'selected' : '' ?>>
                                Not Completed
                            </option>
                        </select>

                        <select id="class-sort-by"
                                name="class-sort-by-payment"
                                class="home-filters"
                                onchange="this.form.submit()">

                            <option value="all"
                                <?php echo $data['class-sort-by-payment'] === 'all' ? 'selected' : '' ?>>
                                All
                            </option>
                            <option value="payment-due"
                                <?php echo $data['class-sort-by-payment'] === 'payment-due' ? 'selected' : '' ?>>
                                Payment Due
                            </option>
                            <option value="payment-not-due"
                                <?php echo $data['class-sort-by-payment'] === 'payment-not-due' ? 'selected' : '' ?>>
                                Payed
                            </option>
                        </select>

                    </form>
                </div>

                <div class="class-container">

                    <?php
                        foreach ($data['tutoring_classes'] as $record) {
                            TutoringClassCard::render($record);
                        }
                    ?>



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

        URLROOT . '/public/js/student/student-main-nav-bar.js'
    ]
);
?>

