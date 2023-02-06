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
    'Create Class',
    [
        'https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css',
        URLROOT . '/public/css/common/student-base-style.css',
        URLROOT . '/public/css/tutor/create-class-template.css?v=1.4'
    ]
    //    Student base style is used here, because In this part, both student and tutor looks same
);
?>
<div class="main-area">
    <h1 class="main-title">Payment Page</h1>
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
    <input type="hidden" name="merchant_id" value="121XXXX">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="http://sample.com/return">
    <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
    <input type="hidden" name="notify_url" value="http://sample.com/notify">  
    </br></br>Item Details</br>
    <input type="text" name="order_id" value="ItemNo12345">
    <input type="text" name="items" value="Door bell wireless">
    <input type="text" name="currency" value="LKR">
    <input type="text" name="amount" value="1000">  
    </br></br>Customer Details</br>
    <input type="text" name="first_name" value="Saman">
    <input type="text" name="last_name" value="Perera">
    <input type="text" name="email" value="samanp@gmail.com">
    <input type="text" name="phone" value="0771234567">
    <input type="text" name="address" value="No.1, Galle Road">
    <input type="text" name="city" value="Colombo">
    <input type="hidden" name="country" value="Sri Lanka">
    <input type="hidden" name="hash" value="098F6BCD4621D373CADE4E832627B4F6">    <!-- Replace with generated hash -->
    <input type="submit" value="Buy Now">   
</form> 


</div>




<?php Footer::render(
    []
); ?>