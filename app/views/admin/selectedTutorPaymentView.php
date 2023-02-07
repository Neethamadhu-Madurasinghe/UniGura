<div class="total-payoff">
    <h2>Total Payoffs: <span>Rs. 5000</span></h2>
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
                    <img src="<?php echo URLROOT; ?>/public/img/admin/upload.png" alt=""><br><br>
                    <span>Drag & Drop your files here</span><br><br>
                    <span>OR</span><br><br>
                    <label class="file-selector" for="browseFiles">Browse Files</label><br><br>
                    <input type="file" name="browseFiles" class="file-selector-input" id="browseFiles" multiple hidden>
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
                    <h3><?php echo $data['tutorBankDetails']->bank_account_owner ?></h3>
                </div>
            </div>

            <div class="account-number">
                <div class="bank-details-content-title">
                    <h3>Account Number</h3>
                </div>
                <div class="bank-details-content-text">
                    <h3><?php echo $data['tutorBankDetails']->bank_account_number ?></h3>
                </div>
            </div>

            <div class="bank-name">
                <div class="bank-details-content-title">
                    <h3>Bank Name</h3>
                </div>
                <div class="bank-details-content-text">
                    <h3><?php echo $data['tutorBankDetails']->bank_name ?></h3>
                </div>
            </div>

            <div class="branch-name">
                <div class="bank-details-content-title">
                    <h3>Branch Name</h3>
                </div>
                <div class="bank-details-content-text">
                    <h3><?php echo $data['tutorBankDetails']->bank_branch ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>



<section class="table selected-tutor-payment-view">
    <section class="table-header">
        <h1>Tutor class Details</h1>
    </section>
    <section class="table-body selected-tutor-table-body">
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Lesson</th>
                    <th>Day</th>
                    <th>Method</th>
                    <th>Class Fess</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['tutorPaymentDetails'] as $aTutorPaymentDetails) : ?>
                    <tr>
                        <td><?php echo $aTutorPaymentDetails->student->first_name . ' ' . $aTutorPaymentDetails->student->last_name ?></td>
                        <td><?php echo $aTutorPaymentDetails->subject->name ?></td>
                        <td><?php echo $aTutorPaymentDetails->module->name ?></td>
                        <td>ssssssssssssss</td>
                        <td><?php echo $aTutorPaymentDetails->tutorialClass->mode ?></td>
                        <td><?php echo $aTutorPaymentDetails->amount ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</section>