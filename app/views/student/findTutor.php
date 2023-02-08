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
    'Find Tutuor',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        URLROOT . '/public/css/student/components/error-success-popup.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/find-tutor.css',
        URLROOT . '/public/css/student/components/tutor-search-card.css',
        URLROOT . '/public/css/student/components/timetable.css'
    ]
);

?>

<div class="error-layout-background invisible">

    <div class="popup-error-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/cross.png' ?>" alt="" srcset="">
        <p id="error-message"></p>
        <button class="btn btn-search" id="error-ok">OK</button>
    </div>

    <div class="popup-success-message invisible">
        <img src="<?php echo URLROOT . '/public/img/student/success.png' ?>" alt="" srcset="">
        <p id="success-message"></p>
        <button class="btn btn-search" id="success-ok">OK</button>
    </div>

</div>

<div class="layout-background invisible">

    <div class="pop-time-table invisible">
        <h1>Select time slots</h1>

        <div class="time-table-container">
            <table id="time-table">
                <caption style="display: none">Hidden Caption</caption>
                <th></th>
            </table>
        </div>

        <div class="popup-button-container">
            <button class="btn btn-search" id="time-table-cancel">Cancel</button>
            <button class="btn btn-search" id="tutor-request-send">Send Request</button>
        </div>

    </div>
</div>

<?php MainNavbar::render($request); ?>

<div class="main-area-search">

    <div class="top-container">

        <div class="filter-section-container">
            <h1>Find Tutors</h1>
            <div class="filter-container">
                <form action="" class="filter-form" method="GET" id="filter-form">
                    <div class="form-filter-container">

                        <select name="subject" class="tutor-filter filter-sm" id="subject">
                            <?php
                            foreach ($data['subjects'] as $subject) {
                                echo '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
                            }
                            ?>
                        </select>

                        <select name="module" class="tutor-filter filter-md" id="module">
                            <?php
                            foreach ($data['modules'] as $module) {
                                echo '<option value="' . $module['id'] . '">' . $module['name'] . '</option>';

                            }
                            ?>
                        </select>

                        <select name="day" class="tutor-filter filter-sm" id="day">
                            <option value="all">Any day</option>
                            <option value="sun">Sunday</option>
                            <option value="mon">Monday</option>
                            <option value="tue">Tuesday</option>
                            <option value="wed">Wednesday</option>
                            <option value="thu">Thursday</option>
                            <option value="fri">Friday</option>
                            <option value="sat">Saturday</option>
                        </select>

                        <select name="time" class="tutor-filter filter-sm" id="time">
                            <option value="all">Any time</option>
                            <option value="8">8 AM</option>
                            <option value="10">10 AM</option>
                            <option value="12">12 PM</option>
                            <option value="14">2 PM</option>
                            <option value="16">4 PM</option>
                            <option value="18">6 PM</option>
                            <option value="20">8 PM</option>
                            <option value="22">10 PM</option>
                        </select>

                        <select name="class-type" class="tutor-filter filter-sm" id="class-type">
                            <option value="theory">Theory</option>
                            <option value="revision">Revision</option>
                            <option value="paper">Paper</option>
                        </select>

                        <select name="medium" class="tutor-filter filter-sm" id="medium">
                            <option value="0">Sinhala</option>
                            <option value="1">English</option>
                        </select>

                        <select name="gender" class="tutor-filter filter-sm" id="gender">
                            <option value="all">Any Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>

                        <div class="tutor-filter filter-lg">
                            <label for="max-price" id="class-price-label">
                                Below <?php echo $data['max_price'] ?> LKR
                            </label>
                            <input
                                    type="range"
                                    min="500"
                                    max="<?php echo $data['max_price'] ?>"
                                    value="<?php echo $data['max_price'] ?>"
                                    class="slider "
                                    id="price-range"
                                    name="max-price">
                        </div>

                        <select name="mode" class="tutor-filter filter-sm" id="mode">
                            <option value="online"
                                <?php echo $data['preferred_class_mode'] === 'online' ? 'selected' : '' ?>>
                                Online
                            </option>
                            <option value="physical"
                                <?php echo $data['preferred_class_mode'] === 'physical' ? 'selected' : '' ?>>
                                    Physical
                            </option>
                        </select>

                        <select name="location" id="location" class="tutor-filter filter-sm">
                            <option value="default" selected>Default Location</option>
                            <option value="custom">Custom Location</option>
                        </select>

                        <select name="distance" id="distance" class="tutor-filter filter-sm">
                            <option value="1" selected>1KM</option>
                            <option value="2">2KM</option>
                            <option value="5">5KM</option>
                            <option value="10">10KM</option>
                        </select>
                    </div>

                    <div class="map-container" id="map-container">
                        <p>Select location</p>
                        <div id="map" class="map"></div>
                        <div id="marker"
                             title="Marker"
                             style="<?php echo 'background:url(' . URLROOT . '/public/img/student/marker-64.ico)
                                     no-repeat top center; background-size: contain' ?>">
                        </div>
                        <input
                                type="number"
                                id="latitude"
                                name="latitude"
                                step="0.000000000000001"
                                value="<?php echo $data['latitude'] ?>"
                                disabled">
                        <input
                                type="number"
                                id="longitude"
                                name="longitude"
                                step="0.000000000000001"
                                value="<?php echo $data['longitude'] ?>"
                                disabled>
                        <input
                                type="text"
                                hidden name="is-default"
                                value="<?php echo $data['is_default'] ?>"
                                id="is-default">
                    </div>


                    <div id="submit-btn-container">
                        <input type="submit" value="Find Tutors" class="btn btn-search" id="search-btn">
                    </div>

                </form>
            </div>


        </div>
        <div class="filter-image-container">
            <object data="<?php echo URLROOT . '/public/img/student/Designer girl-cuate 1.svg' ?>">Image</object>
        </div>

    </div>

    <div class="bottom-container">

        <div class="search-result-title-container invisible">
            <h1 id="search-result-title">Search Results</h1>

            <div class="invisible" id="search-result-filter">
                <form action="">
                    <label for="tutor-search-sort-by" class="">Sort by: </label>
                    <select name="sort-by" id="tutor-search-sort-by">
                        <option value="rating">Rating</option>
                        <option value="price-high">Price Highest to Lowest</option>
                        <option value="price-low">Price Lowest to Highest</option>
                    </select>
                </form>
            </div>


        </div>

        <div class="tutor-search-result-container">

        </div>

    </div>

</div>

<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        URLROOT . '/public/js/student/find-tutor.js',
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/student/search-request-handler.js',
        URLROOT . '/public/js/student/timetable-handler.js',
        URLROOT . '/public/js/student/tutor-request-handler.js',
        URLROOT . '/public/js/student/tutor-seemore-handler.js'
    ]
);
?>

