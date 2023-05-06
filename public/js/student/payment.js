const paymentBtnsUI = Array.from(document.querySelectorAll('.btn-payment'));

paymentBtnsUI.forEach(paymentBtnUI => {
    paymentBtnUI.addEventListener('click', (e) => {
        const dataElementUI = e.target.nextElementSibling;
        const paymentData = {
            "sandbox": true,
            "merchant_id": dataElementUI.dataset.merchant_id,    // Replace your Merchant ID
            "return_url":dataElementUI.dataset.return_url,     // Important
            "cancel_url": dataElementUI.dataset.cancel_url,     // Important
            "notify_url": dataElementUI.dataset.notify_url,
            "order_id": dataElementUI.dataset.order_id,//day_id
            "items": dataElementUI.dataset.items,
            "amount": dataElementUI.dataset.amount,
            "currency": dataElementUI.dataset.currency,
            "hash": dataElementUI.dataset.hash, // *Replace with generated hash retrieved from backend
            "first_name": dataElementUI.dataset.first_name,
            "last_name": dataElementUI.dataset.last_name,
            "email": dataElementUI.dataset.email,
            "phone": dataElementUI.dataset.phone,
            "address": dataElementUI.dataset.address,
            "city": dataElementUI.dataset.city,
            "country": "Sri Lanka",
            'custom_1' : dataElementUI.dataset.student_id,
            'custom_2' : dataElementUI.dataset.tutor_id
        };

        console.log(paymentData);
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

        payhere.startPayment(paymentData);

    });


})