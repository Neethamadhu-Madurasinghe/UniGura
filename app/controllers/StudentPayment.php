<?php

class StudentPayment {
    private ModelStudentPayment $paymentModel;

    public function __construct() {
        $this->paymentModel = $this->model('ModelStudentPayment');
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
            $this->paymentModel->savePayment($data);
        }
    }
}