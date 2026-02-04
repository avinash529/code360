<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Code360</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-900 min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600 rounded-full blur-[120px] opacity-30 animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600 rounded-full blur-[120px] opacity-30 animate-pulse"></div>
    </div>

    <div class="w-full max-w-md p-6">
        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
                <p class="text-slate-400 text-sm">Sign in to continue to your dashboard</p>
            </div>

            <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-500/10 border border-red-500/20 text-red-200 text-sm p-4 rounded-lg mb-6 flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <span><?= $this->session->flashdata('error') ?></span>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('auth/login_action') ?>" class="space-y-6">
                <div>
                    <label class="block text-slate-300 text-sm font-medium mb-2">Username</label>
                    <input type="text" name="username" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" placeholder="Enter your username" required autofocus>
                </div>

                <div>
                    <label class="block text-slate-300 text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" placeholder="••••••••" required>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-slate-400 hover:text-white cursor-pointer transition-colors">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-500 rounded border-slate-700 bg-slate-800 focus:ring-offset-slate-900">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 transition-colors">Forgot Password?</a>
                </div>

                <button class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center border-t border-white/10 pt-6">
                <p class="text-slate-400 text-sm">
                    Don't have an account? 
                    <a href="<?= site_url('auth/register') ?>" class="text-white font-medium hover:text-indigo-300 transition-colors">Register here</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>