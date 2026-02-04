<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Code360</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-white min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="border-b border-white/10 backdrop-blur-md bg-slate-900/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
                        Code360
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="<?= site_url('auth') ?>" class="text-slate-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                        <a href="<?= site_url('auth/register') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full text-sm font-semibold shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600/20 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Manage your Business <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-pink-400">With Confidence</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400 mb-10">
                A powerful, modern dashboard to streamline your operations, manage users, and track transactions effortlessly.
            </p>
            <div class="flex justify-center gap-4">
                <a href="<?= site_url('auth/register') ?>" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 rounded-full text-lg font-bold shadow-xl hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                    Start Free Trial
                </a>
                <a href="<?= site_url('dashboard') ?>" class="px-8 py-4 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-full text-lg font-semibold transition-all">
                    View Demo
                </a>
            </div>

            <!-- Features Grid -->
            <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 backdrop-blur-sm hover:bg-slate-800 transition-colors">
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-indigo-400 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">User Management</h3>
                    <p class="text-slate-400">Effortlessly add, edit, and manage your user base with our intuitive tools.</p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 backdrop-blur-sm hover:bg-slate-800 transition-colors">
                    <div class="w-12 h-12 bg-purple-500/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-purple-400 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Real-time Analytics</h3>
                    <p class="text-slate-400">Track your product classes, subclasses, and sales data in real-time.</p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-800/50 border border-slate-700/50 backdrop-blur-sm hover:bg-slate-800 transition-colors">
                    <div class="w-12 h-12 bg-pink-500/10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-lock text-pink-400 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Secure Payments</h3>
                    <p class="text-slate-400">Integrated Razorpay support for seamless and secure transaction handling.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-800 py-8 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-sm">
            &copy; <?= date('Y') ?> Code360. All rights reserved.
        </div>
    </footer>

</body>
</html>
