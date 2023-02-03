<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<script defer src="<?php echo URLROOT ?>/public/js/admin/dashboard.js"></script>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="parent">
        <div class="left_sidebar">
            <div class="summary-tutor-student-class-subject">
                <div class="tutor-student-class-subject">
                    <div class="tutor-subject-module">
                        <div class="tutors">
                            <h2>Tutors</h2>
                            <div class="image-info">
                                <div class="tutor-image">
                                    <img src="<?php echo URLROOT ?>/public/img/admin/tutor.png" alt="">
                                </div>
                                <div class="tutors-info">
                                    <div class="total">
                                        <h3>Total :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="hide">
                                        <h3>Hide :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="block">
                                        <h3>Block :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="online">
                                        <h3>Online :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="physical">
                                        <h3>Physical :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="both">
                                        <h3>Both :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="1st-year">
                                        <h3>1st Year :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="2nd-year">
                                        <h3>2nd Year :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="3rd-year">
                                        <h3>3rd Year :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="4th-year">
                                        <h3>4th Year :</h3>
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="subject-module">
                            <h2>Subjects & Modules</h2>
                            <div class="image-info">
                                <div class="subject-module-image">
                                    <img src="<?php echo URLROOT ?>/public/img/admin/subject.png" alt="">
                                </div>
                                <div class="subject-module-info">
                                    <div class="Subject">
                                        <h3>Subject :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="module">
                                        <h3>Modules :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="hide-subject">
                                        <h3>Hide Subject :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="show-subject">
                                        <h3>Show Subject :</h3>
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="class-student">
                        <div class="students">
                            <h2>Students</h2>
                            <div class="image-info">
                                <div class="student-image">
                                    <img src="<?php echo URLROOT ?>/public/img/admin/student.png" alt="">
                                </div>
                                <div class="students-info">
                                    <div class="total">
                                        <h3>Total :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="block">
                                        <h3>Block :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="online">
                                        <h3>Online :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="physical">
                                        <h3>Physical :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="both">
                                        <h3>Both :</h3>
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="classes">
                            <h2>Classes</h2>
                            <div class="image-info">
                                <div class="class-image">
                                    <img src="<?php echo URLROOT ?>/public/img/admin/class.png" alt="">
                                </div>
                                <div class="classes-info">
                                    <div class="total">
                                        <h3>Total :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="online">
                                        <h3>Online :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="physical">
                                        <h3>Physical :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="both">
                                        <h3>Both :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="active-class">
                                        <h3>Active :</h3>
                                        <span>20</span>
                                    </div>
                                    <div class="completed-class">
                                        <h3>Completed :</h3>
                                        <span>20</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="approval-complaint">
                <div class="new_approval">
                    <div class="title">
                        <h2>New Approval</h2>
                        <a href="#">View All</a>
                    </div>
                    <div class="requested_list">
                        <!-- <div class="no_request">
                                                    <img src="./emptyTutorRequest.png" alt="">
                                                    <span>Looks like you haven't tutor request yet</span>
                                                </div> -->


                        <div class="available-request">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="request-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>


                        <div class="available-request">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="request-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>



                        <div class="available-request">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="request-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>



                        <div class="available-request">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="request-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>


                        <div class="available-request">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="request-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="complaints">
                    <div class="title">
                        <h2>Complaints</h2>
                        <a href="#">View All</a>
                    </div>
                    <div class="complaints_list">
                        <!-- <div class="no_complaint">
                                <img src="./emptyCompliants.png" alt="">
                                <span>Looks like you haven't complaints yet</span>
                            </div> -->

                        <div class="available-complaints">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="complaint-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>


                        <div class="available-complaints">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="complaint-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>


                        <div class="available-complaints">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="complaint-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>



                        <div class="available-complaints">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="complaint-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>

                        <div class="available-complaints">
                            <div class="profile-img">
                                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
                            </div>
                            <div class="complaint-details">
                                <h3>Viraj Sandakelum</h3>
                                <span>Complaint about the tutor</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="right_sidebar">

            <div class="payment-summary">
                <div class="total-transaction">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/transaction.png" alt="">
                        <h2>Total Transaction</h2>
                    </div>
                    <span>Rs. 1000</span>
                </div>
                <div class="total-student-payment">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/payment.png" alt="">
                        <h2>Total Student Payment</h2>
                    </div>
                    <span>Rs. 1000</span>
                </div>
                <div class="total-tutor-withdrawal">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/withdrawal.png" alt="">
                        <h2>Total Tutor Withdrawal</h2>
                    </div>
                    <span>Rs. 1000</span>
                </div>
                <div class="profit">
                    <div class="info">
                        <img src="<?php echo URLROOT ?>/public/img/admin/profit.png" alt="">
                        <h2>Profit</h2>
                    </div>
                    <span>Rs. 1000</span>
                </div>
            </div>


            <div style="width: 300px; display: flex; justify-content: center; align-items: center;" class="myChart">
                <canvas id="myChart"></canvas>
            </div>

            <div style="width: 270px; text-align: center;" class="myChart2">
                <canvas id="myChart2"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctx = document.getElementById('myChart');

                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Tutor', 'Student'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19],
                            backgroundColor: [
                                'rgba(255, 99, 132)',
                                'rgba(54, 162, 235)',
                            ],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        indexAxis: 'x',
                    }

                });
            </script>


            <script>
                const ctx2 = document.getElementById('myChart2');

                const myChart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Active Classes', 'Completed Classes'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19],
                            backgroundColor: [
                                'rgba(255, 99, 132)',
                                'rgba(54, 162, 235)',
                            ],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        indexAxis: 'x',
                    }

                });
            </script>

        </div>
    </div>



</section>

</body>

</html>