<?php require_once APPROOT . '/views/admin/sideBar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/payment.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/payment.js"></script>


<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>



    <div class="payment-page">
        <div class="payment">
            <div class="payment-left-side">
                <div class="payoff-tutors">
                    <h3>Payoffs Tutors</h3>
                </div>
                <div class="all-tutor">

                    <?php foreach ($data['allUniquePayoffTutors'] as $tutor) : ?>
                        <?php if ($tutor->is_withdrawed == 0) : ?>
                            <div class="tutor">
                                <input type="hidden" value="<?php echo $tutor->tutor_id ?>" class="tutorId">
                                <div class="tutor-img">
                                    <img src="<?php echo URLROOT ?><?php echo $tutor->tutor->profile_picture ?>" alt="tutor profile picture">
                                </div>
                                <div class="tutor-name">
                                    <h3><?php echo $tutor->tutor->first_name ?> <?php echo $tutor->tutor->last_name ?></h3>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="payment-right-side before-selected-payment-right-side" id="payment-right-side">

                <div class="empty-part" id="empty-part">
                    <div class="image-part">
                        <img src="<?php echo URLROOT; ?>/public/img/admin/empty-page.png" alt="">
                    </div>
                    <div class="text-part">
                        <h1>There is no tutor selected</h1>
                        <p>Please select a tutor to see details</p>
                    </div>
                </div>

                <div class="selected-tutor" id="selected-tutor">

                    <!-- loaded selected tutor payment body -->

                </div>
            </div>
        </div>


        <br><br>
        <div class="money-history">
            <section class="table">
                <section class="table-header">
                    <h1>Tutor Withdrawal History</h1>
                </section>
                <section class="table-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['allPaymentDetails'] as $Withdrawal) : ?>
                                <?php if ($Withdrawal->is_withdrawed == 1) : ?>
                                    <tr>
                                        <td><?php echo $Withdrawal->tutor->first_name . " " . $Withdrawal->tutor->first_name ?></td>
                                        <td>Rs. <?php echo $Withdrawal->amount ?>.00</td>
                                        <td><?php echo explode(" ", $Withdrawal->timestamp)[0] ?></td>
                                        <td><?php echo explode(" ", $Withdrawal->timestamp)[1] ?></td>
                                        <td><a href="viewFiles?file=<?php echo $Withdrawal->slip ?>"><button>View</button></a></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </section>

            <br>
            <section class="table">
                <section class="table-header">
                    <h1>Student Payment History</h1>
                </section>
                <section class="table-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Time</th>
                                <!-- <th>Receipt</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['allPaymentDetails'] as $Withdrawal) : ?>
                                <?php if ($Withdrawal->is_withdrawed == 0) : ?>
                                    <tr>
                                        <td><?php echo $Withdrawal->tutor->first_name . " " . $Withdrawal->tutor->first_name ?></td>
                                        <td>Rs. <?php echo $Withdrawal->amount ?>.00</td>
                                        <td><?php echo explode(" ", $Withdrawal->timestamp)[0] ?></td>
                                        <td><?php echo explode(" ", $Withdrawal->timestamp)[1] ?></td>
                                        <!-- <td><a href="#"><button>View</button></a></td> -->
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
            </section>
        </div>
    </div>


</section>


</body>

</html>