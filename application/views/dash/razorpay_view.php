<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

    <h2>Pay ₹<?= $amount / 100 ?></h2>
    <button id="payBtn">Pay with Razorpay</button>

    <script>
        var options = {
            "key": "<?= $key_id ?>",
            "amount": "<?= $amount ?>",
            "currency": "INR",
            "name": "Test User",
            "description": "Interview Payment Demo",
            "handler": function (response){
                window.location.href = "<?= site_url('payment/success?payment_id=') ?>" + response.razorpay_payment_id;
            },
            "prefill": {
                "name": "Test User",
                "email": "test@example.com",
                "contact": "9999999999"
            },
            "theme": {
                "color": "#F37254"
            }
        };

        var rzp = new Razorpay(options);
        document.getElementById('payBtn').onclick = function(e){
            rzp.open();
            e.preventDefault();
        };
    </script>

</body>
</html>
