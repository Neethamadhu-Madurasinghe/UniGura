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
    'Stats',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/student/components/main-nav-bar.css',
        URLROOT . '/public/css/student/components/error-success-popup.css',
        URLROOT . '/public/css/student/profile.css',
        URLROOT . '/public/css/student/stats.css'
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


    <div class="popup-delete-request invisible">
        <p id="popup-delete-heading">Are you sure you want to delete this request ?</p>
        <div class="confirm-btn-container">
            <button class="btn btn-msg" id="cancel-request-deletion">Cancel</button>
            <button class="btn btn-msg" id="confirm-request-confirm">Delete</button>
        </div>
    </div>

</div>

<?php MainNavbar::render($request); ?>

<div class="main-area-container">

    <div class="main-area">

        <div class="class-summary" id="requests">
            <h1>Class Summary</h1>

            <div class="summary-card-container">
                <div class="summary-card">
                    <div class="heading">Total</div>
                    <div class="count" id="total-class-count"><?php echo $data['class_status']['total'] ?></div>
                </div>

                <div class="summary-card">
                    <div class="heading">Active</div>
                    <div class="count" id="active-class-count"><?php echo $data['class_status']['active'] ?></div>
                </div>

                <div class="summary-card">
                    <div class="heading">Completed</div>
                    <div class="count" id="complete-class-count"><?php echo $data['class_status']['completed'] ?></div>
                </div>

            </div>

        </div>

        <div class="payment-history" id="payments">
            <h1>Payment History</h1>
            <div class="payment-history-container">
                <?php if (count($data['payments']) == 0): ?>
                    <div class="no-data-table-msg">
                        <h4>You have not made any payments yet</h4>
                    </div>

                <?php else: ?>
                    <table class="data-table" id="payment-table">
                        <script>
                            const payments = <?php echo json_encode($data['payments']); ?>
                        </script>
                    </table>
                    <div id="pagination"></div>
                <?php endif; ?>
            </div>

            <?php if (count($data['payments']) != 0): ?>
                <div class="chart-section">
                    <div class="chart-container">
                        <canvas id="payment-chart"></canvas>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="request-history" id="requests">
            <h1>Pending Tutor Requests</h1>
            <div class="request-history-container">
                <?php if (count($data['requests']) === 0): ?>
                    <div class="no-data-table-msg">
                        <h4>There are no pending tutor requests</h4>
                    </div>

                <?php else: ?>
                    <table class="data-table">
                        <tr class="top-table-row">
                            <th>Tutor</th>
                            <th>Subject</th>
                            <th>Module</th>
                            <th>Mode</th>
                            <th></th>
                        </tr>

                        <?php foreach ($data['requests'] as $request): ?>
                            <tr>
                                <td><?php echo $request['first_name'] . ' ' . $request['last_name']; ?></td>
                                <td><?php echo $request['subject']; ?></td>
                                <td><?php echo $request['module']; ?></td>
                                <td><?php echo $request['mode']; ?></td>
                                <td><button class="btn req-cancel-btn" data-id="<?php echo $request['id']; ?>">Cancel</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>



    </div>
</div>


<?php Footer::render(
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js',
        'https://cdn.jsdelivr.net/npm/chart.js',
        URLROOT . '/public/js/student/student-main-nav-bar.js',
        URLROOT . '/public/js/common/student-tutor-complete-profile.js',
        URLROOT . '/public/js/student/profile.js',
        URLROOT . '/public/js/student/student-profile-payment-table.js',
    ]
);
?>

