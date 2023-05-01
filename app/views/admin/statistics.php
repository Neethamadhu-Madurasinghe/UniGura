<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/statistics.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/Statistic.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="statistic-page">
        <div class="div1">
            <div style="width: 800px;" class="myChart">
                <canvas id="myChart"></canvas>
            </div>

            <div style="width: 320px;" class="myChart2">
                <canvas id="myChart2"></canvas>
            </div>
        </div>

        <div class="div1">
            <div style="width: 320px;" class="rating-summary">
                <h1>3.8</h1><br>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <br><br><br>
                <h2>67 Total</h2>
            </div>

            <div style="width: 800px;" class="myChart5">
                <canvas id="myChart5"></canvas>
            </div>

        </div>



        <div style="width: 1220px; text-align: center;" class="myChart4">
            <canvas id="myChart4"></canvas>
        </div>

        <div style="width: 1200px; text-align: center;" class="myChart3">
            <canvas id="myChart3"></canvas>
        </div>





        <script>
            const ctx4 = document.getElementById('myChart4');

            const moneyTransaction = [{
                    month: 'January',
                    amount: {
                        studentPayment: <?php echo $data['studentJanuaryPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorJanuaryWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemJanuaryProfit'] ?>
                    }
                },
                {
                    month: 'February',
                    amount: {
                        studentPayment: <?php echo $data['studentFebruaryPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorFebruaryWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemFebruaryProfit'] ?>
                    }
                },
                {
                    month: 'March',
                    amount: {
                        studentPayment: <?php echo $data['studentMarchPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorMarchWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemMarchProfit'] ?>
                    }
                },
                {
                    month: 'April',
                    amount: {
                        studentPayment: <?php echo $data['studentAprilPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorAprilWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemAprilProfit'] ?>
                    }
                },
                {
                    month: 'May',
                    amount: {
                        studentPayment: <?php echo $data['studentMayPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorMayWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemMayProfit'] ?>
                    }
                },
                {
                    month: 'June',
                    amount: {
                        studentPayment: <?php echo $data['studentJunePaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorJuneWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemJuneProfit'] ?>
                    }
                },
                {
                    month: 'July',
                    amount: {
                        studentPayment: <?php echo $data['studentJulyPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorJulyWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemJulyProfit'] ?>
                    }
                },
                {
                    month: 'August',
                    amount: {
                        studentPayment: <?php echo $data['studentAugustPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorAugustWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemAugustProfit'] ?>
                    }
                },
                {
                    month: 'September',
                    amount: {
                        studentPayment: <?php echo $data['studentSeptemberPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorSeptemberWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemSeptemberProfit'] ?>
                    }
                },
                {
                    month: 'October',
                    amount: {
                        studentPayment: <?php echo $data['studentOctoberPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorOctoberWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemOctoberProfit'] ?>
                    }
                },
                {
                    month: 'November',
                    amount: {
                        studentPayment: <?php echo $data['studentNovemberPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorNovemberWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemNovemberProfit'] ?>
                    }
                },
                {
                    month: 'December',
                    amount: {
                        studentPayment: <?php echo $data['studentDecemberPaymentsAmount'] ?>,
                        tutorWithdrawal: <?php echo $data['tutorDecemberWithdrawalAmount'] ?>,
                        profit: <?php echo $data['systemDecemberProfit'] ?>
                    }
                },
            ];

            const myChart4 = new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Student Payment',
                        data: moneyTransaction,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 5,
                        tension: 0.4,
                        parsing: {
                            xAxisKey: 'month',
                            yAxisKey: 'amount.studentPayment'
                        }
                    }, {
                        label: 'Tutor Withdrawal',
                        data: moneyTransaction,
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 5,
                        tension: 0.4,
                        parsing: {
                            xAxisKey: 'month',
                            yAxisKey: 'amount.tutorWithdrawal'
                        }
                    }, {
                        label: 'Profit',
                        data: moneyTransaction,
                        backgroundColor: [
                            'rgba(255, 159, 64, 0.3)',
                        ],
                        borderColor: [
                            'rgba(255, 159, 64, 1)',
                        ],
                        borderWidth: 5,
                        tension: 0.4,
                        parsing: {
                            xAxisKey: 'month',
                            yAxisKey: 'amount.profit'
                        }
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }

            });
        </script>

        <script>
            const ctx = document.getElementById('myChart');

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Student', 'Tutor'],
                    datasets: [{
                        label: '# of Total Students/Tutors',
                        data: [<?php echo $data['totalStudents'] ?>, <?php echo $data['totalTutors'] ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                        ],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        hoverOffset: 4
                    }, {
                        label: '# of Banned Students/Tutors',
                        data: [<?php echo $data['bannedStudents'] ?>, <?php echo $data['bannedTutors'] ?>],
                        backgroundColor: [
                            'rgba(54, 16, 235)',
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }, {
                        label: '# of Hide Tutors',
                        data: [0, <?php echo (int)$data['hiddenTutors'] ?>],
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }]
                },
                options: {
                    indexAxis: 'x',
                    barPercentage: 0.7, // controls the width of the bars
                    categoryPercentage: 0.7 // controls the spacing between bars
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            stepSize: 10,
                            callback: function(value, index, values) {
                                return value + '%';
                            }

                        }
                    }]
                }

            });
        </script>



        <script>
            const ctx3 = document.getElementById('myChart3');

            const myChart3 = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: ['Ampare', 'Anuradhapura', 'Badulla', 'Batticaloa', 'Colombo', 'Galle', 'Gampaha', 'Hambantota', 'Jaffna', 'Kalutara', 'Kandy', 'Kegalle', 'Kilinochchi', 'Kurunegala', 'Mannar', 'Matale', 'Matara', 'Monaragala', 'Mullaitivu', 'Nuwara Eliya', 'Polonnaruwa', 'Puttalam', 'Ratnapura', 'Trincomalee', 'Vavuniya'],
                    datasets: [{
                        axis: 'y',
                        label: '# of Students',
                        data: [<?php echo $data['studentAmpareDistrict'] ?>, <?php echo $data['studentAnuradhapuraDistrict'] ?>, <?php echo $data['studentBadullaDistrict'] ?>, <?php echo $data['studentBatticaloaDistrict'] ?>, <?php echo $data['studentColomboDistrict'] ?>, <?php echo $data['studentGalleDistrict'] ?>, <?php echo $data['studentGampahaDistrict'] ?>, <?php echo $data['studentHambantotaDistrict'] ?>, <?php echo $data['studentJaffnaDistrict'] ?>, <?php echo $data['studentKalutaraDistrict'] ?>, <?php echo $data['studentKandyDistrict'] ?>, <?php echo $data['studentKegalleDistrict'] ?>, <?php echo $data['studentKilinochchiDistrict'] ?>, <?php echo $data['studentKurunegalaDistrict'] ?>, <?php echo $data['studentMannarDistrict'] ?>, <?php echo $data['studentMataleDistrict'] ?>, <?php echo $data['studentMataraDistrict'] ?>, <?php echo $data['studentMonaragalaDistrict'] ?>, <?php echo $data['studentMullaitivuDistrict'] ?>, <?php echo $data['studentNuwaraEliyaDistrict'] ?>, <?php echo $data['studentPolonnaruwaDistrict'] ?>, <?php echo $data['studentPuttalamDistrict'] ?>, <?php echo $data['studentRatnapuraDistrict'] ?>, <?php echo $data['studentTrincomaleeDistrict'] ?>, <?php echo $data['studentVavuniyaDistrict'] ?>],
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }, {
                        axis: 'y',
                        label: '# of Tutors',
                        data: [<?php echo $data['tutorAmpareDistrict'] ?>, <?php echo $data['tutorAnuradhapuraDistrict'] ?>, <?php echo $data['tutorBadullaDistrict'] ?>, <?php echo $data['tutorBatticaloaDistrict'] ?>, <?php echo $data['tutorColomboDistrict'] ?>, <?php echo $data['tutorGalleDistrict'] ?>, <?php echo $data['tutorGampahaDistrict'] ?>, <?php echo $data['tutorHambantotaDistrict'] ?>, <?php echo $data['tutorJaffnaDistrict'] ?>, <?php echo $data['tutorKalutaraDistrict'] ?>, <?php echo $data['tutorKandyDistrict'] ?>, <?php echo $data['tutorKegalleDistrict'] ?>, <?php echo $data['tutorKilinochchiDistrict'] ?>, <?php echo $data['tutorKurunegalaDistrict'] ?>, <?php echo $data['tutorMannarDistrict'] ?>, <?php echo $data['tutorMataleDistrict'] ?>, <?php echo $data['tutorMataraDistrict'] ?>, <?php echo $data['tutorMonaragalaDistrict'] ?>, <?php echo $data['tutorMullaitivuDistrict'] ?>, <?php echo $data['tutorNuwaraEliyaDistrict'] ?>, <?php echo $data['tutorPolonnaruwaDistrict'] ?>, <?php echo $data['tutorPuttalamDistrict'] ?>, <?php echo $data['tutorRatnapuraDistrict'] ?>, <?php echo $data['tutorTrincomaleeDistrict'] ?>, <?php echo $data['tutorVavuniyaDistrict'] ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132)',
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
            const ctx5 = document.getElementById('myChart5');

            const myChart5 = new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: ['5\u0020\u0020\u2605', '4\u0020\u0020\u2605', '3\u0020\u0020\u2605', '2\u0020\u0020\u2605', '1\u0020\u0020\u2605'],
                    datasets: [{
                        axis: 'y',
                        label: '# of Rating',
                        data: [10, 20, 30, 40, 50],
                        backgroundColor: [
                            '#4CAF50',
                            '#8BC34A',
                            '#FFC107',
                            '#FF9800',
                            '#F44336'
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: true,
                    barThickness: 30, // set the width of the bars
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
                        data: [<?php echo $data['activeClasses'] ?>, <?php echo $data['completedClasses'] ?>],
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
</section>


</body>

</html>