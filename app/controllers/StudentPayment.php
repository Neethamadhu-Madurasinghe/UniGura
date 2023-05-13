<?php

class StudentPayment extends Controller {
    private ModelStudentPayment $paymentModel;
    private ModelStudentNotification $notificationModel;

    public function __construct() {
        $this->paymentModel = $this->model('ModelStudentPayment');
        $this->notificationModel = $this->model('ModelStudentNotification');
    }

//    Saves the payment details once it is received via payhere
    public function savePayment(Request $request) {

        $body = $request->getBody();

        $merchant_id         = $body['merchant_id'];
        $order_id            = $body['order_id'];
        $payhere_amount      = $body['payhere_amount'];
        $payhere_currency    = $body['payhere_currency'];
        $status_code         = $body['status_code'];
        $md5sig              = $body['md5sig'];
        $merchant_secret = MERCHANT_SECRET;

        print_r($body);

        $local_md5sig = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                $payhere_amount .
                $payhere_currency .
                $status_code .
                strtoupper(md5($merchant_secret))
            )
        );

        $data['day_id'] = $order_id;
        $data['student_id'] = $body['custom_1'];
        $data['tutor_id'] = $body['custom_2'];
        $data['amount'] =  $payhere_amount;


        if (($local_md5sig === $md5sig) && ($status_code == 2)) {
            if ($this->paymentModel->savePayment($data)) {
//                Show a notification to the tutor
                $this->notificationModel->createNotification(
                    $data['student_id'],
                    "Your payment has been accepted",
                    URLROOT . '/student/stats',
                    "Click here to see all payments"
                );

                $this->notificationModel->createNotification(
                    $data['tutor_id'],
                    "Student has paid for your class"
                );
            }
        }
    }
}

//     Visa : 4916217501611292
// MasterCard : 5307732125531191
// AMEX : 346781005510225