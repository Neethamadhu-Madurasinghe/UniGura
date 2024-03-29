<div class="total-payoff">
    <h2>Total Payoffs: <span>Rs.
            <?php
            $totalAmount = 0;
            foreach ($data['tutorPaymentDetails'] as $tutorPaymentDetail) {
                if ($tutorPaymentDetail->is_withdrawed == 0) {
                    $totalAmount += $tutorPaymentDetail->amount;
                }
            }
            echo $totalAmount * (90 / 100);
            ?>.00</span></h2>
</div>


<div class="paymentSlip-bankDetails">
    <div class="upload-payment-slip">
        <div class="bank-slip-uploader">
            <div class="header-section">
                <h1>Upload Bank Payment Slip.</h1><br>
                <p>This payment slip will serve as evidence that the tutor payment has been made.</p><br>
                <p>PDF & Images are allowed.</p>
            </div>
            <div class="drop-section">
                <form action="uploadBankSlip?tutorID=<?php echo $data['tutorBankDetails']->user_id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="col-1" id="col-1">
                        <img src="<?php echo URLROOT; ?>/public/img/admin/uploadBankSlip.gif" alt=""><br><br>
                        <!-- <span>Drag & Drop your files here</span><br><br>
                        <span>OR</span><br><br> -->
                        <input type="file" name="paymentBankSlip" class="file-selector-input" id="paymentBankSlip" multiple accept=".jpg,.jpeg,.png,.pdf" hidden onchange="this.form.submit()">
                        <label class="file-selector" for="paymentBankSlip">Upload Bank Slip</label><br><br>
                    </div>
                    <!-- <div class="col-2" id="col-2">
                        <div class="drop-here">Drop Here</div>
                    </div>
                    <button type="submit">Upload</button> -->
                </form>
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
                    <th>Module</th>
                    <th>Lesson</th>
                    <th>Method</th>
                    <th>Class Fess</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['tutorPaymentDetails'] as $aTutorPaymentDetails) : ?>
                    <?php if ($aTutorPaymentDetails->is_withdrawed == 0) : ?>
                        <tr>
                            <td><?php echo $aTutorPaymentDetails->student->first_name . ' ' . $aTutorPaymentDetails->student->last_name ?></td>
                            <td><?php echo $aTutorPaymentDetails->subject->name ?></td>
                            <td><?php echo $aTutorPaymentDetails->module->name ?></td>
                            <td><?php echo $aTutorPaymentDetails->title ?></td>
                            <td><?php echo $aTutorPaymentDetails->mode ?></td>
                            <td><?php echo $aTutorPaymentDetails->amount ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </section>
</section>

