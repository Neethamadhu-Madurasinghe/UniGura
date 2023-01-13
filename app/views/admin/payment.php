<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="main.js"></script>
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/payment.css">
    <title>Document</title>
</head>

<body>
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

                <?php foreach($data as $tutor): ?>
                <div class="tutor">
                    <input type="hidden" value="<?php echo $tutor->tutor_id?>" class="tutorId">
                    <div class="tutor-img">
                        <img src="<?php echo URLROOT; ?>/public/img/profile.png" alt="">
                    </div>
                    <div class="tutor-name">
                        <h3><?php echo $tutor->tutor->first_name?> <?php echo $tutor->tutor->last_name?></h3>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="payment-right-side">

            <div class="empty-part" id="empty-part">
                <div class="image-part">
                    <img src="./empty-page.png" alt="">
                </div>
                <div class="text-part">
                    <h1>There is no tutor selected</h1>
                    <p>Please select a tutor to pay</p>
                </div>
            </div>

            <div class="selected-tutor" id="selected-tutor">
                <div class="total-payoff">
                    <div class="amount">
                        <h2>Total Payoffs</h2>
                        <h3>Rs. 4050.00</h3>
                    </div>
                    <div class="pay-button">
                        <button>Pay For Tutor</button>
                    </div>
                </div>

                <div class="paymentSlip-bankDetails">
                    <div class="upload-payment-slip">
                        <div class="bank-slip-uploader">
                            <div class="header-section">
                                <h1>Upload Bank Payment Slip</h1>
                                <p>This this is payment slip will help to the when tutor</p>
                                <p>PDF & Images are allowed</p>
                            </div>
                            <div class="drop-section">
                                <div class="col-1" id="col-1">
                                    <img src="upload.png" alt="upload"><br><br>
                                    <span>Drag & Drop your files here</span><br><br>
                                    <span>OR</span><br><br>
                                    <label class="file-selector" for="browseFiles">Browse Files</label><br><br>
                                    <input type="file" name="browseFiles" class="file-selector-input" id="browseFiles"
                                        multiple hidden>
                                </div>
                                <div class="col-2" id="col-2">
                                    <div class="drop-here">Drop Here</div>
                                </div>
                            </div>
                            <div class="list-section" id="list-section">
                                <div class="list">
                                    <!-- <li class="in-prog" id="in-prog">
                                        <div class='file-box'>
                                            <div class='col'><img src='./pdf.png' alt=''></div>
                                            <div class='details'>
                                                <div class='file-name'>
                                                    <div class='name'>file.name</div>
                                                    <span>50%</span>
                                                </div>
                                                <div class='file-progress'><span></span></div>
                                                <div class='file-size'>file.size</div>
                                            </div>
                                            <div class='icon'>
                                                <i class="fa fa-trash"></i>
                                                <i class='fa fa-circle-xmark'></i>
                                            </div>
                                        </div>
                                    </li> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bank-details">
                        <div class="bank-details-title">
                            <h3>Bank Details</h3>
                        </div>
                        <div class="bank-details-content">
                            <div class="account-name">
                                <div class="bank-details-content-title">
                                    <h3>Account Name</h3>
                                </div>
                                <div class="bank-details-content-text">
                                    <h3>Viraj Sandakelum</h3>
                                </div>
                            </div>

                            <div class="account-number">
                                <div class="bank-details-content-title">
                                    <h3>Account Number</h3>
                                </div>
                                <div class="bank-details-content-text">
                                    <h3>123456789</h3>
                                </div>
                            </div>

                            <div class="bank-name">
                                <div class="bank-details-content-title">
                                    <h3>Bank Name</h3>
                                </div>
                                <div class="bank-details-content-text">
                                    <h3>Bank of Ceylon</h3>
                                </div>
                            </div>

                            <div class="branch-name">
                                <div class="bank-details-content-title">
                                    <h3>Branch Name</h3>
                                </div>
                                <div class="bank-details-content-text">
                                    <h3>Colombo</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="class-details-table">
                    <table>
                        <thead>
                            <tr>
                                <th id="subject-thead">Student</th>
                                <th>Subject</th>
                                <th>Lesson</th>
                                <th>Day</th>
                                <th>Method</th>
                                <th id="classFees-thead">Class Fess</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Viraj Sandakelum</td>
                                <td>Maths</td>
                                <td>1</td>
                                <td>Monday</td>
                                <td>Online</td>
                                <td>Rs. 1350.00</td>
                            </tr>

                            <tr>
                                <td>Viraj Sandakelum</td>
                                <td>Maths</td>
                                <td>1</td>
                                <td>Monday</td>
                                <td>Online</td>
                                <td>Rs. 1350.00</td>
                            </tr>

                            <tr>
                                <td>Viraj Sandakelum</td>
                                <td>Maths</td>
                                <td>1</td>
                                <td>Monday</td>
                                <td>Online</td>
                                <td>Rs. 1350.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

</body>

</html>