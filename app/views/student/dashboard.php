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
                        <select name="cars" id="class-sort-by"  name="class-sort-by-subject" class="home-filters" onchange="this.form.submit()">
                            <option value="volvo">Maths</option>
                            <option value="saab">Physics</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        <select name="cars" id="class-sort-by" name="class-sort-by-completion"  class="home-filters"  onchange="this.form.submit()">
                            <option value="all">All</option>
                            <option value="saab">Completed</option>
                            <option value="mercedes">Not Completed</option>
                        </select>

                        <select name="cars" id="class-sort-by" name="class-sort-by-payment"  class="home-filters"  onchange="this.form.submit()">
                            <option value="all">All</option>
                            <option value="payment-due">Payment Due</option>
                            <option value="payment-not-due">Payed</option>
                        </select>

                    </form>
                </div>

                <div class="class-container">

                    <div class="class-card">
                        <div class="class-card-top-section">
                            <h2>Mechanics Theory</h2>
                            <h4>Physics</h4>
                        </div>
                        <div class="class-card-bottom-section">
                            <div class="name-row">
                                <div class="class-card-profile-picture-container">
                                    <img src="assests/profile.png" alt="" srcset="">
                                </div>
                                <p>John Doe</p>
                                <div class="class-card-payment-due-container">
                                    <img src="assests/money 1.png" alt="" class="payment-due-image">
                                </div>
                            </div>
                            <div class="progress-bar-row">
                                <p>65%</p>
                                <div class="progress-bar-outer">
                                    <div class="progress-bar-inner">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-enter-class">Enter</button>
                        </div>
                    </div>



                    <div class="add-new-class-button-container">
                        <img src="assests/plus 1.png" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php Footer::render(
    [

        URLROOT . '/public/js/student/student-main-nav-bar.js'
    ]
); ?>