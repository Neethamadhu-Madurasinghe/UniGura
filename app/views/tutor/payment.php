<?php

/**
 * @var $data
 * @var $request
 */
?>


<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';


Header::render(
     'Payment',
     [
          'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
          'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
     ]
     //    Student base style is used here, because In this part, both student and tutor looks same
);
?>





<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<button type="submit" id="payhere-payment" >Pay</button>
<script>
    console.log('hello')
    let data = <?php echo json_encode($data) ?>;

    console.log(data.first_name);
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": data.merchant_id,    // Replace your Merchant ID
        "return_url":undefined,     // Important
        "cancel_url": undefined,     // Important
        "notify_url": 'https://polite-lies-flow-101-2-180-231.loca.lt/unigura/tutor/savepayment',
        "order_id": data.order_id,
        "items": data.items,
        "amount": data.amount,
        "currency": data.currency,
        "hash": data.hash, // *Replace with generated hash retrieved from backend
        "first_name": data.first_name,
        "last_name": data.last_name,
        "email": data.email,
        "phone": data.phone,
        "address": data.address,
        "city": data.city,
        "country": "Sri Lanka"
    };
    console.log(payment)

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
    };
</script>

          <?php Footer::render(
               []
          ); ?>