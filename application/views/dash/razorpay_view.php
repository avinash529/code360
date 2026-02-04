<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment | Code360</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full text-center border border-slate-100">
        <div class="mb-6">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800">Complete Payment</h2>
            <p class="text-slate-500 mt-2">Secure payment via Razorpay</p>
        </div>

        <div class="bg-slate-50 rounded-xl p-6 mb-8 border border-slate-100">
            <div class="text-sm text-slate-500 uppercase tracking-wider font-medium mb-1">Total Amount</div>
            <div class="text-4xl font-bold text-slate-900">₹<?= number_format($amount / 100, 2) ?></div>
        </div>

        <button id="payBtn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-indigo-500/30 transform transition-all duration-200">
            Pay Now
        </button>
        
        <p class="text-xs text-slate-400 mt-6 flex items-center justify-center">
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
            Secured by Razorpay
        </p>
    </div>

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
                "color": "#4F46E5"
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
