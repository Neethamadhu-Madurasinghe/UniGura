<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/payment.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/payment.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>


    <div class="payment">
        <div class="payment-left-side">
            <div class="payoff-tutors">
                <h3>Payoffs Tutors</h3>
            </div>
            <div class="search-box">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search Tutors">
            </div>
            <div class="all-tutor">

                <?php foreach ($data as $tutor) : ?>
                    <div class="tutor">
                        <input type="hidden" value="<?php echo $tutor->tutor_id ?>" class="tutorId">
                        <div class="tutor-img">
                            <img src="<?php echo URLROOT; ?>/public/img/admin/profile.png" alt="">
                        </div>
                        <div class="tutor-name">
                            <h3><?php echo $tutor->tutor->first_name ?> <?php echo $tutor->tutor->last_name ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="payment-right-side">

            <div class="empty-part" id="empty-part">
                <div class="image-part">
                    <img src="<?php echo URLROOT; ?>/public/img/admin/empty-page.png" alt="">
                </div>
                <div class="text-part">
                    <h1>There is no tutor selected</h1>
                    <p>Please select a tutor to pay</p>
                </div>
            </div>

            <div class="selected-tutor" id="selected-tutor">
                
                <!-- loaded body -->

            </div>
        </div>
    </div>



    <br><br>
    <div class="money-history">
        <h1>Tutor Withdrawal History</h1>
        <div class="class-details-table">
            <table>
                <thead>
                    <tr>
                        <th id="subject-thead">Tutor</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th id="classFees-thead">Receipt</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Viraj Sandakelum</td>
                        <td>Rs. 1350.00</td>
                        <td>2021-05-01</td>
                        <td>10:00 AM</td>
                        <td><a href="#">View</a></td>
                    </tr>

                    <tr>
                        <td>Viraj Sandakelum</td>
                        <td>Rs. 1350.00</td>
                        <td>2021-05-01</td>
                        <td>10:00 AM</td>
                        <td><a href="#">View</a></td>
                    </tr>

                    <tr>
                        <td>Viraj Sandakelum</td>
                        <td>Rs. 1350.00</td>
                        <td>2021-05-01</td>
                        <td>10:00 AM</td>
                        <td><a href="#">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>


        <h1>Student Payment History</h1>
        <div class="class-details-table">
            <table>
                <thead>
                    <tr>
                        <th id="subject-thead">Student</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th id="classFees-thead">Receipt</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Viraj Sandakelum</td>
                        <td>Rs. 1350.00</td>
                        <td>2021-05-01</td>
                        <td>10:00 AM</td>
                        <td><a href="#">View</a></td>
                    </tr>

                    <tr>
                        <td>Viraj Sandakelum</td>
                        <td>Rs. 1350.00</td>
                        <td>2021-05-01</td>
                        <td>10:00 AM</td>
                        <td><a href="#">View</a></td>
                    </tr>

                    <tr>
                        <td>Viraj Sandakelum</td>
                        <td>Rs. 1350.00</td>
                        <td>2021-05-01</td>
                        <td>10:00 AM</td>
                        <td><a href="#">View</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</section>


</body>

</html>