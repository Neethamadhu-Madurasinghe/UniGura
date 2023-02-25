<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/statistics.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/Statistic.js"></script>


    
<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="div1">
        <div style="width: 800px;" class="myChart">
            <canvas id="myChart"></canvas>
        </div>

        <div style="width: 320px;" class="myChart2">
            <canvas id="myChart2"></canvas>
        </div>
    </div>


    <div style="width: 1230px; text-align: center;" class="myChart3">
        <canvas id="myChart3"></canvas>
    </div>

    <div style="width: 1230px; text-align: center;" class="myChart4">
        <canvas id="myChart4"></canvas>
    </div>





    <script>
        const ctx4 = document.getElementById('myChart4');

        const moneyTransaction = [
            { month: 'January', amount: { studentPayment: 5000, tutorWithdrawal: 4600, profit: 400 } },
            { month: 'February', amount: { studentPayment: 4000, tutorWithdrawal: 3000, profit: 100 } },
            { month: 'March', amount: { studentPayment: 11000, tutorWithdrawal: 4600, profit: 4500 } },
            { month: 'April', amount: { studentPayment: 5000, tutorWithdrawal: 4600, profit: 400 } },
            { month: 'May', amount: { studentPayment: 15000, tutorWithdrawal: 4000, profit: 400 } },
            { month: 'June', amount: { studentPayment: 5000, tutorWithdrawal: 4600, profit: 400 } },
            { month: 'July', amount: { studentPayment: 51000, tutorWithdrawal: 46100, profit: 4010 } },
            { month: 'August', amount: { studentPayment: 35000, tutorWithdrawal: 4600, profit: 400 } },
            { month: 'September', amount: { studentPayment: 50001, tutorWithdrawal: 46010, profit: 1400 } },
            { month: 'October', amount: { studentPayment: 5400, tutorWithdrawal: 4600, profit: 400 } },
            { month: 'November', amount: { studentPayment: 25000, tutorWithdrawal: 4600, profit: 400 } },
            { month: 'December', amount: { studentPayment: 5000, tutorWithdrawal: 4600, profit: 400 } },
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
                    label: 'Payments',
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
                labels: ['Tutor', 'Student'],
                datasets: [{
                    label: '# of Total Student/Tutors',
                    data: [12, 19],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                    ],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    hoverOffset: 4
                }, {
                    label: '# of Banned Student/Tutors',
                    data: [12, 9],
                    backgroundColor: [
                        'rgba(54, 16, 235)',
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }, {
                    label: '# of Hide Student/Tutors',
                    data: [12, 19],
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
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            },
            options: {
                indexAxis: 'y',
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



</section>


</body>

</html>